<?php

namespace app\index\controller;

use app\common\controller\IndexController;
use think\Request;

use app\common\model\Coupon as CouponM;

class Coupon extends IndexController
{
    /**
     * 显示资源列表
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
            ->append(['type_text'])
            ->select()
            ->toArray();
        return $resource ? $this->successJson('优惠券数据获取成功','',$resource) : $this->failJson('获取失败');
    }

    /**
     * 显示所有资源表单页.
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
