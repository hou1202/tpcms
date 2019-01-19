<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/19
 * Time: 14:05
 */

namespace app\index\validate;


use app\common\validate\CommonValidate;

class Comments extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'order_id'   =>  'require|number|isExist:order,id',
        'goods_id'   =>  'require|number|isExist:goods,id',
        'star'   =>  'require|number|in:1,2,3,4,5',
        'content|评论内容' => 'require|length:10,255',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'order_id.require' => '非有效评论信息1',
        'order_id.number' => '非有效评论信息',
        'order_id.isExist' => '非有效评论信息',
        'goods_id.require' => '非有效评论信息',
        'goods_id.number' => '非有效评论信息',
        'goods_id.isExist' => '非有效评论信息',
        'star.require' => '非有效评论信息',
        'star.number' => '非有效评论信息',
        'star.in' => '非有效评论信息',
    ];


    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['goods_id','star','content']

    ];
}
