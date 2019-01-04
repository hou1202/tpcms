<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
//

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
    Route::post('car/join/:goods_id','index/car/join')->pattern(['goods_id'=> '\d+',]);           //加入购物车
    Route::post('car/buy/:goods_id','index/car/buy')->pattern(['goods_id'=> '\d+',]);           //立即购买

    //分类页面
    Route::get('classify','index/classify/index')->except(['read']);

    //购物车Route
    Route::get('car','index/car/index');


/*个人中心*/
    Route::get('personal','index/personal/index');     //个人主页
    Route::resource('address','index/address')->except(['read']);     //收货地址
    Route::post('address/choice/:id','index/address/choice');







//重置Token
Route::post('resetToken','index/SelfFunction/resetToken');
//获取验证码处理
Route::post('/getCode/:mobile/:type/[:over]','index/Verify/getCode');





Route::get('/','index/index/index');
Route::get('/details','index/index/goods');
Route::get('/balance','index/index/balance');
Route::get('/pay','index/index/pay');
Route::get('/list','index/index/goodsList');
Route::get('/personal','index/index/personal');
Route::get('/data','index/index/personalData');


Route::get('/order','index/index/order');
Route::get('/orderDetails','index/index/orderDetails');
Route::get('/coupon','index/index/coupon');
Route::get('/collect','index/index/collect');
Route::get('/wallet','index/index/wallet');
Route::get('/integral','index/index/integral');

Route::post('/post','index/index/post');
Route::rule('/','index/index','get');
Route::get('hello','index/index/hello');



//图片上传处理
Route::get('uploader','admin/Uploader/uploader');








return [

];
