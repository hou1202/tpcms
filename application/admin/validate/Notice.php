<?php

namespace app\admin\validate;

use app\common\validate\CommonValidate;

class Notice extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'id'   =>  'require|number|isExist:notice,id',
        'title|信息标题' => 'require|length:2,50',
        'info|信息内容' => 'require|length:1,254',
        'user_id|推送用户' => 'require|isExist:user,id',

    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'id.require' => '非有效推荐信息',
        'id.number' => '非有效推荐信息',
        'id.isExist' => '非有效推荐信息',
        'status.in' => '推荐状态信息有误',
        'goods_id.require' => '链接产品信息有误',
        'goods_id.isExist' => '链接产品信息有误',
        'goods_title.require' => '链接产品信息有误',
    ];

    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['title','info','status','thumbnail','goods_id','goods_title'],
        'status' => ['id','status']
    ];

    /*
     * 定义编辑 edit 模式下，验证场景
     * */
    public function sceneEdit()
    {
        return $this -> only(['id','title','info','status','thumbnail','goods_id','goods_title'])
            ->remove('thumbnail','require');
    }
}
