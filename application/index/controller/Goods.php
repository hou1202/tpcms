<?php

namespace app\index\controller;

use app\common\controller\BaseController;
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
    /*protected $middleware = [
        'UserVerify' => ['except' => ['detail']]
    ];*/

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
        $goods['banner'] = explode('-',$goods['banner']);
        $specs = $goods->goodsSpec;
        $param = $goods->goodsParam;
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

        $comments = Comments::getGoodsComments($id);
        foreach($comments as &$comment){
            $comment['img'] = explode('-',$comment['img']);
        }
        $this->assign('Goods',$goods);
        $this->assign('Spec',$specs);
        $this->assign('Param',$param);
        $this->assign('Recom',$recom);
        $this->assign('Comments',$comments);
        return view();
    }

    /**
     * 收藏指定产品
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function collect(Request $request, $id)
    {
        //
        if($request->isAjax()){
            var_dump('is ajax');
        }
         //return redirect('/login');
        var_dump($request->isAjax());
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //

    }
}
