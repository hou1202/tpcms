<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/12/14
 * Time: 9:30
 */

/*
 * 后台管理模块路由-admin
 * 后台管理模块路由约定使用aoogi前缀
 * 例： aoogi/*
 * */

//设置全局变量规则
Route::pattern([
    'id'   => '\d+',
]);

Route::get('setting','admin/set/index');
Route::get('table_two','admin/set/tableTwo');

//主体框架加载Route
Route::get('/admin','admin/home/home');
Route::get('aoogi/main','admin/home/main');
Route::post('aoogi/logout','admin/home/logout');
Route::get('aoogi/menu','admin/home/menu');                   //导航栏加载
Route::post('aoogi/opts','admin/home/opts');                   //导航栏加载
Route::get('aoogi/error','admin/error/index');      //ERROR页面

//登录Route
Route::get('adminLogin','admin/login/index');
Route::post('adminLogin','admin/login/login');

//管理员adminer管理Route
Route::resource('aoogi/adminer','admin/admin')->rest('edit',['GET', '/edit/:id','edit']);
Route::post('aoogi/adminer/data','admin/admin/getData');
Route::post('aoogi/adminer/status','admin/admin/setStatus');

//路由router管理Route
Route::resource('aoogi/router','admin/router')->rest('edit',['GET', '/edit/:id','edit']);
Route::post('aoogi/router/data','admin/router/getData');
Route::post('aoogi/router/status','admin/router/setStatus');

//权限permission管理Route
Route::resource('aoogi/permission','admin/permission')->rest('edit',['GET', '/edit/:id','edit']);
Route::post('aoogi/permission/data','admin/permission/getData');
Route::post('aoogi/permission/status','admin/permission/setStatus');

//参数config设置模块Route
Route::resource('aoogi/config','admin/config')->rest('edit',['GET', '/edit/:id','edit'])->except(['read']);
Route::post('aoogi/config/data','admin/config/getData');

//产品goods管理Route
Route::resource('aoogi/goods','admin/goods')->rest('edit',['GET', '/edit/:id','edit']);
Route::post('aoogi/goods/data','admin/goods/getData');
Route::post('aoogi/goods/status','admin/goods/setStatus');
Route::post('aoogi/goods/recom','admin/goods/setRecom');
Route::delete('aoogi/goods/delOld/:id/:mode','admin/goods/delOld')->pattern(['mode' => '[1|2]']);   // 删除产品规格/参数    mode    1=>spec;2=>param

//Banner管理Route
Route::resource('aoogi/banner','admin/banner')->rest('edit',['GET', '/edit/:id','edit'])->except(['read']);
Route::post('aoogi/banner/data','admin/banner/getData');
Route::post('aoogi/banner/status','admin/banner/setStatus');

//分类classify管理Route
Route::resource('aoogi/classify','admin/classify')->rest('edit',['GET', '/edit/:id','edit'])->except(['read']);
Route::post('aoogi/classify/data','admin/classify/getData');
Route::post('aoogi/classify/status','admin/classify/setStatus');

//推荐recom管理Route
Route::resource('aoogi/recom','admin/recom')->rest('edit',['GET', '/edit/:id','edit'])->except(['read']);
Route::post('aoogi/recom/data','admin/recom/getData');
Route::post('aoogi/recom/status','admin/recom/setStatus');

//用户User管理Route
Route::resource('aoogi/user','admin/user')->rest('edit',['GET', '/edit/:id','edit'])->except(['create','save']);
Route::post('aoogi/user/data','admin/user/getData');
Route::post('aoogi/user/status','admin/user/setStatus');

//图片上传处理
Route::post('uploader/[:genre]','admin/Uploader/uploader')->pattern(['genre' => '1']);


return [

];