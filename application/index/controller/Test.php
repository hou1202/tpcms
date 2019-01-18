<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/9
 * Time: 11:48
 */

namespace app\index\controller;
use think\Db;
use think\facade\Config;
use app\common\controller\Alipay;

use app\common\controller\BaseController;
use think\facade\Env;

class Test extends BaseController
{
    public function index()
    {

        for($i=0;$i<20;$i++){
            $type = ['+','-'];
            $type_keys=array_rand($type,1);
            $data = [
                'user_id'=>2,
                'title'=>'累积'.rand(1000,9999),
                'integral'=>rand(10,999),
                'type'=>$type[$type_keys],
            ];
            Db::table('log_integral')->insert($data);
        }

    }
}