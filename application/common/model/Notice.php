<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Notice extends Model
{
    /*
    * $pk      设置主键
    * 默认为id
    * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'notice';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id'];

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
     * 追加获取消息类型文字状态
     * */
    public function getTypeTextAttr($value,$data)
    {
        $type_text = [1=>'系统消息'];
        return $type_text[$data['type']];
    }

    /*
     * 获取器
     * 追加获取消息类型文字状态
     * */
    public function getNoticeUserAttr($value,$data)
    {
        if($data['user_id'] == 0){
            $notice_user = '所有用户';
        }else {
            $notice_user = User::where('id', $data['user_id'])->value('name');
        }
        return $notice_user;
    }
}
