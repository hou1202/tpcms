<?php

namespace app\index\validate;

use app\common\validate\CommonValidate;

class Order extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id'   =>  'require|number|isExist:car,id',
        'num' => 'require|number|integer',
        'goods_id' => 'require|number|isExist:goods,id',
        'spec_id' => 'require|number|isExist:goods_spec,id',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '订单信息有误',
        'id.number' => '订单信息有误',
        'id.isExist' => '订单信息有误',
        'num.require' => '订单信息有误',
        'num.number' => '订单信息有误',
        'num.integer' => '订单信息有误',
        'goods_id.require' => '订单信息有误',
        'goods_id.number' => '订单信息有误',
        'goods_id.isExist' => '订单信息有误',
        'spec_id.require' => '订单信息有误',
        'spec_id.number' => '订单信息有误',
        'spec_id.isExist' => '订单信息有误',
    ];

    /*
    * 定义验证场景
    * 格式：'场景名' => ['字段名1','字段名2']
    * */
    protected $scene = [
        'car' => ['id','num'],
        'purchase' => ['num','goods_id','spec_id']
    ];
}
