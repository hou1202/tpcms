<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Validate;
use think\Request;
use app\common\model\Logistics as LogisticsM;

class Logistics extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return view();
    }

    //获取列表数据
    public function getData(Request $request)
    {
        $data = $request -> post();
        $list = LogisticsM::limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->select();
        $count = LogisticsM::count('id');
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
        //
        $data = $request -> post();
        $rule = [
            'title|物流公司名称' => 'require|max:35',
        ];
        $validate = new Validate($rule);
        if(!$validate->check($data)){
            return $this->failJson($validate->getError());
        }
        return LogisticsM::create($data) ? $this->successJson('新增成功','/aoogi/logistics') : $this->failJson('添加失败');
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
        $logistics = LogisticsM::get($id);
        if(!$logistics) return $this->redirectError('非有效数据信息');
        $this->assign('Logistics',$logistics);
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

        $data = $request -> post();
        $logistics = LogisticsM::get($id);
        if(!$logistics) return $this->failJson('非有效数据信息');
        $rule = [
            'title|物流公司名称' => 'require|max:35',
        ];
        $validate = new Validate($rule);
        if(!$validate->check($data)){
            return $this->failJson($validate->getError());
        }
        return $logistics->save($data) ? $this->successJson('更新成功','/aoogi/logistics') : $this->failJson('更新失败');
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
        return LogisticsM::destroy($id) ? $this->successJson('删除成功') : $this->failJson('删除失败');
    }
}
