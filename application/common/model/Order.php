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
}
