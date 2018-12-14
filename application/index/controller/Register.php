<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/12/14
 * Time: 9:44
 */

namespace app\index\controller;


use app\common\controller\IndexController;
use think\Request;
use app\index\validate\Register as RegisterV;

class Register extends IndexController
{
    /*注册页面*/
    public function index()
    {
        return view('/register');
    }

    /*注册处理*/
    public function register(Request $request)
    {

        $data = $request -> post();
        $validate = new RegisterV();
        if(!$validate -> sceneRegister() -> check($data)){
            return $this->returnJson($validate -> getError(),0);
        }
        return $this->returnJson('提交成功');
    }

}