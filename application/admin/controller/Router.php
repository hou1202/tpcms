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

    //获取路由列表数据
    public function routerData(Request $request)
    {
        $data = $request -> post();
        $list = RouteM::limit(($data['page']-1)*$data['limit'],$data['limit']) -> select();
        $res = [
            'code' => 0,
            'count' => RouteM::count('id'),
            'data' => $list,
        ];
        return json($res);
    }

    //设置状态
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
    public function edit($id)
    {
        $main = RouteM::field('id,title')->where('main',1)->where('status',1)->select();
        $route = Routem::where('id',$id)->find();
        $this->assign('main',$main);
        $this->assign('Route',$route);
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
        $route = RouteM::get($id);
        $data = $request -> post();
        $validate = new RouterV();
        if(!$validate->scene('save')->check($data)){
            return json($validate->getError());
        }
        return $route->save($data) ? json('路由编辑成功') : json('编辑失败');
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
        if(RouteM::where('pid',$id)->find()){
            return json('该路由为主路由，若要删除请先删除所属子路由');
        }
        return RouteM::destroy($id) ? json('路由删除成功') : json('删除失败');
        //var_dump($id);
    }
}
