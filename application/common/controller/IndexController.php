<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/12/14
 * Time: 9:15
 */


namespace app\common\controller;


use think\Controller;
class IndexController extends Controller
{
    //用户资料
    protected $user_info;


    //控制器验证中间键
    //protected $middleware = ['Authority'];

    /*
     * 返回JSON格式的数据
     * @param  string     $data       数据源
     * @param  number     $code       1=》成功；0=》失败
     * @param  string     $url        跳转路由
     * @return      json
     * */
    protected function returnJson($data,$code=1,$url='')
    {
        $res = [
            'data' => $data,
            'code' => $code,
            'url' => $url,
        ];
        return json($res);
    }



}