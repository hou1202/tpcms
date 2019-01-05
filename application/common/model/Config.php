<?php

namespace app\common\model;

use think\Model;

class Config extends Model
{
    /*
     * $pk      设置主键
     * 默认为id
     * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'config';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id'];
}
