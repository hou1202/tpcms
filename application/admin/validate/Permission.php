<?php

namespace app\admin\validate;

use think\Validate;

class Permission extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id|权限组ID' => 'require|number',
        'title|权限组名称' => 'require|max:15',
        'router_id|路由'=> 'array',
        'status|权限组状态' =>'in:0,1'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '权限组信息有误',
        'id.number' => '权限组信息有误',
        'status.in' => '权限组状态信息有误',
        'router_id.array' => '权限线路由信息有误',
    ];

    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'status' => ['id','status'],
        'save' => ['title','router_id','status']
    ];
}
