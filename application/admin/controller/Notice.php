<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;
use app\common\model\Notice as NoticeM;
use app\admin\validate\Notice as NoticeV;

class Notice extends AdminController
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
        $resource = NoticeM::order('id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->append(['type_text','notice_user'])
            ->select();;
        $count = NoticeM::count('id');
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
        $validate = new NoticeV();
        if(!$validate->scene('create')->check($data))
            return $this->failJson($validate->getError());
        return NoticeM::create($data) ? $this->successJson('通知信息创建成功','/aoogi/notice') : $this->failJson('通知信息创建失败');
    }


    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $resource = NoticeM::where('id',$id)->append(['notice_user'])->find();
        if(!$resource)
            return $this->failJson('非有效数据信息');
        $this->assign('Notice',$resource);
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
        $validate = new NoticeV();
        if(!$validate->scene('update')->check($data))
            return $this->failJson($validate->getError());
        $resource = NoticeM::get($id);
        return $resource->save($data) ? $this->successJson('通知信息更新成功','/aoogi/notice') : $this->failJson('通知信息更新失败');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if(!$notice = NoticeM::get($id))
            return $this->failJson('非有效通知信息');
        return $notice->delete() ? $this->successJson('删除成功') : $this->failJson('删除失败');
    }
}
