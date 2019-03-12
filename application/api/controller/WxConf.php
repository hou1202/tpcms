<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/2/15
 * Time: 14:36
 */

namespace app\api\controller;

/**
  * 配置类
  */
class WxConf
{

     //微信公众号身份的唯一标识。
     const APPID = 'wx654a22c6423213b7';
     //受理商ID，身份标识
     const MCHID = '10043241';
     const MCHNAME = 'Aoogi商城系统';

     //商户支付密钥Key。
     const KEY = '0000000000000000000000000000000';
     //JSAPI接口中获取openid
     const APPSECRET = '000000000000000000000000000';

     //证书路径,注意应该填写绝对路径
     const SSLCERT_PATH = '/home/WxPayCacert/apiclient_cert.pem';
     const SSLKEY_PATH = '/home/WxPayCacert/apiclient_key.pem';
     const SSLCA_PATH = '/home/WxPayCacert/rootca.pem';

     //本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
     const CURL_TIMEOUT = 30;
}