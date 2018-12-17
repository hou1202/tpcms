<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/12/14
 * Time: 9:20
 */

namespace app\index\controller;


use app\common\controller\BaseController;
use app\index\validate\Register;
use think\Request;
use app\index\model\User;
use app\index\common\Users;
use think\facade\Cache;

class Login extends BaseController
{


    /*
    * @ index     登录页面处理
    * @return \think\Response
    * */
    public function index()
    {
        if(Users::check())
            return redirect('/personal');

        //缓存记录访问登录页面地址
        cache('login_'.$this->request->ip(),$this->request->header('referer'),1800);
        return $this->fetch('/login/login');
    }

    /*
    * @ login     登录信息处理
    * @return \think\Response
    * */
    public function login(Request $request)
    {
        $data = $request->param();
        $validate = new Register();
        if(!$validate->scene('login')->check($data))
            return $this->failJson($validate->getError());
        $user = User::where('phone',$request->param('phone'))
                    ->where('password',md5($request->param('password')))
                    ->find();
        if(!$user)
            return $this->failJson('登录帐户不正确');
        if(!$user->status)
            return $this->failJson('您的帐户已经被禁用');
        if(!Users::login($user->phone))
            return $this->failJson('登录失败，请重新登录');

        $refer = cache('login_'.$this->request->ip()) ? Cache::pull('login_'.$this->request->ip()) : '/personal';
        return $this->successJson('登录成功',$refer);


    }

    /*
    * @ logout     退出登录信息处理
    * @return \think\Response
    * */
    public function logout()
    {
        Users::logout();
        return redirect('/login');
    }


}