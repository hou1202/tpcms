<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/18
 * Time: 11:45
 */

namespace app\common\controller;

use think\Db;

class MoneyLog
{

    /**
     * 积分变动记录
     * @param   int     $userId     用户ID
     * @param   string  $title      记录标题
     * @param   float   $num        记录数值
     * @param   string     $type       变动类型：'-'=》减少；'+'=》增加
     * */
    public static function IntegralLog($userId, $title, $num ,$type)
    {
        $data = [
            'user_id' => $userId,
            'title' => $title,
            'integral' => $num,
            'type' => $type,
        ];
        if($resource = Db::table('log_integral')->insertGetId($data)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 帐户余额变动记录
     * @param   int     $userId     用户ID
     * @param   string  $title      记录标题
     * @param   float   $num        记录数值
     * @param   string     $type       变动类型：'-'=》减少；'+'=》增加
     * */
    public static function BalanceLog($userId, $title, $num ,$type)
    {
        $data = [
            'user_id' => $userId,
            'title' => $title,
            'money' => $num,
            'type' => $type,
        ];
        if($resource = Db::table('log_money')->insertGetId($data)){
            return true;
        }else{
            return false;
        }
    }

}