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
use app\index\model\User;
use think\Session;

class Register extends IndexController
{
    /*
     * @ index  注册页面
     * */
    public function index()
    {
        return view('/register');
    }

    /*
     * @ register   注册处理
     * */
    public function register(Request $request)
    {

        $data = $request -> post();
        $validate = new RegisterV();
        if(!$validate -> sceneRegister() -> check($data))
            return $this->returnJson($validate -> getError(),0);

        //数据判断
        //if(session::has())
        //数据组装
        $data['sex'] = mt_rand(0,1);
        $data['portrait'] = '/static/index/images/default-head-'.$data['sex'].'.png';
        $data['name'] = '用户'.mt_rand(1000,9999);

        //数据写入及的返回
        return User::create($data) ?
            $this->returnJson('注册成功') :
            $this->returnJson('注册失败，请重新注册',0);
    }

}