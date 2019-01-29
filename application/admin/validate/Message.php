<?php

namespace app\admin\validate;

use app\common\validate\CommonValidate;

class Message extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id'   =>  'require|number|isExist:notice,id',
        'title|内容标题' => 'require|length:2,20',
        'vice_title|内容副标题' => 'require|length:2,50',
        'content|内容正文' => 'require',
        'sort|内容排序' => 'require|number',

    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '非有效内容信息',
        'id.number' => '非有效内容信息',
        'id.isExist' => '非有效内容信息',
    ];

    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['title','vice_title','content','sort'],
        'update' => ['id','title','vice_title','content','sort']
    ];


}
