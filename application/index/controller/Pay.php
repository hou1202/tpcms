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
    /*
    private $app_id;                //应用APPID

    private $seller_id;             //支付宝PID

    private $private_key;           //商户私钥

    private $notify_url;            //异步通知地址

    private $return_url;            //同步跳转

    private $charset;               //编码格式

    private $sign_type;             //签名方式

    private $gateway;               //支付宝网关

    private $public_key;            //支付宝公钥*/

    private $config = array();          //支付宝配置参数信息

    /**
     * 初始化
     */
    protected function initialize(){

        $aliConfig = Config::get('alipay_config');
        $this->config = [
            'app_id' => $aliConfig['app_id'],                           //应用APPID
            'seller_id ' => $aliConfig['seller_id'],                    //支付宝PID
            'notify_url' => $aliConfig['notify_url'],                   //异步通知地址
            'return_url' => $aliConfig['return_url'],                   //同步跳转
            'quit_url ' => $aliConfig['error_url'],                     //支付失败跳转地址
            'charset' => $aliConfig['input_charset'],                   //编码格式
            'sign_type' => $aliConfig['sign_type'],                     //签名方式
            'gatewayUrl' => $aliConfig['gateway_url'],                  //支付宝网关
            'merchant_private_key' => $aliConfig['private_key'],        //商户私钥
            'alipay_public_key' => $aliConfig['ali_public_key'],        //支付宝公钥
        ];
    }

    public function payReturn(Request $request)
    {
        $data = $request->param();
        //加载支付宝扩展文件
        Loader::addAutoLoadDir(Env::get('extend_path').'alipay'.DS.'wappay'.DS.'service'.DS);
        Loader::autoload('AlipayTradeService');

        $alipaySevice = new \AlipayTradeService($this->config);
        $result = $alipaySevice->check($data);



        var_dump($request->param());
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