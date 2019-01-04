<?php

namespace app\index\validate;

use app\common\validate\CommonValidate;

class Address extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id'   =>  'require|number|isExist:address,id',
        'user_id'   =>  'require|number|isExist:user,id',
        'name|收货人姓名' => 'require|length:2,20',
        'phone|收货人联系方式' => 'require|mobile',
        'city|收货城市' => 'require|length:5,30',
        'street|收货详细地址' => 'require|length:2,200',
        'choice|默认收货地址状态' => 'in:0,1',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '非有效收货地址信息',
        'id.number' => '非有效收货地址信息',
        'id.isExist' => '非有效收货地址信息',
        'user_id.require' => '非有效收货地址信息',
        'user_id.number' => '非有效收货地址信息',
        'user_id.isExist' => '非有效收货地址信息',
        'phone.mobile' => '收货人联系方式信息有误',
        'choice.in' => '默认收货地址状态信息有误',
    ];


    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['name','phone','city','street','choice'],
        'update' => ['id','name','phone','city','street','choice'],

    ];
}
