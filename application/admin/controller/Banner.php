<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;
use app\admin\model\Classify as Classify;
use app\admin\model\Banner as BannerM;
use app\admin\validate\Banner as BannerV;

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
        $list = BannerM::order('id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->append(['type_text'])
            ->select()
            ->toArray();
        $count = BannerM::count('id');
        return $this->kitJson($list,$count);

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
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
        return BannerM::create($data) ? $this->successJson('新增成功','/aoogi/banner') : $this->failJson('添加失败');
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
}
