<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/9
 * Time: 16:46
 */

namespace app\index\controller;


use app\common\controller\BaseController;
use think\Request;

class Pay extends BaseController
{


    public function payError(Request $request)
    {
        var_dump($request->param());
        var_dump('error');
    }

    public function paySuccess(Request $request)
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