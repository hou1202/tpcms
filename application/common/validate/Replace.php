<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/19
 * Time: 14:05
 */

namespace app\common\validate;


class Replace extends CommonValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'id' => 'require|number|isExist:replace,id',
        'order_id'   =>  'require|number|isExist:order,id',
        'goods_id'   =>  'require|number|isExist:goods,id',
        'type'   =>  'require|number|in:1,2',
        'reason'   =>  'require|chsDash',
        'img'   =>  'require|array',
        'info' => 'max:255',
        'company|快递公司信息' => 'require|chsAlpha',
        'waybill|快递单号' => 'require|alphaNum|length:12,18',
        'tickling|反馈信息' => 'max:500',
        'status' => 'requireExist|number|in:0,1,2'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'id.require' => '非有效售后信息',
        'id.number' => '非有效售后信息',
        'id.isExist' => '非有效售后信息',
        'order_id.require' => '非有效订单信息',
        'order_id.number' => '非有效订单信息',
        'order_id.isExist' => '非有效订单信息',
        'goods_id.require' => '非有效订单产品信息',
        'goods_id.number' => '非有效订单产品信息',
        'goods_id.isExist' => '非有效订单产品信息',
        'type.require' => '申请类型信息有误',
        'type.number' => '申请类型信息有误',
        'type.in' => '申请类型信息有误',
        'reason.require' => '申请原因信息有误',
        'reason.chsDash' => '申请原因信息有误',
        'img.require' => '申请反馈信息图有误',
        'img.array' => '申请反馈信息图有误',
        'info.max' => '备注说明最大为255个字符',
        'company.chsAlpha' => '快递公司信息有误',
        'waybill.alphaNum' => '快递单号信息有误',
        'waybill.length' => '快递单号信息有误',
        'status.requireExist' => '售后处理不得为空',
        'status.number' => '非有效售后处理信息',
        'status.in' => '非有效售后处理信息',
    ];


    /*
     * 定义验证场景
     * 格式：'场景名' => ['字段名1','字段名2']
     * */
    protected $scene = [
        'create' => ['goods_id','type','reason','img','info'],
        'update' => ['id','company','waybill'],
        'admin_update' => ['id','status','tickling']

    ];
}
