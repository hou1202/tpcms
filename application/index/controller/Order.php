<?php

namespace app\index\controller;

use app\common\controller\Alipay;
use app\common\controller\IndexController;
use app\common\model\OrderGoods;
use app\common\model\User;
use think\Request;
use think\Db;

use app\common\model\Goods;
use app\common\model\GoodsSpec;
use app\common\model\Order as OrderM;
use app\common\model\Car;
use app\common\model\Address;
use app\common\model\Config;
use app\common\model\Coupon;
use app\common\model\CouponUser;
use app\common\controller\MoneyLog;

use app\index\validate\Order as OrderV;

class Order extends IndexController
{
    const ORDER_STATUS_UNPAID = 1;          //未付款
    const ORDER_STATUS_SHIPMENT = 2;        //待发货
    const ORDER_STATUS_RECEIVE= 3;          //待收货
    const ORDER_STATUS_COMMENTS= 4;         //待评论
    const ORDER_STATUS_FINISH= 5;           //已完成
    const ORDER_STATUS_REPLACE= 6;          //售后申请
    const ORDER_STATUS_REPLACE_FINISH= 7;   //售后完成
    const ORDER_STATUS_INVALID= 8;          //已失效

    private static $whereOrderStatus = [
        self::ORDER_STATUS_UNPAID => '1',
        self::ORDER_STATUS_RECEIVE => '2,3',
        self::ORDER_STATUS_COMMENTS => '4',
        self::ORDER_STATUS_FINISH => '5',
        self::ORDER_STATUS_REPLACE => '6,7',
        self::ORDER_STATUS_INVALID => '8',
    ];


    /**
     * 显示资源列表
     *
     * @param  int  $type     订单类型
     * @return \think\Response
     */
    public function index($type=1)
    {
        $resource = OrderM::where('user_id',$this->user_info['id'])
            ->where('status',self::ORDER_STATUS_UNPAID)
            ->order('id desc')
            ->append(['goods_order'])
            ->select()
            ->toArray();

        $this->assign('Order',$resource);
        $this->assign('Active',$type);
        return view();
    }

    /**
     * 获取资源列表数据
     *
     * @param  int  $status     订单状态类型，默认为待支付
     * @param  int  $page       分页起始页
     * @param  int  $limit      分布显示条数
     * @return \think\Response
     */
    public function pageData($status,$page,$limit){

        $resources = OrderM::where('user_id',$this->user_info['id'])
            ->whereIn('status',static::$whereOrderStatus[$status])
            ->order('id desc')
            ->limit(($page-1)*$limit,$limit)
            ->append(['goods_order'])

            ->select()
            ->toArray();

        return $resources ? $this->successJson('获取数据成功','',$resources) : $this->failJson('获取失败');

    }

