<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/9
 * Time: 16:46
 */

namespace app\index\controller;

use app\common\controller\BaseController;
use app\common\model\CouponUser;
use app\common\model\Order;
use think\Db;
use think\facade\Cache;
use think\Request;
use think\facade\Env;
use think\Loader;

use think\facade\Config;


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

        $order = Order::where('serial',$data['out_trade_no'])->find();    //平台交易流水号

        if($result && $order && $order->pay_price == $data['total_amount'] && $data['app_id'] == $aliConfig['app_id'] && $data['seller_id'] == $aliConfig['seller_id']){//验证成功

            if($order->pay_status == 0){
                //更新订单数据
                $order->trade_no = $data['trade_no'];
                $order->pay_type = 1;
                $order->pay_status = 1;
                $order->status = 2;
                $order->save();
                //更新用户优惠券状态
                if(!empty($order->coupon_id)){
                    $coupon = CouponUser::where('user_id',$order->user_id)->where('coupon_id',$order->coupon_id)->find();
                    $coupon->order_id = $order->id;
                    $coupon->status = 2;
                    $coupon->save();
                }
                //更新用户积分状态
                Db::table('user')->where('id',$order->user_id)->setInc('integral',$order->integral);
            }

            return view('order/success');
        }else{
            return view('order/warn');

        }

    }

    public function payError()
    {
        return view('order/error');
    }

    public function payWarn()
    {
        return view('order/warn');


    }



}