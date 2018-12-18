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

        return view('/index');
    }

    public function goods(){
        return view('/details');
    }

    public function car(){
        return view('/car');
    }

    public function balance(){
        return view('/balance');
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
        return view('/personal/data');
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
    public function collect(){
        return view('/collect');
    }
    public function wallet(){
        return view('/wallet');
    }
    public function integral(){
        return view('/integral');
    }

    public function login(){
        return view('/login');
    }

    public function register(){
        return view('/register');
    }
    public function forget(){
        return view('/forget');
    }

    public function post(Request $request){
        var_dump($request->post());
    }

    public function hello($name = 'ThinkPHP5')
    {

    }


}
