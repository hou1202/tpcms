<?php

namespace app\admin\model;

use think\Model;

class Router extends Model
{
    /*
     * $pk      设置主键
     * 默认为id
     * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'router';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id'];


    public function getPidTextAttr($value,$data)
    {
        if($data['pid'] === 0){
            $pid_text = '一级目录';
        }else{
            $rec = $this->field('title')->where('id',$data['pid'])->find();
            $pid_text = $rec['title'];
        }
        return $pid_text;
    }
}
