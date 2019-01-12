<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/9
 * Time: 16:46
 */

namespace app\index\controller;

use app\common\controller\IndexController;
use think\Request;
use think\facade\Env;
use think\Loader;

use think\facade\Config;
use app\common\model\Config as ConfigM;

class Pay extends IndexController
{

    public function payReturn(Request $request)
    {
        $data = $request->param();
        //加载支付宝扩展文件
        Loader::addAutoLoadDir(Env::get('extend_path').'alipay'.DS.'wappay'.DS.'service'.DS);
        Loader::autoload('AlipayTradeService');

        $aliConfig = Config::get('alipay_config');
        $alipaySevice = new \AlipayTradeService($aliConfig);
        $result = $alipaySevice->check($data);




        var_dump($request->param());
        var_dump($result);
        var_dump('returnurl');












    }

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

    public function payNotify(Request $request)
    {
        var_dump($request->param());
        var_dump('notify');
    }

}