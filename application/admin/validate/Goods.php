<?php

namespace app\admin\validate;

use app\common\validate\CommonValidate;

class Goods extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'title|产品标题' => 'require|length:4,30',
	    'info|产品副标题' => 'require|length:4,30',
	    'thumbnail|缩略图' => 'require',
	    'banner|轮播图' => 'require',
	    'origin-price|产品原价' => 'require|number',
	    'sell-price' => 'require',
	    'cost-price' => 'require',
	    'franking' => 'require',
	    'volume' => 'require',
	    'address' => 'require',
	    'spec' => 'require',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [];
}
