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
     * 返回成功模式下JSON格式的数据
     * @param  string     $data       数据源
     * @param  string     $url        跳转路由
     * @return      json
     * */
    protected function successJson($data,$url='')
    {
        $res = [
            'data' => $data,
            'url' => $url,
            'code' => 1,
        ];
        return json($res);
    }

    /*
 * 返回失败模式下JSON格式的数据
 * @param  string     $data       数据源
 * @param  string     $url        跳转路由
 * @return      json
 * */
    protected function failJson($data,$url='')
    {
        $res = [
            'data' => $data,
            'url' => $url,
            'code' => 0,
        ];
        return json($res);
    }



}