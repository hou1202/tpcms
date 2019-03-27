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
            if(empty(strstr($value['thumbnail'],'http://www.'))){
                $value['thumbnail'] = 'http://www.aoogi.com'.$value['thumbnail'];
            }
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
            if(empty(strstr($value['thumbnail'],'http://www.'))){
                $value['thumbnail'] = 'http://www.aoogi.com'.$value['thumbnail'];
            }
        }

        return $this->apiJson($recomm);

    }

    public function indexGoods($page, $limit)
    {
        $field = ['id','title','info','thumbnail','sell_price','origin_price'];
        $where = [
            ['status','=', 1],
            ['recom','=', 1],
            ['delete_time','=', 0],
        ];
        $goods = Db::table('goods')->field($field)->where($where)->order('id desc')->limit($page*$limit,$limit)->select();

        /*临时处理图片URL*/
        foreach($goods as &$value){
            if(empty(strstr($value['thumbnail'],'http://www.'))){
                $value['thumbnail'] = 'http://www.aoogi.com'.$value['thumbnail'];
            }
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

    public function goodsDetails($id, $user_id='')
    {
        $field = ['id','title','info','thumbnail','banner','origin_price','sell_price','franking','volume','address','content'];
        $where = [
            ['status','=', 1],
            ['id','=', $id],
            ['delete_time','=', 0]
        ];

        /*产品详情*/
        $details = Db::table('goods')->field($field)->where($where)->find();
        $details['banner'] = explode('-',$details['banner']);
        $details['content'] = html_entity_decode($details['content']);

        /*临时处理图片URL*/
        if(empty(strstr($details['thumbnail'],'http://www.'))){
            $details['thumbnail'] = 'http://www.aoogi.com'.$details['thumbnail'];
        };

        foreach($details['banner'] as &$value){
            if(empty(strstr($value,'http://www.'))){
                $value = 'http://www.aoogi.com'.$value;
            }
        }
        /*产品规格参数*/
        $params = Db::table('goods_param')->where('goods_id',$id)->select();
        $spec = Db::table('goods_spec')->field('id,goods_id,name,price,stock')->where('goods_id',$id)->select();

        /*收藏*/
        $collect = false;
        if(!empty($user_id)){
            $collWhere = [
                ['user_id','=', $user_id],
                ['goods_id','=', $id]
            ];
            $collRec = Db::table('collect')->where($collWhere)->value('id');
            if(!empty($collRec)){
                $collect = true;
            }
        }

        /*产品评论*/
        $comAlias = ['user'=>'u','comments'=>'c'];
        $comField = ['c.id','c.content','c.img','c.laud','c.star','c.create_time','u.name','u.portrait'];
        $comJoin = [['user','c.user_id=u.id']];
        $comOrder = 'c.id desc';
        $comWhere['c.goods_id'] = ['=',$id];
        $comWhere['c.delete_time'] = ['=',0];

        $comRec = Db::table('comments')
            ->alias($comAlias)
            ->field($comField)
            ->join($comJoin)
            ->where($comWhere)
            ->order($comOrder)
            ->select();
        if(!empty($comRec)) {
            foreach($comRec as &$value) {
                $value['img'] = explode('-',$value['img']);
                foreach($value['img'] as &$img) {
                    if(empty(strstr($img,'http://www.'))){
                        $img = 'http://www.aoogi.com'.$img;
                    }
                }
                $value['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
            }
        }

        $resource = [
            'detail' => $details,
            'params' => $params,
            'spec' => $spec,
            'comments' => $comRec,
            'isColl' => $collect
        ];
        return $this->apiJson($resource);
    }

    public function getGoodsSpec($id)
    {
        $whereGoods = [
            ['status','=', 1],
            ['id','=', $id],
            ['delete_time','=', 0]
        ];
        $goods = Db::table('goods')->where($whereGoods)->value('id');
        if(!$goods){
            return $this->apiJson(false,250);
        }

        $whereSpec[] = ['goods_id', '=', $id];
        $fieldSpec = ['id','goods_id','name','price','stock'];
        $res = Db::table('goods_spec')->field($fieldSpec)->where($whereSpec)->select();

        return $res ? $this->apiJson($res) : $this->apiJson(false,250);
    }

    public function getClassify(){
        $res = Db::table('classify')->field('id,title,thumbnail')->where('p_id',0)->select();
        /*临时处理图片URL*/
        foreach($res as &$value){
            if(empty(strstr($value['thumbnail'],'http://www.'))){
                $value['thumbnail'] = 'http://www.aoogi.com'.$value['thumbnail'];
            }
        }
        return $this->apiJson($res);
    }

    public function getGoodsClassifyList($id, $page, $limit)
    {
        $field = ['id','title','info','thumbnail','sell_price','origin_price'];
        $where = [
            ['status','=', 1],
            ['classify_top','=', $id],
            ['delete_time','=', 0],
        ];
        $goods = Db::table('goods')->field($field)->where($where)->order('id desc')->limit($page*$limit,$limit)->select();

        /*临时处理图片URL*/
        foreach($goods as &$value){
            if(empty(strstr($value['thumbnail'],'http://www.'))){
                $value['thumbnail'] = 'http://www.aoogi.com'.$value['thumbnail'];
            }
        }

        //数据是否全部结束
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