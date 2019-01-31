<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;
use think\db\Where;
use app\common\model\Tickling as TicklingM;
use app\common\validate\Tickling as TicklingV;

class Tickling extends AdminController
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
        //定义SQL变量
        $alias = ['tickling'=>'t','user'=>'u'];
        $join = [['user','t.user_id=u.id']];
        $field = ['t.id','t.content','t.reply','t.status','t.create_time','u.name'];

        //定义搜索条件
        $map = array();
        if(isset($data['keyword']) && !empty($data['keyword'])){
            $key = trim($data['keyword']);
            $map['u.name'] = ['like','%'.$key.'%'];
            $map['u.phone'] = ['like','%'.$key.'%'];
            $map['t.content'] = ['like','%'.$key.'%'];
            $map['t.id'] = ['like','%'.$key.'%'];
        }


        $resource = TicklingM::alias($alias)
            ->order('t.id desc')
            ->join($join)
            ->field($field)
            ->whereOr(new Where($map))
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->select();

        $count = TicklingM::alias($alias)
            ->join($join)
            ->whereOr(new Where($map))
            ->count('t.id');

        return $this->kitJson($resource,$count);
    }


    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $resource = TicklingM::where('id',$id)->find();
        if(!$resource)
            return $this->failJson('非有效数据信息');
        $this->assign('Tickling',$resource);
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
        $validate = new TicklingV();
        if(!$validate->scene('update')->check($data))
            return $this->failJson($validate->getError());
        $resource = TicklingM::get($id);
        return $resource->save($data) ? $this->successJson('更新成功','/aoogi/tickling') : $this->failJson('更新失败');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if(!$resource = TicklingM::get($id))
            return $this->failJson('非有效通知信息');
        return $resource->delete() ? $this->successJson('删除成功') : $this->failJson('删除失败');
    }
}
