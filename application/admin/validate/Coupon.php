<?php

namespace app\admin\validate;

use app\common\validate\CommonValidate;

class Coupon extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id'   =>  'require|number|isExist:coupon,id',
        'title|优惠券标题' => 'require|length:1,30',
        'type|优惠券类型' => 'require|in:1,2,3',
        'goods_id|链接产品' => 'requireIf:type,2|isExist:goods,id',
        'classify_id|链接分类' => 'requireIf:type,3|isExist:classify,id',
        'money_satisfy|满足条件金额' => 'require|float',
        'money_derate|减免金额' => 'require|float',
        'end_time|结束时间' => 'require|date',
        'status|优惠券状态' => 'in:0,1',

    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '非有效优惠券信息',
        'id.number' => '非有效优惠券信息',
        'id.isExist' => '非有效优惠券信息',
        'type.in' => '优惠券类型有误',
        'goods_id.isExist' => '非有效的关联产品信息',
        'classify_id.isExist' => '非有效的关联分类信息',
        'money_satisfy.float' => '优惠券满足条件金额有误',
        'money_derate.float' => '优惠券减免金额有误',
        'end_time.date' => '优惠券有效结束时间有误',
        'status.in' => '优惠券状态有误',
    ];

    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['title','type','status','goods_id','classify_id','money_satisfy','money_derate','end_time'],
        'status' =>['id','status'],
        'update' =>['id','title','type','status','goods_id','classify_id','money_satisfy','money_derate','end_time'],

    ];
}
