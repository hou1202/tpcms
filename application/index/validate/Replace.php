<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/19
 * Time: 14:05
 */

namespace app\index\validate;


use app\common\validate\CommonValidate;

class Replace extends CommonValidate
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
        'type'   =>  'require|number|in:1,2',
        'reason'   =>  'require|chsDash',
        'img'   =>  'require|array',
        'info' => 'max:255',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'order_id.require' => '非有效评论信息',
        'order_id.number' => '非有效评论信息',
        'order_id.isExist' => '非有效评论信息',
        'goods_id.require' => '非有效评论信息',
        'goods_id.number' => '非有效评论信息',
        'goods_id.isExist' => '非有效评论信息',
        'type.require' => '申请类型信息有误',
        'type.number' => '申请类型信息有误',
        'type.in' => '申请类型信息有误',
        'reason.require' => '申请原因信息有误',
        'reason.chsDash' => '申请原因信息有误',
        'img.require' => '申请反馈信息图有误',
        'img.array' => '申请反馈信息图有误',
        'info.max' => '备注说明最大为255个字符',
    ];


    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['goods_id','type','reason','img','info']

    ];
}
