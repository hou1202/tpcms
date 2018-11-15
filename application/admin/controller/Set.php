<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Set extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return view('set/setting');
    }

    public function tableTwo()
    {
        return view('table/table_two');
    }


}
