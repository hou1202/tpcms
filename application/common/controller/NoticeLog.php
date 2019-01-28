<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/18
 * Time: 11:45
 */

namespace app\common\controller;

use think\Db;

class NoticeLog
{

    /**
     * 创建用户消息通知
     * @param   int     $userId     用户ID,0为所有用户
     * @param   string  $title      记录标题
     * @param   float   $num        记录数值
     * @param   string     $type       变动类型：'-'=》减少；'+'=》增加
     * */
    public static function CreateNotice($userId, $title, $content ,$type=1)
    {
        $data = [
            'user_id' => $userId,
            'title' => $title,
            'content' => $content,
            'type' => $type,
        ];
        if($resource = Db::table('notice')->insertGetId($data)){
            return true;
        }else{
            return false;
        }
    }



}