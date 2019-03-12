<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/2/15
 * Time: 10:04
 */

namespace app\api\controller;


class WxNotify
{
    public function notify()
    {
        $postData = '';
        if(file_get_contents('php://input')){
            $postData = file_get_contents('php://input');
        }else{
            return;
        }
        $payInfo = array();
        $notify = $this->wxpay_model->wxPayNotify($postData);
    }

    public function wxPayNotify($xml)
    {
        $notify = new Wxpay_server();
    }
}