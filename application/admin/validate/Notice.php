<?php

namespace app\admin\validate;

use app\common\validate\CommonValidate;

class Notice extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id'   =>  'require|number|isExist:notice,id',
        'title|信息标题' => 'require|length:2,50',
        'content|信息内容' => 'require|length:1,254',
        'user_id|推送用户' => 'require|number|isExist:user,id,id,true',

    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '非有效通知信息',
        'id.number' => '非有效通知信息',
        'id.isExist' => '非有效通知信息',
        'user_id.require' => '推送用户信息有误',
        'user_id.number' => '推送用户信息有误',
        'user_id.isExist' => '推送用户信息有误',
    ];

    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['title','content','user_id'],
        'update' => ['id','title','content','user_id']
    ];


}
