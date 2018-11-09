<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/10/19
 * Time: 9:55
 */

namespace app\common\controller;


use think\Controller;

class AdminController extends Controller
{

    /*
     * init     初始化操作
     * */

    protected function init()
    {

    }


    /*
     * 返回JSON格式的数据
     * @param       $data       数据源
     * @param       $count      数据总数量
     * @param       $code
     * @return      json
     * */
    protected function returnJson($data,$count,$code=0)
    {
        $res = [
            'code' => $code,
            'count' => $count,
            'data' => $data,
        ];
        return json($res);
    }


}