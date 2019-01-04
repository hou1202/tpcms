<?php

namespace app\index\controller;

use app\common\controller\IndexController;
use think\Request;

use app\index\validate\Address as AddressV;
use app\common\model\Address as AddressM;


class Address extends IndexController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $resource = AddressM::where('user_id',$this->user_info['id'])->order('choice desc')->select();
        $this->assign("Address",$resource);
        return view('');
    }

    /**
     * 更新默认选项
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function choice($id)
    {
        if(!$resource = AddressM::get($id))
            return $this->failJson('地址信息有误');
        if($id == AddressM::where(['choice'=>1,'user_id'=>$this->user_info['id']])->value('id'))
            return $this->failJson('已是默认地址');
        AddressM::where('user_id',$this->user_info['id'])->update(['choice'=>0]);
        $resource->choice = 1;

        return $resource->save() ? $this->successJson('默认地址设置成功') : $this->failJson('设置失败，请重试');


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
        $validate = new AddressV();
        /*验证基本信息*/
        if(!$validate->scene('create')->check($data))
            return $this->failJson($validate->getError());
        $data['user_id']=$this->user_info['id'];
        if(isset($data['choice']) && $data['choice'] == 1)
            AddressM::where('user_id',$this->user_info['id'])->update(['choice'=>0]);
        return AddressM::create($data) ? $this->successJson('新增成功','/address') : $this->failJson('添加失败');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $resource = AddressM::get($id);
        if(!$resource)
            return $this->failJson('非有效数据信息');

        $this->assign('Address',$resource);
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
        $validate = new AddressV();
        /*验证基本信息*/
        if(!$validate->scene('update')->check($data))
            return $this->failJson($validate->getError());

        if(isset($data['choice']) && $data['choice'] == 1)
            AddressM::where('user_id',$this->user_info['id'])->update(['choice'=>0]);
        $resource = AddressM::get($id);
        return $resource->save($data) ? $this->successJson('更新成功','/address') : $this->failJson('更新失败');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        return AddressM::destroy($id) ? $this->successJson('删除成功') : $this->failJson('删除失败');
    }
}
