<?php

/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/30
 * Time: 17:50
 */
namespace app\api\controller;

class WxPay
{
    public function pay()
    {
        $appid = '';            //微信分配的公众账号ID
        $mch_id = '1457831502';            //微信支付商户号
        $mch_key = '';              //微信商户API密钥
        $notify_url = '';            //微信支付异步通知回调地址
        $trade_type = 'MWEB';            //H5支付的交易类型为MWEB
        //场景信息：type=》场景类型；wap_url=》WAP网站URL地址；wap_name=》网站名
        $scene_info = '{"h5_info": {"type": "Wap","wap_url": "www.aoogi.com","wap_name": "Aoogi商城"}}';
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";//微信传参地址

        $nonce_str = '';            //随机字符串，不长于32位
        $sign = '';            //签名
        $body = '';            //商品简单描述
        $out_trade_no = '';            //商户系统内部的订单号
        $total_fee = '';            //订单总金额，单位为分
        $spbill_create_ip = '';            //用户端IP

        //拼接成XML 格式
        $post_data = "<xml>
                            <appid>$appid</appid>
                            <body>$body</body>
                            <mch_id>$mch_id</mch_id>
                            <nonce_str>$nonce_str</nonce_str>
                            <notify_url>$notify_url</notify_url>
                            <out_trade_no>$out_trade_no</out_trade_no>
                            <spbill_create_ip>$spbill_create_ip</spbill_create_ip>
                            <total_fee>$total_fee</total_fee>
                            <trade_type>$trade_type</trade_type>
                            <scene_info>$scene_info</scene_info>
                            <sign>$sign</sign>
                        </xml>";

        //后台POST微信传参地址  同时取得微信返回的参数
        $dataxml = postXmlCurl($post_data,$url);



    }

}