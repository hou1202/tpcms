<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/18
 * Time: 16:49
 */

namespace app\index\controller;


use app\common\controller\IndexController;

class Comments extends IndexController
{
    public function index($id)
    {
        return view('personal/comments');
    }

}