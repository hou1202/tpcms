<?php

namespace app\index\controller;

use app\common\controller\IndexController;
use think\Request;

use app\common\model\Coupon as CouponM;
use app\common\model\Order;

class Coupon extends IndexController
{
    /**
     * 显示资源列表-我的优惠券
     *
     * @return \think\Response
     */
    public function index()
    {

        $resource = CouponM::alias('c')
            ->field('c.*')
            ->join('coupon_user u','c.id = u.coupon_id')
            ->where('c.end_time',['=',0],['>',time()],'or')
            ->where('c.status',1)
            ->where('u.status',0)
            ->where('u.user_id',$this->user_info['id'])
            ->append(['type_text'])
            ->select()
            ->toArray();
        $this->assign('Coupon',$resource);
        return view();
    }

    /**
     * 获取指定类型资源
     *
     * @param  int  $type
     * @return \think\Response
     */
    public function getData($type)
    {
        $resource = CouponM::alias('c')
            ->field('c.*')
            ->join('coupon_user u','c.id = u.coupon_id')
            ->where('c.end_time',['=',0],['>',time()],'or')
            ->where('c.status',1)
            ->where('u.status',$type)
            ->where('u.user_id',$this->user_info['id'])
            ->append(['type_text'])
            ->select()
            ->toArray();
        return $resource ? $this->successJson('优惠券数据获取成功','',$resource) : $this->failJson('获取失败');
    }

    /**
     * 显示所有资源表单页-领取优惠券-优惠券大厅
     *
     * @return \think\Response
     */
    public function receives()
    {
        $resource = CouponM::where('status',1)
            ->where('end_time',['=',0],['>',time()],'or')
            ->whereNotIn('id',function($query){
                $query->table('coupon_user')->where('user_id',$this->user_info['id'])->field('coupon_id');
            })->append(['type_text'])
            ->select()
            ->toArray();
        $this->assign('Coupon',$resource);
        return view('coupon/receives');
    }

    /**
     * 显示资源列表-下单选择
     *
     * @return \think\Response
     */
    public function select(Request $request, $id, $address_id)
    {

        if(!$order = Order::where(['id'=>$id,'user_id'=>$this->user_info['id']])->find())
            return redirect($request->header('referer'));

        $goods = $order->orderGoods()->select();

        //获取符合条件的优惠券
        $goods_id = '';
        foreach($goods as $g){
            $goods_id .= $g['goods_id'].',';
        }
        $goods_id = substr($goods_id,0,-1);
        $classify_id = '';
        foreach($goods as $c){
            $classify_id .= $c['classify_id'].',';
        }
        $classify_id = substr($classify_id,0,-1);

        $resource = CouponM::alias('c')
            ->field('c.*')
            ->join('coupon_user u','c.id = u.coupon_id')
            ->where('c.end_time','>',time())        //优惠券尚未过期
            ->where('u.status',0)                   //用户尚未使用
            ->where('u.user_id',$this->user_info['id'])         //属于订单用户
            ->where('c.money_satisfy',['=',0],['<',$order->goods_price],'or')       //订单金额满足使用条件
            ->where("c.type=1 OR c.goods_id IN (".$goods_id.") OR c.classify_id IN (".$classify_id.")")     //满足类型的优惠券
            ->append(['type_text'])
            ->select()
            ->toArray();
        $this->assign("orderId",$id);
        $this->assign("addressId",$address_id);
        $this->assign('Coupon',$resource);
        return view('');
    }

    /**
     * 领取指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function collar($id)
    {
        $coupon = CouponM::where(['id'=>$id,'status'=>1])->where('end_time',['=',0],['>',time()],'or')->find();
        if(!$coupon)
            return $this->failJson('优惠券信息有误');
        $resource = $coupon->couponUser()->save(['user_id'=>$this->user_info['id']]);
         return $resource ? $this->successJson('优惠券领取成功') : $this->failJson('领取失败');
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
}
