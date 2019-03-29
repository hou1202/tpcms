<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/3/12
 * Time: 11:42
 */

//API接口访问路由

Route::get('api/index/banner','api/index/banner');
Route::get('api/index/recom','api/index/recom');
Route::get('api/index/indexGoods/:page/:limit','api/index/indexGoods');
Route::get('api/index/goods/:id/[:user_id]','api/index/goodsDetails');
Route::get('api/index/goodsSpec/:id','api/index/getGoodsSpec');
Route::get('api/index/classify/:id','api/index/getClassify');
Route::get('api/index/goodsClassifyList/:classify_id/:page/:limit','api/index/getGoodsClassifyList');
Route::get('api/index/shoppingCart/:id','api/index/getShoppingCart');
