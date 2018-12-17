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

//个人中心
Route::get('/personal','index/personal/index');


//重置Token
Route::post('resetToken','index/SelfFunction/resetToken');
//获取验证码处理
Route::post('/getCode/:mobile/:type/[:over]','index/Verify/getCode');





Route::get('/','index/index/index');
Route::get('/details','index/index/goods');
Route::get('/car','index/index/car');
Route::get('/balance','index/index/balance');
Route::get('/pay','index/index/pay');
Route::get('/category','index/index/category');
Route::get('/list','index/index/goodsList');
Route::get('/personal','index/index/personal');
Route::get('/data','index/index/personalData');
Route::get('/address','index/index/address');
Route::get('/addressCreate','index/index/addressCreate');
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
Route::post('/upLoader','index/uploader/uploader');








return [

];
