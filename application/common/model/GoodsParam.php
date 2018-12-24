<?php

namespace app\common\model;

use think\Model;

class GoodsParam extends Model
{
    /*
    * $pk      设置主键
    * 默认为id
    * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'goods_param';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id','goods_id'];

    /*
     * $field   开启数据表字段验证
     * */
    protected $field = true;

    /*
     * 数据关联
     * 关联表      goods
     * */
    public function goods()
    {
        return $this->belongsTo('goods');
    }
}
