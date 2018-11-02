<?php

/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/10/19
 * Time: 9:54
 */

namespace app\admin\controller;

use app\admin\model\Router;
use app\common\controller\AdminController;

class Home extends AdminController
{
    public function home(){
        return $this->fetch('/index');
    }

    public function main(){
        return view('/main');
    }

    public function menu(){
        $res = Router::where('status',1)->all();
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