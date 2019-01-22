<?php

namespace app\admin\controller;

use app\common\controller\AdminController;
use think\db\Where;
use think\Request;
use app\common\model\Order as OrderM;


class Order extends AdminController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return  view();
    }

    /*
    * getData  获取资源信息
    *
    * @return json
    * */
    public function getData(Request $request)
    {
        $data = $request -> param();


        $alias = ['order'=>'o','user'=>'u'];
        $join = [['user','o.user_id=u.id'],['order_goods']];
        $field = ['o.id','o.total_price','o.pay_price','o.integral','o.pay_status','o.pay_type','o.status','o.create_time','u.name'];
        $append = ['status_admin_text','pay_status_text','pay_type_text','goods_title'];

        $map=array();
        if(isset($data['keyword']) && !empty($data['keyword'])){
            $map['u.name'] = ['like','%'.trim($data['keyword']).'%'];
            $map['o.id'] = ['like','%'.trim($data['keyword']).'%'];
        }

        $list = OrderM::alias($alias)
            ->order('o.id desc')
            ->join($join)
            ->field($field)
            ->whereOr(new Where($map))
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->append($append)
            ->select();


        /*$list = OrderM::alias('o')
            ->field('o.id,o.total_price,o.pay_price,o.integral,o.pay_status,o.pay_type,o.status,o.create_time,u.name')
            ->where($map)
            ->join('user u','u.id = o.user_id')
            ->order('o.id desc')
            ->limit(($data['page']-1)*$data['limit'],$data['limit'])
            ->append(['status_admin_text','pay_status_text','pay_type_text','goods_title'])
            ->select();*/

        $count = OrderM::alias($alias)
            ->join($join)
            ->whereOr(new Where($map))
            ->count('o.id');

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
