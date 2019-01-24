<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\db\Where;
use think\Request;
use app\common\model\Order as OrderM;
use app\common\validate\Replace as ReplaceV;
use app\common\model\Replace as ReplaceM;
use think\Db;


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


    /**
     * 更新的售后申请
     *
     * @param  \think\Request  $request
     * @param  int  $order_id
     *
     * @return \think\Response
     */
    public function replace(Request $request, $order_id)
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
}
