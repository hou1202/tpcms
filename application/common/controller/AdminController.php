<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/10/19
 * Time: 9:55
 */

namespace app\common\controller;


use think\Controller;
use think\facade\Cookie;

class AdminController extends Controller
{

    protected $middleware = ['Auth'];

    /*
     * init     初始化操作
     * */
    /*protected function initialize()
    {
        if(!Cookie::has('admin_account')){
            //var_dump(213);die;
            return redirect('/login');
            //die;
        }

    }*/


    /*
     * 返回kit_admin列表数据返回JSON格式的数据
     * @param       $data       数据源
     * @param       $count      数据总数量
     * @param       $code
     * @return      json
     * */
    protected function kitJson($data,$count,$code=0)
    {
        $res = [
            'code' => $code,
            'count' => $count,
            'data' => $data,
        ];
        return json($res);
    }

    /*
     * 返回kit_admin列表数据返回JSON格式的数据
     * @param       $data       数据源
     * @param       $url        跳转路由
     * @param       $code       1=》成功；0=》失败
     * @return      json
     * */
    protected function returnJson($data,$code=1,$url)
    {
        $res = [
            'code' => $code,
            'url' => $url,
            'data' => $data,
        ];
        return json($res);


    }


}