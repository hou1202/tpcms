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

        /*临时处理图片URL*/
        foreach($banner as &$value){
            $value['thumbnail'] = 'http://www.aoogi.com'.$value['thumbnail'];
        }

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

        /*临时处理图片URL*/
        foreach($recomm as &$value){
            $value['thumbnail'] = 'http://www.aoogi.com'.$value['thumbnail'];
        }

        return $this->apiJson($recomm);

    }

    public function indexGoods($page, $limit)
    {
        $field = ['id','title','info','thumbnail','sell_price','origin_price'];
        $where['status'] = ['=', '1'];
        $where['recom'] = ['=', '1'];
        $goods = Db::table('goods')->field($field)->whereOr($where)->order('id desc')->limit($page,$limit)->select();

        /*临时处理图片URL*/
        foreach($goods as &$value){
            $value['thumbnail'] = 'http://www.aoogi.com'.$value['thumbnail'];
        }
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

    public function goodsDetails($id)
    {
        $field = ['id','title','info','thumbnail','banner','origin_price','sell_price','franking','volume','address','content'];
        $where['status'] = ['=', 1];
        $wehre['id'] = ['=', $id];
        $details = Db::table('goods')->field($field)->where($where)->find();
        $details['banner'] = explode('-',$details['banner']);

        /*临时处理图片URL*/
        $details['thumbnail'] = 'http://www.aoogi.com'.$details['thumbnail'];
        foreach($details['banner'] as &$value){
            $value = 'http://www.aoogi.com'.$value;
        }

        $params = Db::table('goods_param')->where('goods_id',$id)->select();
        $spec = Db::table('goods_spec')->where('goods_id',$id)->select();
        $resource = [
            'detail' => $details,
            'params' => $params,
            'spec' => $spec
        ];
        return $this->apiJson($resource);
    }
}