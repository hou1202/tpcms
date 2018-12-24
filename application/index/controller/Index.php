<?php
namespace app\index\controller;
use app\common\controller\BaseController;

use app\common\model\Banner;
use app\common\model\Recom;
use app\common\model\Goods;

use think\facade\Config;
use think\facade\Env;
use think\Request;
use think\Db;
use app\index\model\Index as User;
use app\index\common\Users;


class Index extends BaseController
{

    public function index()
    {
        $banner = Banner::where('status',1)->all();
        $recom = Recom::where('status',1)->all();
        $goods = Goods::where('status',1)->where('recom',1)->all();
        $this->assign('Banner',$banner);
        $this->assign('Recom',$recom);
        $this->assign('Goods',$goods);
        return view('/index');
    }

    public function goods(){
        $a=Db::name('goods')->find(3);
        //$a['content'] = html_entity_decode($a['content']);
        $this->assign('goods',$a);
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
