<?php

namespace app\index\model;

use think\Model;

class User extends Model
{
    /*
     * $pk      设置主键
     * 默认为id
     * */
    protected $pk = 'id';

    /*
     * $field   过滤非数据表字段
     * */
    protected $field = true;

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'user';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id','phone'];

    /*
     *模型初始化
     * 初始化模型init()必须为静态方法
     * */
    protected static function init()
    {

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
