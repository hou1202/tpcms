<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\db\Where;
use think\Request;
use app\common\model\Order as OrderM;


class Order extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return  view();
    }

    /*
    * getData  获取资源信息
    *
    * @return json
    * */
    public function getData(Request $request)
    {
        $data = $request -> param();

        //定义SQL变量
        $alias = ['order'=>'o','user'=>'u'];
        $join = [['user','o.user_id=u.id'],['order_goods']];
        $field = ['o.id','o.serial','o.total_price','o.pay_price','o.integral','o.pay_status','o.pay_type','o.status','o.create_time','u.name'];
        $append = ['status_admin_text','pay_status_text','pay_type_text','goods_title'];

        //定义搜索条件
        $map=array();
        if(isset($data['keyword']) && !empty($data['keyword'])){
            $map['u.name'] = ['like','%'.trim($data['keyword']).'%'];
            $map['o.serial'] = ['like','%'.trim($data['keyword']).'%'];
            $map['o.id'] = ['like','%'.trim($data['keyword']).'%'];
            $map['o.phone'] = ['like','%'.trim($data['keyword']).'%'];
        }

        $list = OrderM::alias($alias)
            ->order('o.id desc')
            ->join($join)
            ->field($field)
            ->whereOr(new Where($map))
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->append($append)
            ->select();


        /*$list = OrderM::alias('o')
            ->field('o.id,o.total_price,o.pay_price,o.integral,o.pay_status,o.pay_type,o.status,o.create_time,u.name')
            ->where($map)
            ->join('user u','u.id = o.user_id')
            ->order('o.id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->append(['status_admin_text','pay_status_text','pay_type_text','goods_title'])
            ->select();*/

        $count = OrderM::alias($alias)
            ->join($join)
            ->whereOr(new Where($map))
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
        $resource = OrderM::where('id',$id)->append(['goods_order','user_name','coupon'])->find();
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
        //
    }
}
