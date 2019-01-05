<?php

namespace app\common\model;

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
     * 数据关联
     * 关联表      goods_param
     * 关联表内容    产品参数
     * */
    public function goodsParam()
    {
        return $this->hasMany('GoodsParam','goods_id','id');
    }

    /*
     * 数据关联
     * 关联表      goods_spec
     * 关联表内容    产品规格
     * */
    public function goodsSpec()
    {
        return $this->hasMany('GoodsSpec','goods_id','id');
    }

    /*
     * 数据关联
     * 关联表      comment
     * 关联表内容    产品规格
     * */
    public function comments()
    {
        return $this->hasMany('Comments','goods_id','id');
    }

    /*
     * 数据关联
     * 关联表      collect
     * 关联表内容    收藏
     * */
    public function collect()
    {
        return $this->hasMany('Collect','goods_id','id');
    }

    /*
     * 获取器
     * 追加获取classify文字值
     * */
    public function getClassifyTextAttr($value,$data)
    {
        $res = Classify::field('id,title')->cache('classify_res',60)->all();
        $classify_text = array();
        foreach($res as $val){
            $classify_text[$val['id']] = $val['title'];
        }
        return $classify_text[$data['classify_id']];
    }
}
