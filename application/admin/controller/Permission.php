<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;
use app\admin\model\Router;
use app\admin\model\Permission as PermissionM;
use app\admin\validate\Permission as PermissionV;

class Permission extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return view('permission/index');
    }

    //获取数据列表
    public function permissionData(Request $request)
    {
        $data = $request -> post();
        $list = PermissionM::limit(($data['page']-1)*$data['limit'],$data['limit']) -> select();
        $res = [
            'code' => 0,
            'count' => PermissionM::count('id'),
            'data' => $list,
        ];
        return json($res);
    }

    //设置状态
    public function setPermissionStatus(Request $request)
    {
        $data = $request -> post();
        $validate = new PermissionV();
        if(!$validate->scene('status')->check($data)){
            return json($validate->getError());
        }
        $router = PermissionM::get($data['id']);
        return $router->save($data) ? json('权限组状态更新成功') : json('状态更新失败');
    }


    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        $router = Router::where('status',1)->all();
        $this->assign("Route",$router);
        return view('permission/create');
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
        $data = $request -> post();
        $validate = new PermissionV();
        if(!$validate->scene('save')->check($data)){
            return json($validate->getError());
        }
        $data['router_id'] = implode('-',$data['router_id']);
        return PermissionM::create($data) ? json('权限组新增成功') : json('添加失败');
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
