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
            'success' => true,
            'data' => $banner,
        ];
        return json($banner)->code(200)->header(['Access-Control-Allow-Origin'=>'*']);
    }

    public function recom()
    {
        $recomWhere[] = ['status', '=', '1'];
        $recomm = Db::table('recom')->where($recomWhere)->select();
        return $this->apiJson($recomm);

    }
}