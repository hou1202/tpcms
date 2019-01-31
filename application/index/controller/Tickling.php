<?php

namespace app\index\controller;

use app\common\controller\IndexController;
use think\Request;
use app\common\validate\Tickling as TicklingV;
use app\common\model\Tickling as TicklingM;

class Tickling extends IndexController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $resource = TicklingM::field('id,content')->where('user_id',$this->user_info['id'])->order('id desc')->select();
        $this->assign('Tickling',$resource);
        return view('personal/tickling');
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
        $data = $request->param();
        $validate = new TicklingV();
        if(!$validate->scene('create')->check($data))
            return $this->failJson($validate->getError());

        if(!empty($data['img'])){
            $data['img'] = implode('-',$data['img']);
        }
        $data['user_id'] = $this->user_info['id'];

        return TicklingM::create($data) ? $this->successJson('反馈信息提交成功','/personal') : $this->failJson('反馈信息提交失败，请重新提交');

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $resource = TicklingM::where('id',$id)->where('user_id',$this->user_info['id'])->find();
        if(!empty($resource['img'])){
            $resource['img'] = explode('-',$resource['img']);
        }
        $this->assign('Tickling',$resource);
        return view('personal/tickling_read');
    }

}
