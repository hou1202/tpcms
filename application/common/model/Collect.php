<?php

namespace app\common\model;

use think\Model;

class Collect extends Model
{
    /*
    * $pk      设置主键
    * 默认为id
    * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'collect';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id','user_id','goods_id'];

    /*
     * $field   开启数据表字段验证
     * */
    protected $field = true;


}
