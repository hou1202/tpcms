<?php
/**
 * Created by PhpStorm.
 * Project: 基础库-支付宝支付
 * User: Hou-ShiShu
 * Date: 2019/1/9
 * Time: 11:43
 */

namespace app\common\controller;

use think\Loader;
use think\facade\Config;
use app\common\model\Config as ConfigM;

use think\facade\Env;

class Alipay
{


/*
    private $app_id;                //应用APPID

    private $seller_id;             //支付宝PID

    private $notify_url;            //异步通知地址

    private $return_url;            //同步跳转

    private $charset_type;          //编码格式

    private $sign_type;             //签名方式

    private $gateway;               //支付宝网关

    private $private_key;           //商户私钥

    private $ali_public_key;        //支付宝公钥

    private $error_url;             //支付失败跳转地址*/

    private $config = array();          //支付宝配置参数信息

    /**
     * 初始化
     */
    protected function initialize(){
        /*
         * $this->user_info = Users::user();
         * $this->handler = true;  // 标记为初始化成功
         */

    }


    /**
     * 网页支付 获取参数接口
     * @param   $payAmount  float    支付金额
     * @param   $orderNumber    string      订单编号
     * @param   $msg    string      订单交易标题
     * @param   $timeout    string     订单超时时间,单位：分钟,样例：‘1m’,默认值：'30m'
     * @return string
     */
    public function wapPay($payAmount, $orderNumber, $msg, $timeout='30m')
    {
        //支付宝扩展文件路径
        $payLoadPath = Env::get('extend_path').'alipay'.DS;

        Loader::addAutoLoadDir($payLoadPath.'wappay'.DS.'service'.DS);
        Loader::addAutoLoadDir($payLoadPath.'wappay'.DS.'buildermodel'.DS);
        Loader::autoload('AlipayTradeService');
        Loader::autoload('AlipayTradeWapPayContentBuilder');

        //判断是否为调试模式，若是，则支付金额为0.01
        if(Config::get('app_debug')){
            $payAmount = 0.01;
        }

        $payRequestBuilder = new \AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($msg);                          //商品描述,可为空
        $payRequestBuilder->setSubject($msg);                       //订单名称，必填
        $payRequestBuilder->setOutTradeNo($orderNumber);            //商户订单号，必填
        $payRequestBuilder->setTotalAmount($payAmount);             //付款金额，必填
        $payRequestBuilder->setTimeExpress($timeout);               //超时时间

        $aliConfig = Config::get('alipay_config');
        $payResponse = new \AlipayTradeService($aliConfig);
        $result = $payResponse->wapPay($payRequestBuilder, $aliConfig['return_url'], $aliConfig['notify_url']);

        return $result;

    }




}