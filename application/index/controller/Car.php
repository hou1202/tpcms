<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/17
 * Time: 22:04
 */

namespace app\index\controller;


use app\common\controller\IndexController;

class Car extends IndexController
{

    public function index(){
        return view('/car/car');
    }
}