<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Error extends Controller
{
    /**
     * 错误信息页面,默认为权限错误信息提示
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {

        $data = $request ->param();
        if($data) $this->assign('data',$data['msg']);
        return view('error/error');
    }


}
