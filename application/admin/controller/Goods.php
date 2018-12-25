<?php

namespace app\admin\controller;


use app\common\controller\AdminController;
use think\Request;
use think\Db;

use app\admin\validate\Goods as GoodsV;

use app\common\model\Goods as GoodsM;
use app\common\model\GoodsParam;
use app\common\model\GoodsSpec;
use app\common\model\Classify;

class Goods extends AdminController
{
    /**
     * index    显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return view('goods/index');
    }

    /*
     * getData  获取资源信息
     *
     * @return json
     * */
    public function getData(Request $request)
    {
        $data = $request -> param();
        $map[] = ['delete_time','=',0];
        if(isset($data['keyword']) && !empty($data['keyword'])){
            $map[] = ['id|title|sell_price|franking|address','like','%'.trim($data['keyword']).'%'];
        }
        $list = GoodsM::where($map)
            ->order('id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->append(['classify_text'])
            ->all();
        $count = GoodsM::where($map)->count('id');
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
        $validate = new GoodsV();
        if(!$validate->scene('status')->check($data))
            return $this->failJson($validate->getError());
        $goods = GoodsM::get($data['id']);
        if(!$goods) return $this->failJson('非有效数据信息');
        return $goods->save($data) ? $this->successJson('状态更新成功') : $this->failJson('状态更新失败');
    }

    /*
     * setStatus    设置资源推荐
     *
     * @return json
     * */
    public function setRecom(Request $request)
    {

        $data = $request -> param();
        $validate = new GoodsV();
        if(!$validate->scene('recom')->check($data))
            return $this->failJson($validate->getError());
        $goods = GoodsM::get($data['id']);
        if(!$goods) return $this->failJson('非有效数据信息');
        return $goods->save($data) ? $this->successJson('推荐更新成功') : $this->failJson('推荐更新失败');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $classify = Classify::all();
        $this->assign('Classify',$classify);
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
        $data['classify_top'] = Classify::where('id',$data['classify_id'])->value('p_id');
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
        $goods = GoodsM::get($id);
        $goods['banner'] = explode('-',$goods['banner']);
        $specs = $goods->goodsSpec;
        $params = $goods->goodsParam;
        $this->assign('Goods',$goods);
        $this->assign('Specs',$specs);
        $this->assign('Params',$params);
        return view('goods/read');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        if(!$goods = GoodsM::get($id))
            return $this->failJson('非有效数据信息');
        $goods['banner'] = explode('-',$goods['banner']);
        $classify = Classify::all();
        $this->assign('Classify',$classify);
        $specs = $goods->goodsSpec;
        $params = $goods->goodsParam;

        $this->assign('Goods',$goods);
        $this->assign('Specs',$specs);
        $this->assign('Params',$params);
        return view('goods/edit');
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
        //var_dump($request->param());die;
        $data = $request->param();
        $validate = new GoodsV();

        /*验证产品基本信息*/
        if(!$validate->sceneEdit()->check($data))
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
        if(isset($data['banner']))
            $data['banner'] = implode("-",$data['banner']);
        $data['classify_top'] = Classify::where('id',$data['classify_id'])->value('p_id');
        $goods = GoodsM::get($id);
        Db::startTrans();
        try {
            $goods->save($data);
            $goods->goodsSpec()->saveAll($data['spec']);
            if(!empty($data['params']))
                $goods->goodsParam()->saveAll($data['params']);
            // 提交事务
            Db::commit();
        } catch(\Exception $e) {
            // 回滚事务
            Db::rollback();
            return $this->failJson('更新失败');
        }
        return $this->successJson('更新成功','/aoogi/goods');

    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        Db::startTrans();
        try {
            GoodsM::destroy($id);
            GoodsSpec::where('goods_id',$id)->update(['delete_time'=>time()]);
            goodsParam::where('goods_id',$id)->delete();
            // 提交事务
            Db::commit();
        } catch(\Exception $e) {
            // 回滚事务
            Db::rollback();
            return $this->failJson('产品删除失败');
        }
        return $this->successJson('产品删除成功');
    }


    /**
     * 删除指定规格资源
     *
     * @param  int  $id
     * @param  int  $mode   资源模型
     *      1   spec    规格  默认
     *      2   param   参数
     * @return \think\Response
     */
    public function delOld($id,$mode)
    {
        switch($mode){
            case 1:
                $res = GoodsSpec::get($id);
                break;
            case 2:
                $res = GoodsParam::get($id);
                break;
            default:
                return $this->failJson('无效的操作');
                break;
        }
        if(!$res->delete())
            return $this->failJson('删除失败');
        return $this->successJson('删除成功');

    }
}
