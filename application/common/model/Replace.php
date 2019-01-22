<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;
use think\Db;

class Replace extends Model
{
    /*
    * $pk      设置主键
    * 默认为id
    * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'replace';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id','user_id','goods_id','order_id'];

    /*
     * $field   开启数据表字段验证
     * */
    protected $field = true;

    /*
     * $ autoWriteTimestamp   开启自动写入时间戳字段
     * */
    //protected $autoWriteTimestamp = true;

    /*
     * $deleteTime  定义数据软删除
     * $defaultSoftDelete       定义软删除字段默认值 0
     * */
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;


    /*
     * 获取器
     * 追加获取指定产品信息
     * */
    public function getReplaceGoodsAttr($value,$data)
    {
        $replace_goods = OrderGoods::field('title,thumbnail,name,price,num')
            ->where('order_id',$data['order_id'])
            ->where('goods_id',$data['goods_id'])
            ->find()
            ->toArray();
        return $replace_goods;
    }

    /*
     * 获取器
     * 追加获取类型文字信息
     * */
    public function getTypeTextAttr($value,$data)
    {
        $type_text = [1=>'申请换货',2=>'申请退货退款'];
        return $type_text[$data['type']];
    }

    /*
     * 获取器
     * 追加获取状态文字信息
     * */
    public function getStatusTextAttr($value,$data)
    {
        $status_text = [0=>'申请受理中',1=>'通过申请',2=>'申请驳回',3=>'产品回寄中',4=>'重新发货中',5=>'售后完成'];
        return $status_text[$data['status']];
    }

    /*
     * 获取器
     * 追加获取图片数组信息
     * */
    public function getImgArrAttr($value,$data)
    {
        $img_arr = explode('-',$data['img']);
        return $img_arr;
    }
}
