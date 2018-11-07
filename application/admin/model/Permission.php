<?php

namespace app\admin\model;

use think\Model;

class Permission extends Model
{
    //
    /*
     * $pk      设置主键
     * 默认为id
     * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'permissions';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id'];

    public function setStatusAttr($value)
    {
        if($value == ""){
            return $value = 0;
        }
    }
}
