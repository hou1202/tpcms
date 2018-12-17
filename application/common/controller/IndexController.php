<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/12/14
 * Time: 9:15
 */


namespace app\common\controller;



class IndexController extends BaseController
{
    //用户资料
    protected $user_info;


    //控制器验证中间键
    protected $middleware = ['UserVerify'];





}