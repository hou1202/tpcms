<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/17
 * Time: 22:04
 */

namespace app\index\controller;


use app\common\controller\IndexController;
use app\common\model\Config;
use think\Request;
use think\Db;

use app\index\validate\Car as CarV;

use app\common\model\Car as CarM;
use app\common\model\Goods;
use app\common\model\GoodsSpec;
use app\common\model\Order;



class Car extends IndexController
{

    public function index(){
        $resource = CarM::alias('c')
            ->field('c.id,c.num,g.id as goods_id,g.title,g.thumbnail,s.name,s.price,s.stock')
            ->join('goods g','g.id=c.goods_id')
            ->join('goods_spec s','s.id=c.spec_id')
            ->where('c.user_id',$this->user_info['id'])
            ->order('c.id desc')
            ->group('c.id')
            ->select()
            ->toArray();
        $this->assign('Car',$resource);
        return view('');
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
     * 产品生成购买订单
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function buy(Request $request)
    {
        //return redirect('/');
        $data = $request->param();
        if(!isset($data['car']) || empty($data['car']))
            return $this->failJson('非有效下单信息');
        $rest = $data['car'];

        $total = 0;
        $franking = 0;
        $order_goods = array();
        $car_id = null;

        /**
         * 下单数据验证
         */
        foreach($rest as $value){
            $car = CarM::get($value['id']);

            $goods = Goods::field('id,title,franking,classify_id,thumbnail')->where(['status'=>1,'id'=>$car['goods_id']])->find();
            if(!$goods){        //验证产品有效性
                //CarM::destroy($car['id']);      //清除购物车问题产品
                return $this->failJson('产品【 '.mb_substr($goods->title,0,10).'... 】,请重新下单');
            }

            $spec = GoodsSpec::get($car['spec_id']);
            if(!$spec){     //验证规格有效性
                //CarM::destroy($car['id']);      //清除购物车问题产品
                return $this->failJson('产品【 '.mb_substr($goods->title,0,10).'... 】,该规格已下架,请重新下单');
            }
            if($spec['stock'] < $value['num'])  //验证库存有效性
                return $this->failJson('产品【 '.mb_substr($goods->title,0,10).'... 】下单数量大于库存，请修改下单数量');
            //计算订单总金额
            $total =  bcadd($total,bcmul($spec['price'],$value['num'],2),2);
            //计算运算
            $franking = bcadd($franking,$goods->franking,2);
            //组装购物车ID
            $car_id .= $value['id'].',';
            //组装订单产品数据
            $order_goods[] =[
                'goods_id' => $goods['id'],
                'goods_spec_id' => $spec['id'],
                'classify_id' => $goods['classify_id'],
                'thumbnail' => $goods['thumbnail'],
                'title' => $goods['title'],
                'name' => $spec['name'],
                'price' => $spec['price'],
                'num' => $value['num'],

            ];
        }

        /**
         * 生成订单
         */
        //生成交易号
        $serial = date('Ymd').rand(100,999).time();
        $integral = bcmul($total,bcdiv(Config::where('id',3)->value('param'),100,2),2);
        Db::startTrans();
        try{
            //创建订单
            $order = Order::create([
                'serial'=>$serial,
                'total_price'=>$total,
                'integral'=>$integral,
                'franking_price'=>$franking
            ]);
            //创建订单产品
            $order->orderGoods()->saveAll($order_goods);
            //删除购物车产品
            CarM::whereIn('id',mb_substr($car_id, 0, -1))->update(['delete_time'=>time()]);

            // 提交事务
            Db::commit();
        }catch(\Exception $e){
            // 回滚事务
            Db::rollback();
            return $this->failJson('订单创建失败');
        }
        $response = [
            'order' => $order->id,
        ];
        return $this->successJson('下单成功','/car',$response);


    }
}