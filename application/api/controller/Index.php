<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/3/12
 * Time: 11:36
 */

namespace app\api\controller;
use think\Db;

use app\common\controller\BaseController;

class Index extends BaseController
{
    public function banner()
    {
        $bannerWhere[] = ['status', '=', '1'];
        $banner = Db::table('banner')->where($bannerWhere)->select();
        $data = [
            'code' => 1,
            'success' => true,
            'data' => $banner
        ];
        return json($data);
    }
}