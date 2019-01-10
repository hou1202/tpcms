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

use think\facade\Env;

class Alipay
{

    /**
     * 网页支付 获取参数接口
     * @param   $payAmount  float    支付金额
     * @param   $orderNumber    string      订单编号
     * @param   $msg    string      订单交易标题
     * @return string
     */
    public function webGet($payAmount, $orderNumber, $msg)
    {
        $alipayPath = Env::get('extend_path').'alipay'.DS.'aop'.DS;
        Loader::addAutoLoadDir($alipayPath);
        Loader::addAutoLoadDir($alipayPath.'request'.DS);
        Loader::autoload('AopClient');
        Loader::autoload('AlipayTradeAppPayRequest');

        if(Config::get('app_debug')){
            $totalAmount = 0.01;
        }
        $aliConfig = Config::get('alipay_config');
        $urlConfig = Config::get('alipay_url');
        $aop = new \AopClient();
        $aop->appId = $aliConfig['app_id'];     //应用APPID
        $aop->format = "json";
        $aop->gatewayUrl = $aliConfig['gateway_url'];   //支付宝网关
        $aop->charset = $aliConfig['input_charset'];    //编码格式
        $aop->signType = $aliConfig['sign_type'];       //签名方式
        $aop->rsaPrivateKey = $aliConfig['private_key'];    //密钥
        $aop->alipayrsaPublicKey = $aliConfig['ali_public_key'];    //公钥

        //实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.wap.pay  手机网站支付接口
        $request = new \AlipayTradeWapPayRequest();
        //SDK已经封装掉了公共参数，这里只需要传入业务参数
        $request_body = "{" .
            "\"body\":\"".$msg."\"," .
            "\"subject\":\"".$msg."\"," .
            "\"out_trade_no\":\"".$orderNumber."\"," .
            "\"timeout_express\":\"30m\"," .
            "\"total_amount\":".$payAmount."," .
            "\"seller_id\":\"".$aliConfig['seller_id']."\"," .
            "\"goods_type\":\"1\"," .
            "\"quit_url\":\"".$urlConfig['errorpage']."\"," .
            "\"product_code\":\"QUICK_WAP_WAY\"," .
            "  }";
        $request->setNotifyUrl($urlConfig['notify_url']);
        $request->setBizContent($request_body);
        //这里和普通的接口调用不同，使用的是sdkExecute
        $response = $aop->pageExecute($request);

        //htmlspecialchars是为了输出到页面时防止被浏览器将关键参数html转义，实际打印到日志以及http传输不会有这个问题
        return ['resp'=>$response];//就是orderString 可以直接给客户端请求，无需再做处理。
    }

}