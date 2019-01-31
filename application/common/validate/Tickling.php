<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/19
 * Time: 14:05
 */

namespace app\common\validate;


class Tickling extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'id' => 'require|number|isExist:tickling,id',
        'user_id' => 'require|number|isExist:user,id',
        'content|反馈内容'   =>  'require|max:500',
        'img'   =>  'array',
        'status|反馈状态'   =>  'require|number|in:0,1',
        'reply|反馈回复'   =>  'max:500',


    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'id.require' => '非有效反馈信息',
        'id.number' => '非有效反馈信息',
        'id.isExist' => '非有效反馈信息',
        'user_id.require' => '非有效反馈信息',
        'user_id.number' => '非有效反馈信息',
        'user_id.isExist' => '非有效反馈信息',
        'img.array' => '反馈图信息有误',
        'status.number' => '反馈状态信息有误',
        'status.in' => '反馈状态信息有误',

    ];


    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['content','img'],
        'update' => ['id','status','reply'],

    ];
}
