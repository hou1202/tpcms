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

class Forget extends BaseController
{



    /*
    * @ index     忘记密码页面处理
    * @return \think\Response
    * */
    public function index(){
        return view('/login/forget');
    }

    /*
    * @ forget   忘记密码处理
    * */
    public function forget(Request $request)
    {

        $data = $request -> post();
        $validate = new Register();
        if(!$validate -> scene('forget') -> check($request->param()))
            return $this->failJson($validate -> getError());

        //检验验证码
        if(!Verify::checkCode($request->param('phone'),2,$request->param('code')))
            return $this->failJson('验证码错误');

        $user = User::where('phone',$request->param('phone'))->find();

        if($user->password == md5($request->param('password')))
            return $this->failJson('与原密码一致，请设置新密码');

        //数据写入及的返回
        if($user->save($data)){
            //释放验证码
            Verify::finishCode($request->param('phone'),2,$request->param('code'));
            return $this->successJson('密码更新成功','/login');
        }else{
            return $this->failJson('密码更新失败');
        }

    }



}