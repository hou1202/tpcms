<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
//


//设置全局变量规则
Route::pattern([
    'id'   => '\d+',
    'goods_id'  => '\d+',
    'coupon_id'  => '\d+',
    'address_id'  => '\d+',
    'order_id'  => '\d+',

]);

/*
 *
 * 前端路由处理模块
 *
 * */


//登录Route
Route::get('login','index/login/index');
Route::post('login','index/login/login');
Route::get('logout','index/login/logout');
Route::get('register','index/register/index');
Route::post('register','index/register/register');
Route::get('forget','index/forget/index');
Route::post('forget','index/forget/forget');

/*产品路由*/
    Route::get('goods/index/:id','index/goods/index');               //产品列表
    Route::get('goods/:id','index/Goods/detail');               //产品详情
    Route::post('whether/:id','index/collect/whether');     //收藏产品
    Route::post('agree/:id','index/collect/agree');           //评论点赞
    Route::get('goods/pageData/:id/:page/:limit','index/goods/pageData');           //分页产品数据



    //分类页面
    Route::get('classify','index/classify/index')->except(['read']);

    //购物车Route
    Route::get('car','index/car/index');
    Route::delete('car/:id','index/car/delete');
    Route::post('join/:goods_id','index/car/join');           //加入购物车
    Route::post('purchase/:goods_id','index/order/purchase');           //立即购买

    Route::post('buy','index/order/buy');           //下单
    Route::get('balance/:id/[:coupon_id]/[:address_id]','index/order/balance');    //订单结算页面
    Route::get('address/select/:id/:coupon_id','index/address/select');       //下单选择地址
    Route::get('coupon/select/:id/:address_id','index/coupon/select');       //下单选择优惠券
    Route::post('payment/:order_id','index/order/payment');         //生成支付订单
    Route::get('pay/:id/:type','index/order/pay');         //生成支付订单

    Route::get('pay/warn','index/pay/payWarn');             //支付异常
    Route::get('pay/error','index/pay/payError');           //支付失败
    Route::get('pay/success','index/pay/paySuccess');           //支付失败
    Route::get('pay/revert','index/pay/payReturn');         //同步跳转-支付成功
    Route::post('pay/notify','index/notify/payNotify');     //支付宝异步通知地址



/*个人中心*/
    Route::get('personal','index/personal/index');     //个人主页
    Route::resource('address','index/address')->except(['read']);     //收货地址
    Route::post('address/choice/:id','index/address/choice');       //默认收货地址设置

    Route::get('collect','index/collect/index');        //我的收藏
    Route::get('integral','index/personal/integral');        //我的积分
    Route::post('integral/data/:page/:limit','index/personal/integralData');           //我的积分数据
    Route::get('wallet','index/personal/wallet');        //我的积分
    Route::post('wallet/data/:page/:limit','index/personal/walletData');           //我的积分数据

    //优惠券
    Route::get('receives','index/coupon/receives');     //领取优惠券列表
    Route::post('receives/:id','index/coupon/collar');     //领取优惠券
    Route::get('coupon','index/coupon/index');     //我的优惠券列表
    Route::post('coupon/:type','index/coupon/getData')->pattern(['type'=> '\d+',]);     //我的优惠券列表数据

    //订单列表

    Route::post('order/pageData/:status/:page/:limit','index/order/pageData')->pattern(['status'=> '\d+',]);           //分页订单数据
    Route::get('order/read/:id','index/order/read');         //订单详情
    Route::delete('order/:id','index/order/delete');     //取消订单
    Route::put('order/:id','index/order/receipt');       //确认订单
    Route::get('order/[:type]','index/order/index')->pattern(['type'=> '\d+',]);     //订单列表,备注：路由中有可选参数，此条路由应该放在ORDER类路由中最后面
    Route::get('comments/:id','index/Comments/index');      //写评论
    Route::post('comments/:id','index/Comments/save');    //提交评论
    Route::get('replace/:id','index/order/replace');      //写评论



//测试页面
Route::get('test','index/test/index');


//重置Token
Route::post('resetToken','index/SelfFunction/resetToken');
//获取验证码处理
Route::post('/getCode/:mobile/:type/[:over]','index/Verify/getCode');





Route::get('/','index/index/index');
Route::get('/details','index/index/goods');
/*Route::get('/balance','index/index/balance');*/
/*Route::get('/pay','index/index/pay');*/
Route::get('/list','index/index/goodsList');
Route::get('/personal','index/index/personal');
Route::get('/data','index/index/personalData');


Route::get('/orderDetails','index/index/orderDetails');


Route::get('/wallet','index/index/wallet');


Route::post('/post','index/index/post');
Route::rule('/','index/index','get');
Route::get('hello','index/index/hello');



//图片上传处理
Route::get('uploader','admin/Uploader/uploader');








return [

];
