<?php

/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/10/19
 * Time: 9:54
 */

namespace app\admin\controller;

use app\admin\common\Auth;
use app\admin\model\Router;
use app\common\controller\AdminController;

use think\Controller;
use think\facade\Cookie;
use think\facade\Request;
use think\facade\Env;
use think\validate\ValidateRule;
use app\admin\common\User;


class Home extends AdminController
{
   /* protected function initialize()
    {
        if(!Cookie::has('admin_account')){
            redirect('/login');
        }

    }*/

   //主体框架加载信息
    public function home()
    {
        /*if(!Cookie::has('admin_account')) return redirect('/login');*/
        //if(!$admin = Auth::user()) return redirect(Request::domain().'/login');
        if(!$admin = User::user()) return redirect(Request::domain().'/login');
        $this->assign('User',$admin);
        return $this->fetch('/index');
    }

    public function main()
    {
        return view('/main');
    }

    //退出登录状态
    public function logout()
    {
        User::logout();
        $res = [
            'data' => '退出成功',
            'url' => Request::domain().'/login'
        ];
        return json($res);

    }

    //左右导航菜单目录
    public function menu(){
        $user = User::user();
        //系统默认管理员获取全部菜单
        if($user['account'] === Env::get('DEFAULT_ADMIN')){
            $res = Router::where('status',1)->all();
        }else{
            $roles = Auth::roles();
            $res = Router::where('id','in',$roles)->where('status',1)->select();
        };
        $xml = array();
        foreach($res as $router){
            if($router['pid'] == 0){
                $children = array();
                foreach ($res as $CRoute){
                    if($CRoute['pid'] == $router['id'] && $CRoute['main'] == 1){
                        $children[] = [
                            'id'=>$CRoute['id'],
                            'title'=>$CRoute['title'],
                            'path'=>'#'.$CRoute['menu'],
                            'icon'=>'&'.$CRoute['icon'],
                            'pid'=>$CRoute['pid'],
                            'open'=>false
                        ];
                    }
                }
                $xml[] = [
                        'id'=>$router['id'],
                        'title'=>$router['title'],
                        'path'=>$router['menu'] ? '#'.$router['menu'] : '',
                        'icon'=>'&'.$router['icon'],
                        'pid'=>$router['pid'],
                        'open'=>$router['open'] == 1 ? true : false,
                        'children'=>$children,
                    ];
            }
        }
        /*$route = [
            [
                'id'=>1,
                'title'=>'系统管理',
                'path'=>'',
                'icon'=>'&#xe631;',
                'pid'=>0,
                'open'=>true,
                'children'=>[
                    [
                        'id'=>10,
                        'title'=>'管理员设置',
                        'path'=>'#/adminer',
                        'icon'=>'&#xe631;', //第一个#号用&代替,
                        'pid'=>1,
                        'open'=>false
                    ],[
                        'id'=>11,
                        'title'=>'路由设置',
                        'path'=>'#/router',
                        'icon'=>'&#xe631;', //第一个#号用&代替,
                        'pid'=>1,
                        'open'=>false
                    ],
            ]
            ],[
                'id'=>2,
                'title'=>'一级菜单2',
                'path'=>'#/user/cc',
                'icon'=>'&#xe631;', //第一个#号用&代替,
                'pid'=>0,
                'open'=>true,
                'children'=>[
                    [
                        'id'=>22,
                        'title'=>'二级菜单21',
                        'path'=>'#/user/cc',
                        'icon'=>'&#xe631;', //第一个#号用&代替,
                        'pid'=>2,
                        'open'=>false,
                        'children'=>[]
                    ]
                ]
            ]
        ];*/

        //return json($route);
        return json($xml);

    }
}