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

    public function indexGoods($page, $limit)
    {
        $field = ['id','title','info','thumbnail','sell_price','origin_price'];
        $where['status'] = ['=', '1'];
        $where['recom'] = ['=', '1'];
        $goods = Db::table('goods')->field($field)->whereOr($where)->order('id desc')->limit($page,$limit)->select();
        $surplus = true;
        if(count($goods) < $limit){
            $surplus = false;
        }
        $data = [
            'res' => $goods,
            'surplus' => $surplus,
        ];
        return $this->apiJson($data);
    }
}