<?php

namespace app\admin\validate;

use app\common\validate\CommonValidate;

class Classify extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id|分类ID'   =>  'require|number|isExist:classify,id',
        'title|分类标题' => 'require|length:1,20',
        'p_id|父级分类' => 'require|number',
        'thumbnail|Banner 图' => 'require|max:254',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '非有效分类信息',
        'id.number' => '非有效分类信息',
        'id.isExist' => '非有效分类信息',
        'p_id.require' => '非有效父级分类信息',
        'p_id.number' => '非有效父级分类信息',
    ];

    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['title','p_id','thumbnail'],
    ];

    /*
     * 定义编辑 edit 模式下，验证场景
     * */
    public function sceneEdit()
    {
        return $this -> only(['id','title','p_id','thumbnail'])
            ->remove('thumbnail','require');
    }
}
