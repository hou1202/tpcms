<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/21
 * Time: 16:28
 */

namespace app\index\controller;


use app\common\controller\IndexController;

use app\common\model\Order;
use app\common\model\Replace as ReplaceM;
use app\index\validate\Replace as ReplaceV;

use think\Request;
use think\Db;

class Replace extends IndexController
{

    /**
     * 创建申请售后资源页面
     *
     * @param  \think\Request  $request
     * @param  int  $id     订单ID
     *
     * @return \think\Response
     */
    public function index(Request $request, $id)
    {
        $resource = Order::where('id',$id)
            ->where('pay_status',1)
            ->where('status',3)
            ->where('user_id',$this->user_info['id'])
            ->append(['goods_order'])
            ->find();
        if(!$resource)
            return redirect($request->header('referer'));
        $this->assign("Goods",$resource->goods_order);
        $this->assign("orderId",$id);
        return view('order/replace');
    }

    /**
     * 保存申请售后订单数据
     *
     * @param  \think\Request  $request
     * @param  int  $id     订单ID
     *
     * @return \think\Response
     */
    public function save(Request $request, $id){
        $data = $request->param("replace");
        if(empty($data))
            return $this->failJson('非有效售后申请信息');
        if(!$order = Order::where('id',$id)->where('user_id',$this->user_info['id'])->find())
            return $this->failJson('非有效订单信息');
        $validate = new ReplaceV();
        foreach($data as &$val){
            if(!$validate->scene("create")->check($val))
                return $this->failJson($validate->getError());
            //拼接售后产品图
            if(isset($val['img']))
                $val['img'] = implode('-',$val['img']);
            $val['user_id'] = $this->user_info['id'];
            $val['order_id'] = $id;
        }
        Db::startTrans();
        try{
            //售后申请
            $replace = new ReplaceM;
            $replace->saveAll($data);

            //更新订单状态
            $order->status = 5;
            $order->save();

            // 提交事务
            Db::commit();
        }catch(\Exception $e){
            // 回滚事务
            Db::rollback();
            return $this->failJson('售后申请提交失败，请重新提交');
        }
        return $this->successJson('售后申请提交成功','/order/4');
    }
}