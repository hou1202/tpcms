<?php

namespace app\admin\validate;

use app\common\validate\CommonValidate;
use think\Validate;

class Admin extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id' => 'require|number|isExist:adminer,id',
        'account|帐户' => 'require|length:5,20|unique:adminer',
        'password|帐户密码' => 'require|length:6,20',
        'name|真实姓名' => 'require|length:2,10',
        'status' => 'in:0,1',
        'permissions_id|所属权限组' => 'require|number|gt:0|isExist:permissions,id',
        'remark|备注内容' => 'max:255',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.required' => '提交内容为非有效信息',
        'id.number' => '提交内容为非有效信息',
        'id.isExist' => '提交内容为非有效信息',
        'account.isExist' => '帐户信息有误',
        'status.in' => '提交内容为非有效信息',
        'permissions_id.number' => '所属权限组为非有效信息',
        'permissions_id.gt' => '所属权限组为非有效信息',
        'permissions_id.isExist' => '所属权限组为非有效信息',
    ];

    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'status' => ['id','status'],
        'save' => ['account','password','name','status','permissions_id','remark']
    ];

    /*
     * 定义编辑 edit 模式下，验证场景
     * */
    public function sceneEdit()
    {
        return $this -> only(['account','password','name','status','permissions_id','remark'])
            ->remove('account','unique')
            ->remove('password','require')
            ->append('password','requireCallback:checkEmpty');
    }

    public function sceneLogin()
    {
        return $this  -> only(['account','password'])
            ->remove('account','unique')
            ->append('account','isExist:adminer,account');
    }



}
