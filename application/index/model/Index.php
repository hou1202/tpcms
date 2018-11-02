<?php

namespace app\index\model;

use think\Model;

class Index extends Model
{
    //约束链接表
    protected $table = 'users';
    //约束主键
    protected $pk = 'id';
}
