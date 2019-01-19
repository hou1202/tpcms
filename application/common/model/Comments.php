<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;
use think\Db;

class Comments extends Model
{
    /*
    * $pk      设置主键
    * 默认为id
    * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'comments';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id','user_id','goods_id','order_id'];

    /*
     * $field   开启数据表字段验证
     * */
    protected $field = true;

    /*
     * $ autoWriteTimestamp   开启自动写入时间戳字段
     * */
    protected $autoWriteTimestamp = true;

    /*
     * $deleteTime  定义数据软删除
     * $defaultSoftDelete       定义软删除字段默认值 0
     * */
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    /*
     * @ getGoodsComments   static  获取指定产品的评论和用户信息
     * @ param  int     $id         产品ID
     * @ return     object
     * */
    public static function getGoodsComments($id)
    {
        return Db::table('comments')
            ->alias('c')
            ->field('c.id,c.content,c.img,c.laud,c.create_time,u.name,u.portrait')
            ->join('user u', 'c.user_id = u.id')
            ->where('c.goods_id', $id)
            ->where('c.delete_time',0)
            ->group('c.id')
            ->select();
    }
}
