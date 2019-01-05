<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class OrderGoods extends Model
{
    /*
   * $pk      设置主键
   * 默认为id
   * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'order_goods';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id','order_id','goods_id','goods_spec_id','classify_id'];

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


}
