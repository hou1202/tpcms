<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Tickling extends Model
{
    /*
    * $pk      设置主键
    * 默认为id
    * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'tickling';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id','user_id'];

    /*
     * $field   开启数据表字段验证
     * */
    protected $field = true;

    /**
     * $deleteTime  定义数据软删除
     * $defaultSoftDelete       定义软删除字段默认值 0
     * */
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;


    /*
     * 获取器
     * 追加获取状态文字状态
     * */
    public function getImgArrAttr($value,$data)
    {
        $img_arr = array();
        if(!empty($data['img']))
            $img_arr = explode('-',$data['img']);
        return $img_arr;
    }

    /*
     * 获取器
     * 追加获取用户名称类型文字状态
     * */
    public function getUserNameAttr($value,$data)
    {
        $user_name = User::where('id', $data['user_id'])->value('name');
        return $user_name;
    }
}
