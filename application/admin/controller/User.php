<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;

use app\common\model\User as UserM;
use app\common\validate\User as UserV;

class User extends AdminController
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
        $map[] = ['id','>',0];
        if(isset($data['keyword']) && !empty($data['keyword'])){
            $map[] = ['id|name|phone','like','%'.trim($data['keyword']).'%'];
        }

        $list = UserM::where($map)
            ->order('id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->append(['sex_text'])
            ->all();

        $count = UserM::where($map)->count('id');
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
        $validate = new UserV();
        if(!$validate->scene('status')->check($data))
            return $this->failJson($validate->getError());
        $resource = UserM::get($data['id']);
        if(!$resource) return $this->failJson('非有效数据信息');
        return $resource->save($data) ? $this->successJson('状态更新成功') : $this->failJson('状态更新失败');
    }




    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        if(!$resource = UserM::get($id))
            return $this->failJson('非有效数据信息');
        $this->assign('User',$resource);
        return view('');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        if(!$resource = UserM::get($id))
            return $this->failJson('非有效数据信息');
        $this->assign('User',$resource);
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
        $validate = new UserV();
        if(!$validate->scene('update')->check($data))
            return $this->failJson($validate->getError());
        if(empty($data['password']))
            unset($data['password']);

        $classify = UserM::get($id);
        return $classify->save($data) ? $this->successJson('更新成功','/aoogi/user') : $this->failJson('更新失败');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        return UserM::destroy($id) ? $this->successJson('删除成功') : $this->failJson('删除失败');
    }
}
