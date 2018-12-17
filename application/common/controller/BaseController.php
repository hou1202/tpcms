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
