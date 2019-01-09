<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/9
 * Time: 16:46
 */

namespace app\index\controller;


use app\common\controller\BaseController;
use think\facade\Request;

class Pay extends BaseController
{
    public function error(Request $request)
    {
        var_dump($request->param());
        var_dump('error');
    }

    public function success(Request $request)
    {
        var_dump($request->param());
        var_dump('success');
    }

    public function returnurl(Request $request)
    {
        var_dump($request->param());
        var_dump('returnurl');
    }

}