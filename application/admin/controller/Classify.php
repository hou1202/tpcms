<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;
use app\admin\model\Classify as ClassifyM;
use app\admin\validate\Classify  as ClassifyV;

class Classify extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return view('');
    }

    /*
     * getData  获取资源信息
     *
     * @return json
     * */
    public function getData(Request $request)
    {
        $data = $request -> param();
        $list = ClassifyM::order('id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->select();;
        $count = ClassifyM::count('id');
        return $this->kitJson($list,$count);

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {

        $this->assign('Classify',ClassifyM::all());
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
        $validate = new ClassifyV();
        /*验证基本信息*/
        if(!$validate->scene('create')->check($data))
            return $this->failJson($validate->getError());
        return ClassifyM::create($data) ? $this->successJson('新增成功','/aoogi/classify') : $this->failJson('添加失败');
    }


    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $classify = ClassifyM::get($id);
        if(!$classify)
            return $this->failJson('非有效数据信息');
        $all = ClassifyM::all();
        $this->assign('Classify',$classify);
        $this->assign('All',$all);
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
        $validate = new ClassifyV();
        if(!$validate->sceneEdit()->check($data))
            return $this->failJson($validate->getError());
        $classify = ClassifyM::get($id);
        return $classify->save($data) ? $this->successJson('更新成功','/aoogi/classify') : $this->failJson('更新失败');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {

        if(!ClassifyM::destroy($id))
            return $this->failJson('删除失败');
        return $this->successJson('删除成功');
    }
}
