<?php

namespace app\admin\validate;

use app\common\validate\CommonValidate;

class Banner extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id|Banner ID'   =>  'require|number|isExist:banner,id',
        'title|Banner标题' => 'require|length:2,30',
        'type|Banner 类型' => 'require|in:1,2,3,4',
        'status|Banner 状态' => 'in:0,1',
        'thumbnail|Banner 图' => 'require|max:254',
        'url|Url 链接地址' => 'requireIf:type,4|url',
        'goods_id|链接产品' => 'requireIf:type,2|isExist:goods,id',
        'classify_id|链接分类' => 'requireIf:type,3|isExist:classify,id',

    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '非有效Banner信息',
        'id.number' => '非有效Banner信息',
        'id.isExist' => '非有效Banner信息',
        'type.in' => 'Banner类型有误',
        'status.in' => 'Banner状态有误',
        'url.url' => 'Url 链接地址信息有误',
        'goods_id.isExist' => '链接产品信息有误',
        'classify_id.isExist' => '链接分类信息有误',
    ];


    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['title','type','thumbnail','status','url','goods_id','classify_id'],
        'status' =>['id','status'],

    ];

    /*
     * 定义编辑 edit 模式下，验证场景
     * */
    public function sceneEdit()
    {
        return $this -> only(['id','title','type','thumbnail','status','url','goods_id','classify_id'])
            ->remove('thumbnail','require');
    }
}
