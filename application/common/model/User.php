<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
    /*
     * $pk      设置主键
     * 默认为id
     * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'user';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id','phone'];

    /*
     * $field   开启数据表字段验证
     * */
    protected $field = true;

    /*
     * $ autoWriteTimestamp   开启自动写入时间戳字段
     * */
    //protected $autoWriteTimestamp = 'datetime';

    /*
     * $deleteTime  定义数据软删除
     * $defaultSoftDelete       定义软删除字段默认值 0
     * */
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;


    /*
     * 获取器
     * 追加获取text文字值
     * */
    public function getSexTextAttr($value,$data)
    {
        $sex_text=[0=>"女",1=>"男"];
        return $sex_text[$data['sex']];
    }

    /*
     * @ setPasswordAttr    修饰器，password字段,md5加密
     * $value   原始数据值
     * @ return     md5加密后的值
     * */
    public function setPasswordAttr($value)
    {
        return md5($value);
    }
}
