<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/12/14
 * Time: 9:20
 */

namespace app\index\controller;


use app\common\controller\IndexController;

class Login extends IndexController
{

    /*登录页面*/
    public function index()
    {
        return $this->fetch('/login');
    }

    /*登录处理*/
    public function login()
    {

    }

}