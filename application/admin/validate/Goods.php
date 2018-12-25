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
	    'id|产品ID'   =>  'require|number|isExist:goods,id',
	    'title|产品标题' => 'require|length:4,150',
	    'info|产品副标题' => 'require|length:4,150',
        'classify_id|产品分类' => 'require|number|isExist:classify,id',
	    'thumbnail|缩略图' => 'require|max:254',
	    'banner|轮播图' => 'require|array',
	    'origin_price|产品原价' => 'require|float',
	    'sell_price|产品售价' => 'require|float',
	    'cost_price|产品成本价' => 'require|float',
	    'franking|产品邮费' => 'require|number|integer',
	    'volume|产品销量' => 'require|number|integer',
	    'address|发货地址' => 'require|length:1,15',
        'status|产品状态' =>'in:0,1',
        'recom|产品推荐' =>'in:0,1',
	    'spec|产品规格' => 'require|array',
        'name|产品规格名称' =>  'require|length:2,20',
        'price|产品规格价格' =>  'require|float',
        'stock|产品规格库存' =>  'require|number|integer',
        'params|产品参数' =>  'array',
        'p_key|产品参数名称' =>  'require|max:30',
        'p_value|产品参数值' =>  'require|max:30',

    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '非有效产品信息',
        'id.number' => '非有效产品信息',
        'id.isExist' => '非有效产品信息',
        'classify_id.number' => '产品分类信息有误1',
        'classify_id.isExist' => '产品分类信息有误2',
        'banner.array' => '轮播图信息有误',
        'origin_price.float' => '产品原价设置有误。例：10 或 10.25',
        'sell_price.float' => '产品售价设置有误。例：10 或 10.25',
        'cost_price.float' => '产品成本价设置有误。例：10 或 10.25',
        'franking.number' => '产品邮费设置有误，应该为整数。例：10',
        'franking.integer' => '产品邮费设置有误，应该为整数。例：10',
        'volume.number' => '产品销量设置有误，应该为整数。例：10',
        'volume.integer' => '产品销量设置有误，应该为整数。例：10',
        'spec.array' => '产品规格信息有误',
        'price.float' => '产品规格价格设置有误。例：10 或 10.25',
        'stock.number' => '产品规格库存设置有误，应该为整数。例：10',
        'stock.integer' => '产品规格库存设置有误，应该为整数。例：10',
        'params.array' => '产品参数信息有误',
        'status.in' => '产品状态信息有误',
        'recom.in' => '产品推荐信息有误',
    ];

    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['title','info','classify_id','thumbnail','banner','origin_price','sell_price','cost_price','franking','volume','address','status','recom','spec','params'],
        'spec' => ['name','price','stock'],
        'params' => ['p_key','p_value'],
        'status' =>['id','status'],
        'recom' =>['id','recom'],

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
