<?php

namespace app\index\controller;

use app\common\controller\IndexController;
use think\Request;
use app\index\common\Users;
use app\common\model\Collect as CollectM;
use app\common\model\Comments;

/*收藏Collect控制器*/
class Collect extends IndexController
{

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $resource = CollectM::where('user_id',$this->user_info['id'])->select();
        $this->assign('Collect',$resource);
        return view('personal/collect');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * 收藏/取消 产品
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function whether($id)
    {
        $user = Users::user();
        $collect = CollectM::where('user_id',$user['id'])->where('goods_id',$id)->find();
        if($collect)//取消收藏
            return $collect->delete() ? $this->successJson('取消收藏成功') : $this->failJson('取消收藏失败');
        //收藏
        if(CollectM::create(['user_id'=>$user['id'], 'goods_id'=>$id]))
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
