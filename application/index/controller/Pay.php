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

class Pay extends IndexController
{
    private $app_id;                //应用APPID

    private $seller_id;             //支付宝PID

    private $private_key;           //商户私钥

    private $notify_url;            //异步通知地址

    private $return_url;            //同步跳转

    private $charset;               //编码格式

    private $sign_type;             //签名方式

    private $gateway;               //支付宝网关

    private $public_key;            //支付宝公钥






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

    public function payReturn(Request $request)
    {
        var_dump($request->param());
        var_dump('returnurl');
    }

    public function payNotify(Request $request)
    {
        var_dump($request->param());
        var_dump('notify');
    }

}