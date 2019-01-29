<?php

namespace app\index\controller;

use app\common\controller\IndexController;
use app\common\model\Notice;
use app\common\model\User;
use think\Db;
use think\Request;
use app\common\validate\User as UserV;
use app\common\model\Message;


class Personal extends IndexController
{
    /**
     * 显示资源
     *
     * @return \think\Response
     */
    public function index()
    {

        $this->assign('User',User::get($this->user_info['id']));
        return view('personal/personal');
    }

    /**
     * 显示积分资源页面.
     *
     * @return \think\Response
     */
    public function integral()
    {
        $integral = User::where('id',$this->user_info['id'])->value('integral');
        $log = Db::table('log_integral')->where('user_id',$this->user_info['id'])
            ->order('id desc')
            ->limit(1,20)
            ->select();
        $this->assign('Integral',$integral);
        $this->assign('Log',$log);
        return view();
    }

    /**
     * 获取积分数据.
     *
     * @ param   int     $page
     * @ param   int     $limit
     *
     * @return \think\Response
     */
    public function integralData($page, $limit)
    {
        $resource = Db::table('log_integral')
            ->where('user_id',$this->user_info['id'])
            ->order('id desc')
            ->limit(($page-1)*$limit,$limit)
            ->select();
        return $resource ? $this->successJson('获取数据成功','',$resource) : $this->failJson('获取失败');
    }

    /**
     * 显示资金资源页面.
     *
     * @return \think\Response
     */
    public function wallet()
    {
        $wallet = User::where('id',$this->user_info['id'])->value('balance');
        $log = Db::table('log_money')->where('user_id',$this->user_info['id'])
            ->order('id desc')
            ->limit(1,20)
            ->select();
        $this->assign('Wallet',$wallet);
        $this->assign('Log',$log);
        return view();
    }

    /**
     * 获取资金数据.
     *
     * @ param   int     $page
     * @ param   int     $limit
     *
     * @return \think\Response
     */
    public function walletData($page, $limit)
    {
        $resource = Db::table('log_money')
            ->where('user_id',$this->user_info['id'])
            ->order('id desc')
            ->limit(($page-1)*$limit,$limit)
            ->select();
        return $resource ? $this->successJson('获取数据成功','',$resource) : $this->failJson('获取失败');
    }


    /**
     * 显示个人资料资源页面.
     *
     * @return \think\Response
     */
    public function data()
    {
        $resource = User::get($this->user_info['id']);
        $this->assign('Data',$resource);
        return view();
    }

    /**
     * 更新个人资料
     *
     * @param  int  $id
     * @param  \think\Request  $request
     *
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->param();
        if($id != $this->user_info['id'] )
            return $this->failJson('非有效修改数据');
        $validate = new UserV();
        if(!$validate->scene('indexUpdate')->check($data))
            return $this->failJson($validate->getError());
        $user = User::get($id);
        return $user->save($data) ? $this->successJson('资料更新成功','/personal') : $this->failJson('资料更新失败');
    }

    /**
     * 显示消息通知页面
     *
     * @return \think\Response
     */
    public function notice()
    {
        $resource = Notice::where('user_id',0)->whereOr('user_id',$this->user_info['id'])->order('id desc')->select();
        $this->assign('Notice',$resource);
        return view();
    }

    /**
     * 删除消息通知
     *
     * @param  int  $id
     *
     * @return \think\Response
     */
    public function noticeDel($id)
    {
        if(!$notice = Notice::get($id))
            return $this->failJson('非有效通知信息');
        return $notice->delete() ? $this->successJson('删除成功') : $this->failJson('删除失败');
    }

    /**
     * 关于我们列表页面
     *
     * @return \think\Response
     */
    public function about()
    {
        $resource = Message::field('id,title')->order('sort desc')->select();
        $this->assign('Message',$resource);
        return view();
    }

    /**
     * 信息详情页面
     *
     * @param  int  $id
     * @param  \think\Request  $request
     *
     * @return \think\Response
     */
    public function message(Request $request, $id)
    {
        if(!$resource = Message::get($id))
            return redirect($request->header('referer'));
        $this->assign('Message',$resource);
        return view();
    }
}
