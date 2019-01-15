<?php
/**
 * Created by PhpStorm.
 * Project: 基础库-支付宝支付
 * User: Hou-ShiShu
 * Date: 2019/1/9
 * Time: 11:43
 */

namespace app\common\controller;

use think\facade\Cache;
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
        $aliConfig = Config::get('alipay_config');
        /*$this->app_id = $aliConfig['app_id'];
        $this->seller_id = $aliConfig['seller_id'];
        $this->notify_url = $aliConfig['notify_url'];
        $this->return_url = $aliConfig['return_url'];
        $this->error_url = $aliConfig['error_url'];
        $this->charset_type = $aliConfig['input_charset'];
        $this->sign_type = $aliConfig['sign_type'];
        $this->gateway = $aliConfig['gateway_url'];
        $this->private_key = $aliConfig['private_key'];
        $this->ali_public_key = $aliConfig['ali_public_key'];*/
        $this->config = [
            'app_id' => $aliConfig['app_id'],                           //应用APPID
            'seller_id ' => $aliConfig['seller_id'],                    //支付宝PID
            'notify_url' => $aliConfig['notify_url'],                   //异步通知地址
            'return_url' => $aliConfig['return_url'],                   //同步跳转
            'quit_url ' => $aliConfig['quit_url'],                     //支付失败跳转地址
            'charset' => $aliConfig['input_charset'],                   //编码格式
            'sign_type' => $aliConfig['sign_type'],                     //签名方式
            'gatewayUrl' => $aliConfig['gatewayUrl'],                  //支付宝网关
            'merchant_private_key' => $aliConfig['merchant_private_key'],        //商户私钥
            'alipay_public_key' => $aliConfig['alipay_public_key'],        //支付宝公钥
        ];
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
        /*
        $aop = new \AopClient();
        $aop->appId = $this->config['app_id'];     //应用APPID
        $aop->format = "json";
        $aop->gatewayUrl = $this->config['gatewayUrl'];   //支付宝网关
        $aop->charset = $this->config['charset'];    //编码格式
        $aop->signType = $this->config['sign_type'];       //签名方式
        $aop->rsaPrivateKey = $this->config['merchant_private_key'];    //密钥
        $aop->alipayrsaPublicKey = $this->config['alipay_public_key'];    //公钥

        //实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.wap.pay  手机网站支付接口
        $request = new \AlipayTradeWapPayRequest();
        //SDK已经封装掉了公共参数，这里只需要传入业务参数
        $request_body = "{" .
            "\"body\":\"".$msg."\"," .
            "\"subject\":\"".$msg."\"," .
            "\"out_trade_no\":\"".$orderNumber."\"," .
            "\"timeout_express\":\"30m\"," .
            "\"total_amount\":".$payAmount."," .
            "\"seller_id\":\"".$this->config['seller_id']."\"," .
            "\"goods_type\":\"1\"," .
            "\"quit_url\":\"".$this->config['quit_url']."\"," .
            "\"product_code\":\"QUICK_WAP_WAY\"," .
            "  }";
        $request->setNotifyUrl($this->config['notify_url']);
        $request->setReturnUrl($this->config['return_url']);
        $request->setBizContent($request_body);

        $response = $aop->pageExecute($request);

        //htmlspecialchars是为了输出到页面时防止被浏览器将关键参数html转义，实际打印到日志以及http传输不会有这个问题
        return ['resp'=>$response];//就是orderString 可以直接给客户端请求，无需再做处理。
        */
    }




}