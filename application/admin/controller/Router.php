<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;
use app\admin\model\Router as RouteM;
use app\admin\validate\Router as RouterV;

class Router extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return view('router/index');
    }

    public function routerData()
    {
        $data = RouteM::all();
        $res = [
            'code' => 0,
            'count' => count($data),
            'data' => $data,
        ];
        return json($res);
    }

    public function setRouterStatus(Request $request)
    {
        $data = $request -> post();
        $validate = new RouterV();
        if(!$validate->scene('status')->check($data)){
            return json($validate->getError());
        }
        $router = RouteM::get($data['id']);
        return $router->save($data) ? json('路由状态更新成功') : json('状态更新失败');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        $main = RouteM::field('id,title')->where('main',1)->where('status',1)->select();
        $this->assign('main',$main);
        return view('router/create');
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
        $validate = new RouterV();
        if(!$validate->scene('save')->check($data)){
            return json($validate->getError());
        }
        //$data['main'] =  $data['pid'] == 0 ? 1 : 0 ;
        return RouteM::create($data) ? json('路由新增成功') : json('添加失败');
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
    public function edit(Request $request)
    {
        //var_dump();
        $main = RouteM::field('id,title')->where('main',1)->where('status',1)->select();
        $this->assign('main',$main);
        return view('router/edit');
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
