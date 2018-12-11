<?php
namespace app\index\controller;
use app\common\controller\BaseController;
use think\facade\Config;
use think\facade\Env;
use think\Request;
use think\Db;
use app\index\model\Index as User;


class Index extends BaseController
{

    public function index()
    {
        //return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
        return view('/index');
    }

    public function goods(){
        return view('/details');
    }

    public function car(){
        return view('/car');
    }

    public function pay(){
        return view('/pay');
    }

    public function category(){
        return view('/category');
    }

    public function goodsList(){
        return view('/list');
    }

    public function personal(){
        return view('/personal');
    }
    public function personalData(){
        return view('/data');
    }
    public function address(){
        return view('address/address');
    }

    public function addressCreate(){
        return view('address/create');
    }

    public function order(){
        return view('order/index');
    }
    public function orderDetails(){
        return view('order/details');
    }
    public function coupon(){
        return view('coupon/index');
    }

    public function post(Request $request){
        var_dump($request->post());
    }

    public function hello($name = 'ThinkPHP5')
    {

    }


}
