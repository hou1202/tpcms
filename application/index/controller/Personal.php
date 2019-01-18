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
            ->limit(1,15)
            ->select();
        $this->assign('Integral',$integral);
        $this->assign('Log',$log);
        return view();
    }

    public function pageData($page, $limit)
    {
        //$resource = Db::table('log_integral')->where('user_id',$this->user_info['id'])->order('id desc')->select();
        $resource = Db::table('log_integral')
            ->where('user_id',$this->user_info['id'])
            ->order('id desc')
            ->limit(($page-1)*$limit,$limit)
            ->select();
        return $resource ? $this->successJson('获取数据成功','',$resource) : $this->failJson('获取失败');
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
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
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
