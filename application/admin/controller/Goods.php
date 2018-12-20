<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\Request;
use app\admin\validate\Goods as GoodsV;
use app\admin\model\Goods as GoodsM;
use think\Db;

class Goods extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return view('goods/index');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
        return view('goods/create');
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
        //var_dump($request->param());
        $data = $request->param();
        $validate = new GoodsV();

        /*验证产品基本信息*/
        if(!$validate->scene('create')->check($data))
            return $this->failJson($validate->getError());
        /*验证规格信息*/
        foreach($data['spec'] as $spec){
            if(!$validate->scene('spec')->check($spec))
                return $this->failJson($validate->getError());
        }
        /*验证参数信息*/
        if(!empty($data['params'])){
            foreach($data['params'] as $params){
                if(!$validate->scene('params')->check($params))
                    return $this->failJson($validate->getError());
            }
        }
        //banner图拼装
        $data['banner'] = implode("-",$data['banner']);
        Db::startTrans();
        try {
            $goods = GoodsM::create($data);
            $goods->goodsSpec()->saveAll($data['spec']);
            if(!empty($data['params']))
                $goods->goodsParam()->saveAll($data['params']);
            // 提交事务
            Db::commit();
        } catch(\Exception $e) {
            // 回滚事务
            Db::rollback();
            return $this->failJson('添加失败');
        }
        return $this->successJson('新增成功','/aoogi/goods');
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
