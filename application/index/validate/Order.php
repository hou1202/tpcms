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
        'order_id' => 'require|number|isExist:order,id',
        'address_id' => 'require|number|isExist:address,id',
        'coupon_id' => 'require|number|isExist:coupon,id',
        'pay_type' => 'require|number|in:1,2,3',
        'message' => 'max:100',
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

        'order_id.require' => '订单信息有误',
        'order_id.number' => '订单信息有误',
        'order_id.isExist' => '订单信息有误',

        'address_id.require' => '订单信息有误',
        'address_id.number' => '订单信息有误',
        'address_id.isExist' => '订单信息有误',

        'coupon_id.require' => '订单信息有误',
        'coupon_id.number' => '订单信息有误',
        'coupon_id.isExist' => '订单信息有误',

        'pay_type.require' => '订单信息有误',
        'pay_type.in' => '订单信息有误',
        'message.max' => '留言信息最多100个字',

    ];

    /*
    * 定义验证场景
    * 格式：'场景名' => ['字段名1','字段名2']
    * */
    protected $scene = [
        'car' => ['id','num'],
        'purchase' => ['num','goods_id','spec_id'],
        'payment' => ['order_id','address_id','coupon_id','pay_type','message']
    ];
}
