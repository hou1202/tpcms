<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use app\common\model\Goods;
use think\Request;

use app\common\model\Coupon as CouponM;
use app\admin\validate\Coupon as CouponV;
use app\common\model\Classify;

class Coupon extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view();
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
            $map[] = ['id|title|relation_title|money_satisfy|money_derate','like','%'.trim($data['keyword']).'%'];
        }
        $list = CouponM::where($map)
            ->order('id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->append(['type_text'])
            ->select();
        $count = CouponM::where($map)->count('id');
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
        $validate = new CouponV();
        if(!$validate->scene('status')->check($data))
            return $this->failJson($validate->getError());

        $resource = CouponM::get($data['id']);
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
        $classify = Classify::field('id,title')->where('p_id','<>',0)->select();
        $this->assign('Classify',$classify);
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
        $data = $request->param();
        $validate = new CouponV();
        /*验证基本信息*/
        if(!$validate->scene('create')->check($data))
            return $this->failJson($validate->getError());

        switch($data['type']){
            case 2 :
                $data['relation_title'] = Goods::where('id',$data['goods_id'])->value('title');
                break;
            case 3 :
                $data['relation_title'] = Classify::where('id',$data['classify_id'])->value('title');
                break;
            default :
                $data['relation_title'] = "全场通用";
                break;
        }
        return CouponM::create($data) ? $this->successJson('新增成功','/aoogi/coupon') : $this->failJson('添加失败');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $resource = CouponM::where('id',$id)->append(['type_text'])->find();
        if(!$resource)
            return $this->failJson('非有效数据信息');
        $this->assign('Coupon',$resource);
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
        $resource = CouponM::get($id);
        if(!$resource)
            return $this->failJson('非有效数据信息');
        $classify = Classify::field('id,title')->where('p_id','<>',0)->select();
        $this->assign('Classify',$classify);
        $this->assign('Coupon',$resource);
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
        $validate = new CouponV();
        if(!$validate->scene('update')->check($data))
            return $this->failJson($validate->getError());

        switch($data['type']){
            case 2 :
                $data['relation_title'] = Goods::where('id',$data['goods_id'])->value('title');
                break;
            case 3 :
                $data['relation_title'] = Classify::where('id',$data['classify_id'])->value('title');
                break;
            default :
                $data['relation_title'] = "全场通用";
                break;
        }
        $resource = CouponM::get($id);
        return $resource->save($data) ? $this->successJson('更新成功','/aoogi/coupon') : $this->failJson('更新失败');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        return CouponM::destroy($id) ? $this->successJson('删除成功') : $this->failJson('删除失败');
    }
}
