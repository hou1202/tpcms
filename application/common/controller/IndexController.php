<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/12/14
 * Time: 9:15
 */


namespace app\common\controller;
use app\index\common\Users;


class IndexController extends BaseController
{

    //控制器验证中间键
    protected $middleware = ['UserVerify'];

    //用户资料
    protected $user_info;

    /**
     * 是否已初始化
     * var boolean
     */
    protected $handler = false;

    /**
     * 初始化
     */
    protected function initialize(){
        $this->user_info = Users::user();
        $this->handler = true;  // 标记为初始化成功
    }





}