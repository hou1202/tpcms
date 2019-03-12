<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/2/15
 * Time: 11:26
 */

namespace app\api\controller;


 /* *
 * 所有接口的基类
 * */
class WxApiBase
{

    public function trimString($value)
    {
        $ret = null;
        if(null != $value) {
            $ret = trim($value);
            if(strlen($ret) == 0 ) {
                $ret = null;
            }
        }
        return $ret;
    }

    /**
     * 产生随机字符串，不长于32位
     * @param $length int   字条串长度
     * @return string
     */
    public function createNoncestr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    /**
     * 格式化参数 拼接字符串，签名过程需要使用
     * @param $urlParams    string
     * @param $needUrlEncode string
     * @return string
     */
    public function toUrlParams($urlParams, $needUrlEncode)
    {
        $buff = '';
        ksort($urlParams);
        foreach($urlParams as $k=>$v) {
            if($needUrlEncode) $v = urlencode($v);
            $buff .= $k .'='. $v .'&';
        }

        $reqString = '';
        if(strlen($buff) > 0) {
            $reqString = substr($buff, 0, strlen($buff) - 1);
        }

        return $reqString;
    }

    /**
     * 生成签名
     */
    public function getSign($obj)
    {
        foreach($obj as $k=>$v) {
            $params[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($params);
        $str = $this->ToUrlParams($params, false);
        //签名步骤二：在$str后加入key
        //$str = $str."$key=".WxPayConf::KEY;
        $str = $str."key=".WxPayConf::KEY;
        //签名步骤三：md5加密
        $str = md5($str);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($str);

        return $result;
    }

    /**
     * array转xml
     * @param   $arr    array
     * @return  string
     */
    public function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach($arr as $k => $v) {
            if(is_numeric($v)) {
                $xml .= "<".$k.">".$k."</".$k.">";
            } else {
                $xml .= "<".$k."><![CDATA[".$v."]]></".$k.">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    /**
     * 将xml转为array
     * @param   $xml    string
     * @return  array
     */
    public function xmlToArray($xml)
    {
        $arr = json_decode(json_encode(simplexml_load_string($xml, 'SinpleXMLElement', LIBXML_NOCDATA)), true);
        return $arr;
    }

    /**
     * 以post方式提交xml到对应的接口
     * @param   $xml    string
     * @param   $url    string
     * @param   $second    int
     *
     */
    public function postXmlCurl($xml, $url, $second = 30)
    {

        //初始化curl

        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch,CURLOPT_URL, $url);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        //设置header
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //以post方式提交
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //执行curl
        $res = curl_exec($ch);
        //返回结果
        if($res){
            curl_close($ch);
            return $res;
        }else{
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error"."<br>";
            curl_close($ch);
            return false;

        }
    }

}