<?php

namespace app\admin\model;

use think\Model;

class Banner extends Model
{
    //
    /*
    * $pk      设置主键
    * 默认为id
    * */
    protected $pk = 'id';

    /*
     *$table    当前模型对应表名，为完整表名
     * */
    protected $table = 'banner';

    /*
     * $readonly    定义只读字段保护
     * */
    protected $readonly = ['id'];

    /*
     * $field   开启数据表字段验证
     * */
    protected $field = true;

    public function getTypeTextAttr($value,$data)
    {
        $type = [1=>'无链接',2=>'产品链接',3=>'分类链接',4=>'URL链接'];
        return $type[$data['type']];
    }

}
