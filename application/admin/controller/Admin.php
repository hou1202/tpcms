<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;
use app\admin\model\Admin as Adminer;
use app\admin\validate\Admin as AdminValidate;
use think\Validate;

class Admin extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('admin/index');
    }

    /*
     * 获取管理员资源信息
     *
     * @return json
     * */
    public function indexData()
    {
        $data = Adminer::all();
        $res = [
            'code' => 0,
            'count' => count($data),
            'data' => $data,
        ];
        return json($res);
    }

    /*
     * @ setAdminStatus     更新管理员帐户状态
     * @Method      POST
     * */
    public function setAdminStatus(Request $request)
    {
        $data = $request -> post();
        $validate = new AdminValidate();
        if(!$validate->scene('status')->check($data)){
            return json($validate->getError());
        }
        $adminer = Adminer::get($data['id']);
        return $adminer->save($data) ? json('管理员帐户状态更新成功') : json('状态更新失败');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('admin/create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //var_dump($request->post());
        $data = $request -> post();
        $validate = new AdminValidate();
        if(!$validate->scene('save')->check($data)){
            return json($validate->getError());
        }
        return Adminer::create($data) ? json('管理员新增成功') : json('添加失败');

        //var_dump($data);
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
