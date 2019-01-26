<?php

namespace app\index\controller;

use app\common\controller\IndexController;
use app\common\model\User;
use think\Db;
use think\Request;


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
     * 显示资金资源页面.
     *
     * @return \think\Response
     */
    public function data()
    {
        $resource = User::get($this->user_info['id']);
        $this->assign('Data',$resource);
        return view();
    }
}
