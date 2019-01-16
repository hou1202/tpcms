<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/9
 * Time: 16:46
 */

namespace app\index\controller;

use app\common\controller\BaseController;
use app\common\model\Order;
use think\facade\Cache;
use think\Request;
use think\facade\Env;
use think\Loader;

use think\facade\Config;
use app\common\model\Config as ConfigM;

class Pay extends BaseController
{

    public function payReturn(Request $request)
    {

        $data = $request->param();
        //加载支付宝扩展文件
        Loader::addAutoLoadDir(Env::get('extend_path').'alipay'.DS.'wappay'.DS.'service'.DS);
        Loader::autoload('AlipayTradeService');

        $aliConfig = Config::get('alipay_config');
        $alipaySevice = new \AlipayTradeService($aliConfig);
        $result = $alipaySevice->check($data);

        /**
         * 实际验证过程建议商户添加以下校验。
         *  1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
         *  2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
         *  3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
         *  4、验证app_id是否为该商户本身。
         */

        if($result){//验证成功
            $order = Order::where('serial',$data['out_trade_no'])    //平台交易流水号
                            ->find();
            /*var_dump($data);
            var_dump($aliConfig);
            var_dump($order);die;*/

            if($order && $order->pay_price == $data['total_amount'] && $data['app_id'] == $aliConfig['app_id']){
                /*$order->trade_no = $data['trade_no'];
                $order->pay_type = 1;*/
                /*$order->comment = $data['trade_no'];
                $order->save();         //更新订单数据*/
                return view('order/success');
            }else{
                return view('order/error');
            }


        }else{
            return view('order/error');

        }

    }

    public function payError(Request $request)
    {
        return view('order/error');
    }

    public function paySuccess(Request $request)
    {
        var_dump(Cache::get('pay_result'));
        //var_dump($request->param());
        var_dump('success');die;
        //return view('order/success');
    }



}