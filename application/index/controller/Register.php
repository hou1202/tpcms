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
use app\index\common\Users;

class Register extends IndexController
{
    /*
     * @ index  注册页面
     * */
    public function index()
    {
        if(Users::check())
            return redirect('/personal');
        return view('/login/register');
    }

    /*
     * @ register   注册处理
     * */
    public function register(Request $request)
    {

        $data = $request -> post();
        $validate = new RegisterV();
        if(!$validate -> sceneRegister() -> check($data))
            return $this->failJson($validate -> getError());

        //检验验证码
        if(!Verify::checkCode($data['phone'],1,$data['code']))
            return $this->failJson('验证码错误');

        //默认数据组装
        $data['sex'] = mt_rand(0,1);
        $data['portrait'] = '/static/index/images/default-head-'.$data['sex'].'.png';
        $data['name'] = '用户'.mt_rand(1000,9999);

        //数据写入及的返回
        if(User::create($data)){
            //释放验证码
            Verify::finishCode($data['phone'],1,$data['code']);
            return $this->successJson('注册成功,请登录','/login');
        }else{
            return $this->failJson('注册失败，请重新注册');
        }

    }

}