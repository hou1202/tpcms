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
    /**
     * 微信网页支付 获取参数接口
     * @param   $payAmount  float    支付金额
     * @param   $orderNumber    string      订单编号
     * @param   $msg    string      订单交易标题
     * @param   $timeout    string     订单超时时间,单位：秒,样例：‘30’
     * @return string
     */
    public function pay($payAmount, $orderNumber, $msg, $timeout=30)
    {
        $appid = '';            //微信分配的公众账号ID
        $mch_id = '1457831502';            //微信支付商户号
        $mch_key = '';              //微信商户API密钥
        $notify_url = '';            //微信支付异步通知回调地址
        $trade_type = 'MWEB';            //H5支付的交易类型为MWEB
        //场景信息：type=》场景类型；wap_url=》WAP网站URL地址；wap_name=》网站名
        $scene_info = '{"h5_info": {"type": "Wap","wap_url": "www.aoogi.com","wap_name": "Aoogi商城"}}';
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";//微信传参地址

        $nonce_str = $this->createNoncestr();            //随机字符串，不长于32位
        $body = '';            //商品简单描述
        $out_trade_no = $orderNumber;            //商户系统内部的订单号
        $total_fee = $payAmount*100;            //订单总金额，单位为分
        $spbill_create_ip = $this->getClientIp();            //用户端IP

        $signA ="appid=$appid&attach=$out_trade_no&body=$body&mch_id=$mch_id&nonce_str=$nonce_str&notify_url=$notify_url&out_trade_no=$out_trade_no&scene_info=$scene_info&spbill_create_ip=$spbill_create_ip&total_fee=$total_fee&trade_type=$trade_type";
        //拼接字符串  注意顺序微信有个测试网址 顺序按照他的来 直接点下面的校正测试 包括下面XML  是否正确
        $strSignTmp = $signA."&key=$mch_key";
        //签名
        $sign = strtoupper(MD5($strSignTmp)); // MD5 后转换成大写

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
        $dataxml = $this->postXmlCurl($post_data,$url,$timeout);
        //将微信返回的XML 转换成数组
        $objectxml = (array)simplexml_load_string($dataxml, 'SimpleXMLElement', LIBXML_NOCDATA);





    }


    /**
     * createNoncestr   生成随机字符串
     * @param   $length int  字符串长度，默认32位
     * @return  string
     */
    private function createNoncestr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    /**
     * postXmlCurl  POST信息发送
     * @param   $xml string  发送信息
     * @param   $url string  发送地址
     * @param   $second int  超时时间
     * @return string
     */
    private function postXmlCurl($xml,$url,$second){
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if($data){
            curl_close($ch);
            return $data;
        }else{
            $error = curl_errno($ch);
            curl_close($ch);
            echo "curl出错，错误码:$error"."<br>";
        }
    }

    /**
     * getClientIp  获取客户端真实IP
     */
    public function getClientIp($type = 0) {
        $type       =  $type ? 1 : 0;
        $ip         =   'unknown';
        if ($ip !== 'unknown') return $ip[$type];
        if(isset($_SERVER['HTTP_X_REAL_IP'])){//nginx 代理模式下，获取客户端真实IP
            $ip=$_SERVER['HTTP_X_REAL_IP'];
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {//客户端的ip
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {//浏览当前页面的用户计算机的网关
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];//浏览当前页面的用户计算机的ip地址
        }else{
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }

}