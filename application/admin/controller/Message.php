<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;
use app\common\model\Message as MessageM;
use app\admin\validate\Message as MessageV;

class Message extends AdminController
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
        $resource = MessageM::order('id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->select();;
        $count = MessageM::count('id');
        return $this->kitJson($resource,$count);
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
        $validate = new MessageV();
        if(!$validate->scene('create')->check($data))
            return $this->failJson($validate->getError());
        return MessageM::create($data) ? $this->successJson('内容创建成功','/aoogi/message') : $this->failJson('内容创建失败');
    }


    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $resource = MessageM::where('id',$id)->find();
        if(!$resource)
            return $this->failJson('非有效数据信息');
        $this->assign('Message',$resource);
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
        $validate = new MessageV();
        if(!$validate->scene('create')->check($data))
            return $this->failJson($validate->getError());
        $resource = MessageM::get($id);
        return $resource->save($data) ? $this->successJson('内容更新成功','/aoogi/message') : $this->failJson('内容更新失败');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if(!$notice = MessageM::get($id))
            return $this->failJson('非有效数据信息');
        return $notice->delete() ? $this->successJson('删除成功') : $this->failJson('删除失败');
    }
}
