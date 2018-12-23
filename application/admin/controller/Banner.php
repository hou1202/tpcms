<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;
use app\admin\model\Classify as Classify;
use app\admin\model\Banner as BannerM;
use app\admin\validate\Banner as BannerV;
use think\Db;

class Banner extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return view('banner/index');
    }

    /*
     * getData  获取资源信息
     *
     * @return json
     * */
    public function getData(Request $request)
    {
        $data = $request -> param();
        $list = Db::table('banner')->alias('b')
            ->field('b.id,b.title,b.thumbnail,b.type,b.url,b.status,g.title as goods_id,c.title as classify_id')
            ->leftJoin('classify c','b.classify_id = c.id')
            ->leftJoin('goods g','b.goods_id = g.id')
            ->group('b.id')
            ->order('b.id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->select();
        $count = BannerM::count('id');
        return $this->kitJson($list,$count);

    }

    /*
     * setStatus    设置资源状态
     *
     * @return json
     * */
    public function setStatus(Request $request)
    {
        $data = $request -> param();
        $validate = new BannerV();
        if(!$validate->scene('status')->check($data))
            return $this->failJson($validate->getError());

        $banner = BannerM::get($data['id']);
        if(!$banner) return $this->failJson('非有效数据信息');
        return $banner->save($data) ? $this->successJson('状态更新成功') : $this->failJson('状态更新失败');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $classify = Classify::field('id,title')->select();
        $this->assign('Classify',$classify);
        return view('');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->param();
        $validate = new BannerV();
        /*验证基本信息*/
        if(!$validate->scene('create')->check($data))
            return $this->failJson($validate->getError());
        if(empty($data['goods_id']))
            $data['goods_id'] = null;
        if(empty($data['classify_id']))
            $data['classify_id'] = null;
        return BannerM::create($data) ? $this->successJson('新增成功','/aoogi/banner') : $this->failJson('添加失败');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $banner = Db::table('banner')->alias('b')
            ->field('b.id,b.title,b.thumbnail,b.type,b.url,b.status,b.goods_id,b.classify_id,g.title as goods_title,c.title as classify_title')
            ->leftJoin('classify c','b.classify_id = c.id')
            ->leftJoin('goods g','b.goods_id = g.id')
            ->where('b.id',$id)
            ->find();
        if(!$banner)
            return $this->failJson('非有效数据信息');
        $classify = Classify::field('id,title')->select();
        $this->assign('Classify',$classify);
        $this->assign('Banner',$banner);
        return view('');
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

        $data = $request->param();
        /*验证基本信息*/
        $validate = new BannerV();
        if(!$validate->sceneEdit()->check($data))
            return $this->failJson($validate->getError());
        if(empty($data['goods_id']))
            $data['goods_id'] = null;
        if(empty($data['classify_id']))
            $data['classify_id'] = null;
        $banner = BannerM::get($id);
        return $banner->save($data) ? $this->successJson('更新成功','/aoogi/banner') : $this->failJson('更新失败');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if(!BannerM::destroy($id))
            return $this->failJson('删除失败');
        return $this->successJson('删除成功');
    }
}
