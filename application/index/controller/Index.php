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

    public function _empty(){
        return 'this is a empty aciton';
    }
    public function index()
    {
        //return redirect('/test');

        return Config::get('error_message');
        //return env('root_path');
        //return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function hello($name = 'ThinkPHP5')
    {
        //return 'hello,' . $name;
        //$user = new \app\index\model\Index();
        //$all = $user -> all();
        $user = User::get(1);
        //var_dump($user);die;
        $a = User::where('id = 1')->column('mobile');
        var_dump($a);die;
        $data = [
            'mobile' => '18297905432'
        ];
        $user ->data($data) -> save();
        var_dump($user -> get(1));
    }

    public function test(){
        $data = [
          'title' => 'TPCMS',
          'date' => date('Y-m-d H:i:s'),
          'author' => 'Hou'
        ];
        $arr = 'this is a data response';
        //return response()->data($arr,301);
        $a = Db::field('order.user_id , sign.sign_date')
            ->table('p_order order , p_user_sign sign')
            ->select();
        $resource = Db::name('order')->field('id,user_id,other_count,total_count')->group('user_id')->select();
        var_dump($resource);
        //return Env::get('root_path');
        //return redirect('hello');
        //return $this->success('this is redirect','index/index/hello');
        //return redirect('index/index/hello');
        //var_dump($request->param());
    }
}
