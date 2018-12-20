<?php

namespace app\admin\model;

use think\Model;
use think\model\concern\SoftDelete;

class Goods extends Model
{
    /*
    * $pk      设置主键
    * 默认为id
    * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'goods';

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

    /*
     * 数据关联
     * 关联表      goods_param
     * */
    public function goodsParam()
    {
        return $this->hasMany('GoodsParam','goods_id','id');
    }

    /*
     * 数据关联
     * 关联表      goods_spec
     * */
    public function goodsSpec()
    {
        return $this->hasMany('GoodsSpec','goods_id','id');
    }
}
