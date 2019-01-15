<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/14
 * Time: 18:11
 * 支付宝支付异步返回通知页面
 */

namespace app\index\controller;

use think\facade\Cache;
use think\Request;
use think\Loader;
use think\facade\Env;
use think\facade\Config;

use app\common\model\Order;



class Notify
{
    public function payNotify(Request $request)
    {
        $data = $request->param();

        //加载支付宝扩展文件
        Loader::addAutoLoadDir(Env::get('extend_path').'alipay'.DS.'wappay'.DS.'service'.DS);
        Loader::autoload('AlipayTradeService');

        $aliConfig = Config::get('alipay_config');

        $alipaySevice = new \AlipayTradeService($aliConfig);
        $alipaySevice->writeLog(var_export($_POST,true));
        $result = $alipaySevice->check($data);

        /**
         * 实际验证过程建议商户添加以下校验。
         *  1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
         *  2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
         *  3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
         *  4、验证app_id是否为该商户本身。
         */
        $order = Order::where('serial',$data['out_trade_no'])    //平台交易流水号
                        ->find();

        if($result && $order && $order->pay_price == $data['total_amount'] && $data['seller_id'] == $aliConfig['seller_id'] && $data['app_id'] == $aliConfig['app_id']) {//验证成功

            if($request->param('trade_status') == 'TRADE_FINISHED') {
                if(empty($order['trade_no']) && $order['status'] == 1){
                    $order->trade_no = $data['trade_no'];
                    $order->pay_type = 1;
                    $order->status = 2;
                    $order->save();
                }

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序

                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            }
            else if ($request->param('trade_status') == 'TRADE_SUCCESS') {
                if(empty($order['trade_no']) && $order['status'] == 1){
                    $order->trade_no = $data['trade_no'];
                    $order->pay_type = 1;
                    $order->status = 2;
                    $order->save();
                }
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }


            echo "success";		//请不要修改或删除
        }else{
            //验证失败
            echo "fail";	//请不要修改或删除

        }
    }

}