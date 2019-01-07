<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Coupon extends Model
{
    /*
    * $pk      设置主键
    * 默认为id
    * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'coupon';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id'];

    /*
     * $field   开启数据表字段验证
     * */
    protected $field = true;

    /*
     * $deleteTime  定义数据软删除
     * $defaultSoftDelete       定义软删除字段默认值 0
     * */
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;


    //设置产品ID写入格式化
    public function setGoodsIdAttr($value){
        if(!empty($value))
            return $value;
    }

    //设置分类ID写入格式化
    public function setClassifyIdAttr($value){
        if(!empty($value))
            return $value;
    }

    //设置结束时间转化为时间戳
    public function setEndTimeAttr($value){
        return strtotime($value);
    }

    //设置结束时间戳转化为日期
    public function getEndTimeAttr($value){
        return date('Y-m-d',$value);
    }

    //设置类型文字状态
    public function getTypeTextAttr($value,$data){
        $type_text = [1=>"通用型",2=>"产品型",3=>"分类型"];
        return $type_text[$data['type']];
    }

    /*
     * 数据关联
     * 关联表      coupon_user
     * 关联表内容   领取优惠券用户
     * */
    public function couponUser()
    {
        return $this->hasMany('CouponUser','coupon_id','id');
    }
}
