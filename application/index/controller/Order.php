<?php

namespace app\index\controller;

use app\common\controller\Alipay;
use app\common\controller\IndexController;
use think\Request;
use think\Db;
use think\facade\Cache;

use app\common\model\Goods;
use app\common\model\GoodsSpec;
use app\common\model\Order as OrderM;
use app\common\model\Car;
use app\common\model\Address;
use app\common\model\Config;
use app\common\model\Coupon;
use app\common\model\CouponUser;

use app\index\validate\Order as OrderV;

class Order extends IndexController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
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

        $this->assign('Money',$this->user_info['balance']);
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
        //$data = $request->param();
        //var_dump($data);die;
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

        //var_dump($id.'/'.$type);
        if(!$order = OrderM::get($id))
            return redirect($request->header('referer'));
        /*$title = $order->orderGoods->column('title');
        $title = implode('-',$title);*/
        $title = 'Aoogi商城订单';

        $pay = new Alipay();
        $resource = $pay->wapPay($order->pay_price,$order->serial,$title);

    }


    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
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
}
