<?php

namespace app\index\validate;

use app\common\validate\CommonValidate;

class Register extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    '__token__' => 'require|token',
	    'phone|帐户号码' => 'require|mobile|number|length:11|isExist:user',
        'password|帐户密码' => 'require|min:6',
        'code|验证码' => 'require|number|length:6'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'phone.isExist' => '帐户不存在，请先注册',
        'phone.unique' => '帐户已存在，请直接登录',
        'phone.number' => '帐户号码格式不正确',
        'phone.length' => '帐户号码格式不正确',
        'code.require' => '验证码不正确',
        'code.number' => '验证码不正确',
        'code.length' => '验证码不正确',
        '__token__.require' => '无效提交，请重新操作',
        '__token__.token' => '无效提交，请重新操作',
    ];

    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'login' => ['__token__','phone','password'],
        'forget' =>['__token__','phone','password','code'],
    ];


    /*
     * 定义编辑 Register 模式下，验证场景
     * */
    public function sceneRegister()
    {
        return $this ->remove('phone','isExist')
                     ->append('phone','unique:user,phone');
    }
}
