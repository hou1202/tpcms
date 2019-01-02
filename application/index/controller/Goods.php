<?php

namespace app\index\controller;

use app\common\controller\BaseController;
use app\common\model\Classify;
use app\common\model\Collect;
use think\Request;

use app\common\model\Goods as GoodsM;
use app\common\model\Comments;
use app\index\common\Users;


class Goods extends BaseController
{
    /*
     * 控制器验证中间键
     * 验证用户登录情况
     * @ except   排除不需要验证方法
     * */
    protected $middleware = [
        'UserVerify' => ['except' => ['detail','index','pageData']]
    ];

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


        $resources = GoodsM::field('id,title,info,thumbnail,sell_price,origin_price')
            ->where('classify_id',$id)
            ->order('id desc')
            ->limit(($page-1)*$limit,$limit)
            ->all()
            ->toArray();
        $html = null;
        /*foreach($resources as $resource){
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
        }*/


        return $this->successJson('获取成功','',$resources);
        //echo $html;

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

    /**
     * 收藏/取消 产品
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function collect($id)
    {
        $user = Users::user();
        $collect = Collect::where('user_id',$user['id'])->where('goods_id',$id)->find();
        if($collect)//取消收藏
            return $collect->delete() ? $this->successJson('取消收藏成功') : $this->failJson('取消收藏失败');
        //收藏
        if(Collect::create(['user_id'=>$user['id'], 'goods_id'=>$id]))
            return $this->successJson('收藏成功');
        return $this->failJson('收藏失败');
    }

    /**
     * 评论点赞
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function agree($id)
    {
        if(!$comments = Comments::get($id))
            return $this->failJson('非有效评论信息');
        return $comments->setInc('laud') ? $this->successJson('听说点赞的人最美！') : $this ->failJson('系统打盹，再来一次！');
    }







}
