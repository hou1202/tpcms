<?php

namespace app\index\controller;

use app\common\controller\BaseController;
use app\common\model\Classify;
use app\common\model\Collect;
use think\Request;
use think\facade\Cache;

use app\common\model\Goods as GoodsM;
use app\common\model\Comments;
use app\index\common\Users;


class Goods extends BaseController
{
    //产品列表缓存前缀
    private $goodsVer = 'aooGoods';

    /**
     * 显示资源列表
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function index($id)
    {
        /*$classify = Classify::where('p_id',$id) ->select();*/
        $classify = Classify::where('p_id',$id)
            ->whereOr('p_id','=',function($query) use($id){
                $query->table('classify')->where('id',$id)->where('p_id','<>',0)->field('p_id');
            })->select();
        //资源不存在 ，进行分类列表
        if(!count($classify))
            return redirect('/classify');
        $resource = GoodsM::whereIn('classify_id',$classify[0]['id'])->select();
        $this->assign('Classify',$classify);
        $this->assign('Goods',$resource);
        return view('goods/list');

    }

    /**
     * 获取资源列表数据
     *
     * @param  int  $id         产品二级分类ID
     * @param  int  $page       分页起始页
     * @param  int  $limit      分布显示条数
     * @return \think\Response
     */
    public function pageData($id,$page,$limit){
        //获取存在，返回缓存数据
        if($cacheRes = Cache::get($this->goodsVer.$id.'_'.$page.'_'.$limit)){
            return $this->successJson('获取成功','',$cacheRes);
        }

        $resources = GoodsM::field('id,title,info,thumbnail,sell_price,origin_price')
            ->where('classify_id',$id)
            ->order('id desc')
            ->limit(($page-1)*$limit,$limit)
            ->select()
            ->toArray();

        if($resources){
            Cache::set($this->goodsVer.$id.'_'.$page.'_'.$limit,$resources,600);
            return $this->successJson('获取数据成功','',$resources);
        }else{
            return $this->failJson('获取失败');
        }
        /*
        $html = null;
        foreach($resources as $resource){
            $html .='<a class="list-block" href="/goods/'.$resource['id'].'">';
            $html .='<div class="block-img">';
            $html .='<img src="'.$resource['thumbnail'].'">';
            $html .='</div>';
            $html .='<div class="block-info">';
            $html .='<h2>'.$resource['title'].'</h2>';
            $html .='<h3>'.$resource['info'].'</h3>';
            $html .='<div class="block-info-price">';
            $html .='<p>￥<span>'.$resource['sell_price'].'</span></p>';
            $html .='<p>￥<span>'.$resource['origin_price'].'</span></p>';
            $html .='</div>';
            $html .='</div>';
            $html .='</a>';
        }
        */




    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function detail($id)
    {

        if(!$goods = GoodsM::get($id))
            return $this->failJson('非有效产品信息');
        //获取产品信息
        $goods['banner'] = explode('-',$goods['banner']);
        $specs = $goods->goodsSpec;
        $param = $goods->goodsParam;
        //获取并处理推荐产品
        $recom = GoodsM::where('classify_top',$goods->classify_top)
            ->where('recom',1)
            ->where('status',1)
            ->where('id','<>',$id)
            ->limit(0,20)
            ->select();
        if(empty($recom) || count($recom) < 20)
            $recom = GoodsM::where('recom',1)
                ->where('status',1)
                ->where('id','<>',$id)
                ->limit(0,20)
                ->select();
        //获取产品评论
        $comments = Comments::getGoodsComments($id);
        foreach($comments as &$comment){
            $comment['img'] = explode('-',$comment['img']);
        }
        //检测登录用户产品收藏
        if($user=Users::user()){
            $collect = Collect::where('user_id',$user['id'])->where('goods_id',$id)->find();
            $this->assign('Collect',$collect);
        }
        $this->assign('Goods',$goods);
        $this->assign('Spec',$specs);
        $this->assign('Param',$param);
        $this->assign('Recom',$recom);
        $this->assign('Comments',$comments);
        return view();
    }











}
