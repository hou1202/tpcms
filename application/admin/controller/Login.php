<?php

namespace app\admin\controller;

use app\admin\validate\Admin as AdminV;
use think\Controller;
use think\Request;
use app\admin\model\Admin as AdminM;
use think\facade\Cookie;
use app\admin\common\Auth;
use app\admin\common\User;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        if(User::check()) return redirect('/admin');

        /*if(Cookie::has('admin_account')){
            return redirect('/admin');
        }*/
        return view('/login');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function login(Request $request)
    {
        //
        //var_dump($request->post());
        $data = $request -> post();
        $validate = new AdminV();
        if(!$validate->sceneLogin()->check($data)){
            return json($validate->getError());
        }
        $map[] = ['account','=',$data['account']];
        $map[] = ['password','=',md5($data['password'])];
        $admin = AdminM::field('id,account,password,status')
            ->where($map)
            ->find();
        if(!$admin) return json(['data' =>'帐户或密码信息有误']);
        if(!$admin['status']) return json(['data' =>'帐户已被禁用，请联系管理员']);
        //if(Auth::login($admin['account'])) return json(['data' =>'登录失败，请重新登录']);
        if(User::login($admin['account'])) return json(['data' =>'登录失败，请重新登录']);
        //Cookie::set('admin_account',$admin['account']);
        $res = [
            'data' => '登录成功',
            'url' => '/admin'
        ];
        return json($res);

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