    /**
     * 显示指定资源详细信息
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read(Request $request, $id)
    {
        if(!$order = OrderM::where('id',$id)->append(['goods_order','status_text'])->find()->toArray())
            return redirect($request->header('referer'));
        $this->assign('outTime',Config::where('id',7)->value('param'));
        $this->assign('Order',$order);
        return view('details');

    }

    /**
     * 删除/取消指定订单
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if(!$order = OrderM::get($id))
            return $this->failJson('订单信息有误');
        //事务提交订单
        Db::startTrans();
        try{
            //删除订单
            $order->delete();

            //回增订单产品库存
            $resource = OrderGoods::field('goods_id,goods_spec_id,num')
                ->where('order_id',$order->id)
                ->select()
                ->toArray();

            foreach($resource as $val){
                GoodsSpec::where('id',$val['goods_spec_id'])->setInc('stock',$val['num']);
            }

            //删除订单产品
            OrderGoods::where('order_id',$order->id)->update(['delete_time'=>time()]);

            // 提交事务
            Db::commit();
        }catch(\Exception $e){
            // 回滚事务
            Db::rollback();
            return $this->failJson('订单取消失败，请重试');
        }

        return $this->successJson('订单取消成功');

    }

    /**
     * 确认收货
     * @param  int  $id
     *
     * @return \think\Response
     *  */
    public function receipt($id)
    {
        if(!$order = OrderM::get($id))
            return $this->failJson('订单信息有误');
        $order->status = self::ORDER_STATUS_COMMENTS;     //确认收货，订单进入待评论
        $order->save();
        return $this->successJson('确认收货完成，请对订单进行评价');

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @param  \think\Request  $request
     * @param  int  $coupon_id (Option)
     * @param  int  $address_id (Option )
     *
     * @return \think\Response
     */
    public function balance(Request $request, $id)
    {

        if(!$order = OrderM::get($id))
            return $this->failJson('订单错误');

        //获取收货地址信息
        if(empty($request->param('address_id'))){
            $address = Address::where(['user_id'=>$order->user_id, 'choice'=>1])->find();
        }else{
            $address = Address::where(['user_id'=>$order->user_id, 'id'=>$request->param('address_id')])->find();
        }

        //获取优惠券信息
        if(!empty($request->param('coupon_id'))){
            $coupon = Coupon::where(['id'=>$request->param('coupon_id')])->find();
        }else{
            $coupon=['id'=>'','money_derate'=>'0.00'];
        }

        $goods = $order->orderGoods()->select();

        $this->assign('Money',User::where('id',$this->user_info['id'])->value('balance'));
        $this->assign('Coupon',$coupon);
        $this->assign('Address',$address);
        $this->assign('Order',$order);
        $this->assign('Goods',$goods);
        return view();
    }

    /**
     * 生成支付订单.
     *
     * @param  int  $order_id
     * @param  \think\Request  $request
     *
     * @return \think\Response
     */
    public function payment(Request $request,$order_id)
    {

        $validate = new OrderV();
        if(!$validate->scene('payment')->check($request->param()))
            return $this->failJson($validate->getError());
        $coupon = Coupon::get($request->param('coupon_id'));
        $address = Address::get($request->param('address_id'));
        $order = OrderM::get($request->param('order_id'));

        //组装更新订单数据
        if($coupon){
            $order->discount_price = $coupon->money_derate;
            $order->pay_price = bcsub($order->total_price,$coupon->money_derate,2);
            $order->coupon_id = $coupon->id;
            $order->integral = bcmul(bcsub($order->total_price,$coupon->money_derate,2),bcdiv(Config::where('id',3)->value('param'),100,2),2);
        }
        $order->name = $address->name;
        $order->phone = $address->phone;
        $order->city = $address->city;
        $order->street = $address->street;
        $order->pay_type = $request->param('pay_type');

        /*if($coupon)
            var_dump($coupon->id);
        var_dump($coupon);
        die;*/

        //事务提交订单
        Db::startTrans();
        try{
            //更新用户优惠券信息
            if($coupon)
                CouponUser::where(['coupon_id'=>$coupon->id,'user_id'=>$this->user_info['id']])->update(['status'=>1]);
                /*$coupon->couponUser()
                    ->where('user_id',$this->user_info['id'])
                    ->save(['status'=>1]);*/
            $order->save();

            // 提交事务
            Db::commit();
        }catch(\Exception $e){
            // 回滚事务
            Db::rollback();
            return $this->failJson('订单信息有误');
        }
        return $this->successJson('开始支付','/pay/'.$order->id.'/'.$request->param('pay_type'));
    }

    /**
     * 请求支付.
     *
     * @param  int  $id
     * @param  int  $type
     *
     * @return \think\Response
     */
    public function pay(Request $request, $id, $type)
    {

        if(!$order = OrderM::get($id))
            return redirect('/pay/warn');
        if($order->pay_status != 0)
            return redirect('/pay/warn');
        /*$title = $order->orderGoods->column('title');
        $title = implode('-',$title);*/
        $title = 'Aoogi商城订单';
        if($type == 1){         //支付宝支付
            $pay = new Alipay();
            $resource = $pay->wapPay($order->pay_price,$order->serial,$title);
        }else if($type == 2){   //微信支付

        }else if($type == 3){   //余额支付
            //判断订单用户是否正确
            if(!$user = User::get($order->user_id))
                return redirect('/pay/warn');
            //判断用户余额是否大于订单金额
            if($user->balance < $order->pay_price)
                return redirect('/pay/warn');

            Db::startTrans();
            try{
                //更新用户余额-积分数据
                Db::table('user')->where('id',$order->user_id)->setInc('integral',$order->integral);
                Db::table('user')->where('id',$order->user_id)->setDec('balance',$order->pay_price);
                //记录LOG
                MoneyLog::IntegralLog($order->user_id,'累积：'.$order->serial,$order->pay_price,'+');
                MoneyLog::BalanceLog($order->user_id,$order->serial,$order->pay_price,'-');

                //更新用户优惠券状态
                if(!empty($order->coupon_id)){
                    $coupon = CouponUser::where('user_id',$order->user_id)->where('coupon_id',$order->coupon_id)->find();
                    $coupon->order_id = $order->id;
                    $coupon->status = 2;
                    $coupon->save();
                }

                //更新订单数据
                $order->pay_type = 3;
                $order->pay_status = 1;
                $order->status = self::ORDER_STATUS_SHIPMENT;
                $order->pay_time = time();
                $order->save();

                // 提交事务
                Db::commit();
            }catch(\Exception $e){
                // 回滚事务
                Db::rollback();
                return redirect('/pay/error');
            }
            return redirect('/pay/success');

        }else{
            return redirect('/pay/warn');
        }


    }

    /**
     * 购物车产品生成购买订单
     *
     * @param  \think\Request  $request
     * @param  int  $id     购物车ID
     * @param  int  $num    购物数量
     * @return \think\Response
     */
    public function buy(Request $request)
    {
        $data = $request->param();
        if(!isset($data['car']) || empty($data['car']))
            return $this->failJson('非有效下单信息');

        /**
         * 数据有效性验证
         */
        $validate = new OrderV;
        foreach($data['car'] as $val){
            if(!$validate->scene('car')->check($val))
                return $this->failJson($validate->getError());
        }

        $total = 0;
        $franking = 0;
        $order_goods = array();
        $car_id = null;

        /**
         * 下单数据验/处理
         */
        foreach($data['car'] as $value){

            $car = Car::get($value['id']);

            $goods = Goods::field('id,title,franking,classify_id,thumbnail')->where(['status'=>1,'id'=>$car['goods_id']])->find();
            if(!$goods){        //验证产品有效性
                Car::destroy($car['id']);      //清除购物车问题产品
                return $this->failJson('产品【 '.mb_substr($goods->title,0,10).'... 】,请重新下单');
            }

            $spec = GoodsSpec::get($car['spec_id']);
            if(!$spec){     //验证规格有效性
                Car::destroy($car['id']);      //清除购物车问题产品
                return $this->failJson('产品【 '.mb_substr($goods->title,0,10).'... 】,该规格已下架,请重新下单');
            }
            if($spec['stock'] < $value['num'])  //验证库存有效性
                return $this->failJson('产品【 '.mb_substr($goods->title,0,10).'... 】下单数量大于库存，请修改下单数量');
            //计算订单总金额
            $total =  bcadd($total,bcmul($spec['price'],$value['num'],2),2);
            //计算运算
            $franking = bcadd($franking,$goods->franking,2);
            //组装购物车ID
            $car_id .= $value['id'].',';
            //组装订单产品数据
            $order_goods[] =[
                'goods_id' => $goods['id'],
                'goods_spec_id' => $spec['id'],
                'classify_id' => $goods['classify_id'],
                'thumbnail' => $goods['thumbnail'],
                'title' => $goods['title'],
                'name' => $spec['name'],
                'price' => $spec['price'],
                'num' => $value['num'],
            ];
        }

        /**
         * 生成订单
         */
        //生成交易号
        $serial = date('Ymd').rand(100,999).time();
        $integral = bcmul($total,bcdiv(Config::where('id',3)->value('param'),100,2),2);
        Db::startTrans();
        try{
            //清减产品库
            foreach($order_goods as $g){
                GoodsSpec::where('id',$g['goods_spec_id'])->setDec('stock',$g['num']);
            }

            //创建订单
            $order = OrderM::create([
                'user_id' => $this->user_info['id'],
                'serial'=>$serial,
                'total_price'=>bcadd($total,$franking,2),
                'goods_price'=>$total,
                'integral'=>$integral,
                'franking_price'=>$franking,
                'pay_price'=>bcadd($total,$franking,2),
            ]);
            //创建订单产品
            $order->orderGoods()->saveAll($order_goods);
            //删除购物车产品
            Car::whereIn('id',mb_substr($car_id, 0, -1))->update(['delete_time'=>time()]);

            // 提交事务
            Db::commit();
        }catch(\Exception $e){
            // 回滚事务
            Db::rollback();
            return $this->failJson('订单创建失败');
        }

        return $this->successJson('下单成功','/balance/'.$order->id);


    }

    /**
     * 立即购买产品生成购买订单
     *
     * @param  \think\Request  $request
     * @param  int  $goods_id     产品ID
     * @param  int  $num    购物数量
     * @param  int  $spec   规格ID
     * @return \think\Response
     */
    public function purchase(Request $request){
        $data = $request->param();
        $validate = new OrderV;
        if(!$validate->scene('purchase')->check($data))
            return $this->failJson($validate->getError());

        $goods = Goods::get($data['goods_id']);
        $spec = GoodsSpec::get($data['spec_id']);
        $total =bcmul($spec->price,$data['num'],2);
        //生成交易号
        $serial = date('Ymd').rand(100,999).time();
        $integral = bcmul($total,bcdiv(Config::where('id',3)->value('param'),100,2),2);

        Db::startTrans();
        try{
            //创建订单
            $order = OrderM::create([
                'user_id' => $this->user_info['id'],
                'serial'=>$serial,
                'total_price'=>bcadd($total,$goods->franking,2),
                'goods_price'=>$total,
                'integral'=>$integral,
                'franking_price'=>$goods->franking,
                'pay_price'=>bcadd($total,$goods->franking,2),
            ]);
            //组装/创建订单产品数据
            $order->orderGoods()->save([
                'goods_id' => $goods->id,
                'goods_spec_id' => $spec->id,
                'classify_id' => $goods->classify_id,
                'thumbnail' => $goods->thumbnail,
                'title' => $goods->title,
                'name' => $spec->name,
                'price' => $spec->price,
                'num' => $data['num'],
            ]);

            // 提交事务
            Db::commit();
        }catch(\Exception $e){
            // 回滚事务
            Db::rollback();
            return $this->failJson('订单创建失败');
        }

        return $this->successJson('下单成功','/balance/'.$order->id);
    }


    /*public function replace(Request $request, $id)
    {
        $resource = OrderM::where('id',$id)
            ->where('pay_status',1)
            ->where('status',3)
            ->where('user_id',$this->user_info['id'])
            ->append(['goods_order'])
            ->find();
        if(!$resource)
            return redirect($request->header('referer'));
        $this->assign("Goods",$resource->goods_order);
        $this->assign("orderId",$id);
        return view();
    }*/


}
