<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\db\Where;
use think\Request;
use app\common\model\Order as OrderM;
use app\common\validate\Replace as ReplaceV;
use app\common\model\Replace as ReplaceM;
use think\Db;
use app\common\model\OrderGoods;
use app\common\model\GoodsSpec;
use app\common\model\CouponUser;


class Order extends AdminController
{

    const ORDER_STATUS_UNPAID = 1;          //未付款
    const ORDER_STATUS_SHIPMENT = 2;        //待发货
    const ORDER_STATUS_RECEIVE= 3;          //待收货
    const ORDER_STATUS_COMMENTS= 4;         //待评论
    const ORDER_STATUS_FINISH= 5;           //已完成
    const ORDER_STATUS_REPLACE= 6;          //售后申请
    const ORDER_STATUS_REPLACE_FINISH= 7;   //售后完成
    const ORDER_STATUS_INVALID= 8;          //已失效


    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $this->assign('Type',1);
        return  view();
    }

    /**
     * 显示预生成订单资源列表
     *
     * @return \think\Response
     */
    public function reserve()
    {
        $this->assign('Type',2);
        return view('order/index');
    }

    /**
     * 显示申请售后订单资源列表
     *
     * @return \think\Response
     */
    public function replace()
    {
        $this->assign('Type',3);
        return view('order/index');
    }

    /**
    * getData  获取资源信息
    *
    * @param  int  $type
    * @return json
    * */
    public function getData(Request $request, $type=1)
    {
        $data = $request -> param();
        //var_dump($data);die;
        //定义SQL变量
        $alias = ['order'=>'o','user'=>'u'];
        $join = [['user','o.user_id=u.id'],['order_goods']];
        $field = ['o.id','o.serial','o.total_price','o.pay_price','o.integral','o.pay_status','o.pay_type','o.status','o.create_time','u.name'];
        $append = ['status_admin_text','pay_status_text','pay_type_text','goods_title'];


        //定义搜索条件
        $map = array();
        if(isset($data['keyword']) && !empty($data['keyword'])){
            $key = trim($data['keyword']);

            $map['u.name'] = ['like','%'.$key.'%'];             //用户昵称
            $map['u.phone'] = ['like','%'.$key.'%'];            //用户手机号码
            $map['o.serial'] = ['like','%'.$key.'%'];           //平台交易流水号
            $map['o.id'] = ['like','%'.$key.'%'];               //订单ID
            $map['o.phone'] = ['like','%'.$key.'%'];            //收货人手机号码
            $map['o.id'] =['in',function($query) use($key){     //构造子查询，查询产品名称
                $query->table('order_goods')->whereLike('title','%'.$key.'%')->field('order_id');
            }] ;
        }

        //定义条件搜索
        $mapType = array();
        if(isset($data['oType']) && !empty($data['oType'])){
            $oType = $data['oType'];
            if(!empty($oType['status']) && is_numeric($oType['status'])){
                $mapType['o.status'] = ['=',trim($oType['status'])];             //订单状态查询
            }
            if(!empty($oType['pay_type']) && is_numeric($oType['pay_type'])){
                $mapType['o.pay_type'] = ['=',trim($oType['pay_type'])];             //订单支付方式查询
            }
            if(!empty($oType['date_start']) && empty($oType['date_end']) && $oType['date_start'] <= date('Y-m-d')){
                $mapType['o.create_time'] = ['>',$oType['date_start']];             //订单创建开始时间
            }elseif(!empty($oType['date_end']) && empty($oType['date_start']) && $oType['date_end'] <= date('Y-m-d')){
                $mapType['o.create_time'] = ['>',$oType['date_end']];             //订单创建结束时间
            }elseif(!empty($oType['date_end']) && !empty($oType['date_start']) && $oType['date_end'] > $oType['date_start'] && $oType['date_end'] <= date('Y-m-d')){
                $mapType['o.create_time'] = ['between',[$oType['date_start'],$oType['date_end']]];             //订单创建时间
            }
        }

        $where = new Where();
        //是否生成完整订单
        //$where['o.complete'] = $type == 2 ? ['=',0] : ['=',1];
        switch($type){
            case 1 :
                $where['o.complete'] = ['=',1];
                break;
            case 2 :
                $where['o.complete'] = ['=',0];
                break;
            case 3 :
                $where['o.complete'] = ['=',1];
                $where['o.status'] = ['in','6,7'];
                break;
            default :
                $where['o.complete'] = ['=',1];
                break;

        }

        $list = OrderM::alias($alias)
            ->order('o.id desc')
            ->join($join)
            ->field($field)
            ->where($where->enclose())
            ->where(function($query) use($mapType){
                $query->where(new Where($mapType));
            })
            ->where(function($query) use($map){
                $query->whereOr(new Where($map));
            })
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->append($append)
            ->select();

        $count = OrderM::alias($alias)
            ->join($join)
            ->where($where->enclose())
            ->where(function($query) use($mapType){
                $query->where(new Where($mapType));
            })
            ->where(function($query) use($map){
                $query->whereOr(new Where($map));
            })
            ->count('o.id');

        return $this->kitJson($list,$count);

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
     * 订单发货
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function shipment($id)
    {
        if(!$resource = OrderM::get($id))
            return $this->failJson('订单信息有误');
        $resource->shipment = 1;
        $resource->status = 3;
        return $resource->save() ? $this->successJson('订单发货信息更新成功') : $this->failJson('更新失败，请重新操作');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $resource = OrderM::where('id',$id)->append(['goods_order','user_name','coupon','replace'])->find();
        if(!$resource)
            return $this->failJson('非有效数据信息');
        $this->assign('Order',$resource);
        return view('');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $resource = OrderM::where('id',$id)->append(['goods_order','user_name','coupon','replace'])->find();
        if(!$resource)
            return $this->failJson('非有效数据信息');
        $this->assign('Order',$resource);
        return view('');
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
        if(!$order = OrderM::where(['id'=>$id,'status'=>self::ORDER_STATUS_UNPAID])->find())
            return $this->failJson('订单信息有误');

        //事务提交订单
        Db::startTrans();
        try{


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


            //优惠券处理
            if(!empty($order->coupon_id)){
                $coupon = Coupon::withTrashed()->where('id',$order->coupon_id)->find();
                $coupon_user = CouponUser::where('coupon_id',$order->coupon_id)
                    ->where('user_id',$order->user_id)
                    ->find();

                if($coupon->delete_time != 0){  //优惠券已删除，则删除用户领取的优惠券
                    $coupon_user->delete();
                }elseif($coupon->end_time > time()){     //优惠过期，则更改用户优惠券至过期状态
                    $coupon_user->status = 3;
                    $coupon_user->save();
                }else{      //恢复优惠至未使用
                    $coupon_user->status = 0;
                    $coupon_user->save();
                }
            }

            //删除订单
            $order->delete();

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
     * 更新的售后申请
     *
     * @param  \think\Request  $request
     * @param  int  $order_id
     *
     * @return \think\Response
     */
    public function replaceUpdate(Request $request, $order_id)
    {
        $order=OrderM::get($order_id);
        $data=$request->param('replace');
        if(!$data || !$order)
            return $this->failJson('非有效售后信息');
        $validate = new ReplaceV();
        foreach($data as $value){
            if(!$validate->scene('admin_update')->check($value))
                return $this->failJson($validate->getError());
        }

        Db::startTrans();
        try{

            //更新售后申请
            $replace = new ReplaceM;
            $replace->saveAll($data);

            $cond = false;
            foreach($data as $res){
                //判断提交的售后状态，是否都为驳回
                if(isset($res['status']) && $res['status']==2){
                    $cond = true;
                }else{
                    $cond = false;
                    break;
                }
            }
            //更新订单
            if($cond === true){
                $order->status = self::ORDER_STATUS_REPLACE_FINISH;
                $order->save();
            }

            // 提交事务
            Db::commit();
        }catch(\Exception $e){
            // 回滚事务
            Db::rollback();
            return $this->failJson('更新失败');
        }
        return $this->successJson('更新成功');

    }

    /**
     * 完成售后申请
     *
     * @param  \think\Request  $request
     * @param  int  $order_id
     * @param  int  $id
     *
     * @return \think\Response
     */
    public function replaceComplete($order_id, $id)
    {
        if(!$replace=ReplaceM::where(['id'=>$id,'order_id'=>$order_id])->find())
            return $this->failJson('售后申请信息有误');

        Db::startTrans();
        try{
            //更新售后信息
            $replace->status=5;
            $replace->save();

            //如果该订单下所有售后信息都已更新完毕，则更新订单信息
            $resource = ReplaceM::where(['order_id'=>$order_id])->column('id,status');
            $cond = false;
            foreach($resource as $key=>$res){
                //判断提交的售后状态，是否都为驳回
                if($res==2){
                    $cond = true;
                }elseif($key == $id){
                    $cond = true;
                }else{
                    $cond = false;
                    break;
                }
            }
            //更新订单
            if($cond === true){
                OrderM::update(['id'=>$order_id,'status'=>self::ORDER_STATUS_REPLACE_FINISH]);
            }

            // 提交事务
            Db::commit();
        }catch(\Exception $e){
            // 回滚事务
            Db::rollback();
            return $this->failJson('更新失败');
        }
        return $this->successJson('更新成功');
    }
}
