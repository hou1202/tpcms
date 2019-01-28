<?php

namespace app\common\validate;

use app\common\validate\CommonValidate;

class User extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id|用户ID'   =>  'require|number|isExist:user,id',
        'name|昵称' => 'require|length:1,15',
        'password|密码' => 'min:6',
        'portrait|头像'  => 'max:255',
        'balance|帐户余额'  => 'require|float',
        'status|帐户状态' =>'in:0,1',
        'sex|性别' =>'in:0,1',
        'birthday|生日' => 'date',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '帐户信息有误',
        'id.number' => '帐户信息有误',
        'id.isExist' => '帐户信息有误',
        'balance.float' => '帐户余额信息有误',
        'status.in' => '状态信息有误',
        'sex.in' => '性别信息有误',
    ];


    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'status' =>['id','status'],
        'update' =>['id','name','password','portrait','balance','status','sex','birthday'],
        'indexUpdate' =>['id','name','portrait','sex','birthday'],
    ];
}
