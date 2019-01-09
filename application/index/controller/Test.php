<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/9
 * Time: 11:48
 */

namespace app\index\controller;
use think\facade\Config;
use app\common\controller\Alipay;

use app\common\controller\BaseController;
use think\facade\Env;

class Test extends BaseController
{
    public function index()
    {
        //echo Env::get('think_path');
        //echo Env::get('extend_path');

        //echo DS;
        $pay = new Alipay();
        echo getcwd();

    }
}