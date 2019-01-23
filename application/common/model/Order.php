<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Order extends Model
{
    /**
    * $pk      设置主键
    * 默认为id
    * */
    protected $pk = 'id';

    /**
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'order';

    /**
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id'];

    /**
     * $field   开启数据表字段验证
     * */
    protected $field = true;

    /**
     * $ autoWriteTimestamp   开启自动写入时间戳字段
     * */
    //protected $autoWriteTimestamp = 'datetime';

    /**
     * $deleteTime  定义数据软删除
     * $defaultSoftDelete       定义软删除字段默认值 0
     * */
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    /**
     * 数据关联
     * 关联表      order_goods
     * 关联表内容    订单产品
     * */
    public function orderGoods()
    {
        return $this->hasMany('OrderGoods','order_id','id');
    }

    /*
     * 获取器
     * 追加获取订单产品
     * */
    public function getGoodsOrderAttr($value,$data)
    {
        $order_goods = OrderGoods::where('order_id',$data['id'])->select()->toArray();
        return $order_goods;
    }

    /*
     * 获取器
     * 追加获取订单文字状态
     * */
    public function getStatusTextAttr($value,$data)
    {
        $status_text = [1=>'等待买家付款',2=>'等待买家收货',3=>'等待买家评论',4=>'订单已完成',5=>'申请售后处理'];
        return $status_text[$data['status']];
    }

    /*
     * 获取器/后台用
     * 追加获取订单文字状态
     * */
    public function getStatusAdminTextAttr($value,$data)
    {
        $status_admin_text = [1=>'待付款',2=>'待收货',3=>'待评论',4=>'已完成',5=>'申请售后'];
        return $status_admin_text[$data['status']];
    }

    /*
     * 获取器
     * 追加获取订单支付文字状态
     * */
    public function getPayStatusTextAttr($value,$data)
    {
        $pay_status_text = [0=>'未付款',1=>'已付款'];
        return $pay_status_text[$data['pay_status']];
    }

    /*
     * 获取器
     * 追加获取订单支付方式文字状态
     * */
    public function getPayTypeTextAttr($value,$data)
    {
        $pay_type_text = [1=>'支付宝支付',2=>'微信支付',3=>'余额支付'];
        return $pay_type_text[$data['pay_type']];
    }



    /*
     * 获取器
     * 追加获取订单拼接产品名称
     * */
    public function getGoodsTitleAttr($value,$data)
    {
        $goods = OrderGoods::where('order_id',$data['id'])->column('title');
        $goods_title = implode('-',$goods);
        return $goods_title;
    }

    /*
     * 获取器
     * 追加获取订单用户昵称
     * */
    public function getUserNameAttr($value,$data)
    {
        $name = User::where('id',$data['user_id'])->value('name');
        return $name;
    }

    /*
     * 获取器
     * 追加获取订单优惠券
     * */
    public function getCouponAttr($value,$data)
    {
        if(empty($data['coupon_id'])){
            $coupon = '无';
        }else{
            $resource = Coupon::where('id',$data['coupon_id'])->find();
            $coupon = $resource->title.' ： 满 '.$resource->money_satisfy.' 减'.$resource->money_derate;
        }

        return $coupon;
    }

    /*
     * 获取器
     * 追加获取售后申请信息
     * */
    public function getReplaceAttr($value,$data){
        $replace = array();
        if($data['status'] == 5){
            $replace = Replace::where('order_id',$data['id'])->append(['img_arr','type_text','replace_goods','status_text'])->select()->toArray();
        }
        return $replace;
    }


}
