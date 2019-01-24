<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/18
 * Time: 16:49
 */

namespace app\index\controller;


use app\common\controller\IndexController;

use app\common\model\Order;
use app\index\validate\Comments as CommentsV;
use think\Request;
use app\common\model\Comments as CommentsM;
use think\Db;

class Comments extends IndexController
{

    /**
     * 创建订单评论资源页面
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
            ->where('status',4)
            ->where('user_id',$this->user_info['id'])
            ->append(['goods_order'])
            ->find();
        if(!$resource)
            return redirect($request->header('referer'));
        $this->assign("Goods",$resource->goods_order);
        $this->assign("orderId",$id);
        return view('order/comments');
    }

    /**
     * 保存订单评论数据
     *
     * @param  \think\Request  $request
     * @param  int  $id     订单ID
     *
     * @return \think\Response
     */
    public function save(Request $request, $id){

        $data = $request->param("comments");
        if(empty($data))
            return $this->failJson('非有效评论信息');
        if(!$order = Order::where('id',$id)->where('user_id',$this->user_info['id'])->find())
            return $this->failJson('非有效订单信息');
        $validate = new CommentsV();
        foreach($data as &$val){
            if(!$validate->scene("create")->check($val))
                return $this->failJson($validate->getError());
            //拼接评论图
            if(isset($val['img']))
                $val['img'] = implode('-',$val['img']);
            $val['user_id'] = $this->user_info['id'];
            $val['order_id'] = $id;
        }

        Db::startTrans();
        try{
            //保存评论
            $comments = new CommentsM;
            $comments->saveAll($data);
            //更新订单状态
            $order->status = 5;
            $order->save();

            // 提交事务
            Db::commit();
        }catch(\Exception $e){
            // 回滚事务
            Db::rollback();
            return $this->failJson('评论提交失败，请重新提交');
        }
        return $this->successJson('评论提交成功','/order/3');
    }

}