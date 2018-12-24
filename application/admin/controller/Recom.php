<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;

use app\common\model\Recom as RecomM;

use app\admin\validate\Recom as RecomV;

class Recom extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
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
        $resource = RecomM::order('id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->select();;
        $count = RecomM::count('id');
        return $this->kitJson($resource,$count);
    }

    /*
 * setStatus    设置资源状态
 *
 * @return json
 * */
    public function setStatus(Request $request)
    {
        $data = $request -> param();
        $validate = new RecomV();
        if(!$validate->scene('status')->check($data))
            return $this->failJson($validate->getError());

        $resource = RecomM::get($data['id']);
        if(!$resource) return $this->failJson('非有效数据信息');
        return $resource->save($data) ? $this->successJson('状态更新成功') : $this->failJson('状态更新失败');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view();
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
        $validate = new RecomV();
        /*验证基本信息*/
        if(!$validate->scene('create')->check($data))
            return $this->failJson($validate->getError());
        return RecomM::create($data) ? $this->successJson('新增成功','/aoogi/recom') : $this->failJson('添加失败');

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
        $resource = RecomM::get($id);
        if(!$resource)
            return $this->failJson('非有效数据信息');
        $this->assign('Recom',$resource);
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
        $validate = new RecomV();
        if(!$validate->sceneEdit()->check($data))
            return $this->failJson($validate->getError());
        $resource = RecomM::get($id);
        return $resource->save($data) ? $this->successJson('更新成功','/aoogi/recom') : $this->failJson('更新失败');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if(!RecomM::destroy($id))
            return $this->failJson('删除失败');
        return $this->successJson('删除成功');
    }
}
