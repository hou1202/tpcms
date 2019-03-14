<?php

namespace app\common\controller;

use think\Controller;


class BaseController extends Controller
{

    /*
     * 返回成功模式下JSON格式的数据
     * @param  string     $data       数据源
     * @param  string     $url        跳转路由
     * @return      json
     * */
    protected function successJson($msg,$url='',$data='')
    {
        $res = [
            'msg' => $msg,
            'url' => $url,
            'data' => $data,
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
    protected function failJson($msg,$url='',$data='')
    {
        $res = [
            'msg' => $msg,
            'url' => $url,
            'data' => $data,
            'code' => 0,
        ];
        return json($res);
    }

    protected function apiJson($data, $code=200)
    {
        return json($data)->code($code)->header(['Access-Control-Allow-Origin'=>'*']);
    }
}
