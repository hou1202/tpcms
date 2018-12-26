<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/17
 * Time: 22:04
 */

namespace app\index\controller;


use app\common\controller\IndexController;
use think\Request;
use app\index\validate\Car as CarV;
use app\common\model\Car as CarM;

class Car extends IndexController
{

    public function index(){
        return view('/car/car');
    }

    /**
     * 产品加入购物车
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function join(Request $request)
    {
        $data = $request -> param();
        $validate = new CarV();
        if(!$validate->scene('join')->check($data))
            return $this->failJson($validate->getError());
        $data['user_id'] = $this->user_info['id'];
        $map = [
            'user_id' => $data['user_id'],
            'goods_id' => $data['goods_id'],
            'spec_id' => $data['spec_id']
        ];
        $car = CarM::where($map)->find();
        if($car)
            return $car->setInc('num',$data['num']) ? $this->successJson('成功添加购物车，赶快去看看吧！') : $this->failJson('添加购物车失败！');

        return CarM::create($data) ? $this->successJson('成功添加购物车，赶快去看看吧！') : $this->failJson('添加购物车失败！');
    }

    /**
     * 产品加入购物车
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function buy(Request $request)
    {
        return redirect('/');
        var_dump('buy');
    }
}