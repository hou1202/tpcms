<?php

namespace app\index\validate;

use app\common\validate\CommonValidate;

class Car extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id' =>  'require|number|isExist:car,id',
        'user_id' => 'require|number|isExist:user,id',
        'goods_id' => 'require|number|isExist:goods,id',
        'spec_id' => 'require|number|isExist:goods_spec,id',
        'num|购物数量' => 'require|number|integer|egt:1',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '非有效购物车信息',
        'id.number' => '非有效购物车信息',
        'id.isExist' => '非有效购物车信息',
        'user_id.require' => '非有效用户信息',
        'user_id.number' => '非有效用户信息',
        'user_id.isExist' => '非有效用户信息',
        'goods_id.require' => '非有效购物商品信息',
        'goods_id.number' => '非有效购物商品信息',
        'goods_id.isExist' => '非有效购物商品信息',
        'spec_id.require' => '非有效商品规格信息',
        'spec_id.number' => '非有效商品规格信息',
        'spec_id.isExist' => '非有效商品规格信息',
        'num.number' => '非有效购物数量信息',
        'num.integer' => '非有效购物数量信息',
        'num.egt' => '非有效购物数量信息',

    ];

    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'join' => ['goods_id','spec_id','num'],

    ];

    /*
     * 定义编辑 edit 模式下，验证场景
     * */
    public function sceneEdit()
    {
        return $this -> only(['id','title','classify_id','info','thumbnail','banner','origin_price','sell_price','cost_price','franking','volume','address','status','recom','spec','params'])
            ->remove('thumbnail','require')
            ->remove('banner','require');
    }
}
