<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/15
 * Time: 15:42
 */

namespace app\index\controller;

use think\Controller;
use think\Db;



class Verify extends Controller
{
    /*
     * $ type       定义验证码类型
     * */
    protected static $codeType = [
      1 => 'login_',
      2 => 'forget_'
    ];

    /*
     * $ verifyTable        定义验证码记录数据表名
     * */
    protected static $verifyTable = 'verify';

    /*
     * $ on         获取验证码开关
     *  true        开启验证
     *  false       关闭验证
     * */
    protected static $on = true;

    /*
     * @ getCode        获取验证码
     * */
    public function getCode($mobile,$type)
    {
        if(!self::$on)
            return json(['msg'=>'发送成功','code'=>'1']);
        //var_dump($over);


        return json([1=>$mobile,2=>$type,3=>$this->request->ip()]);
    }


    /**
     * 刷新验证码  在成功操作过后刷新
     * @param $code string 验证码
     * @param $type int    验证码类型
     * @param $mobile string 手机号
     * @throws \think\Exception
     */
    public static function finishVerify($code, $mobile, $type)
    {
        //更新SESSION
        session(self::$codeType[$type].$mobile,null);
        //更新数据库
        Db::name(self::$verifyTable)->where('phone',$mobile)
                                    ->where('code',$code)
                                    ->update(['use_time'=>date('Y-m-d H:i:s')]);

    }

    /**
     * 向验证码服务器发送请求
     * @param $mobile string 手机号
     * @param $verifyCode string 验证码
     * @return bool
     */
    protected function sendCode($mobile, $verifyCode){
        $text = '【USDT】您的验证码为：' . $verifyCode . '，请在10分钟内完成验证';
        $objecturl = 'https://dx.ipyy.net/sms.aspx?action=send&userid=&account='
            . ThinkConfig::get('sms_account')
            . '&password='
            . ThinkConfig::get('sms_password')
            . '&mobile='
            . $mobile
            . '&content=' . urlencode($text) . '&sendTime=&extno=';
        try {
            $results = file_get_contents($objecturl);
        }catch(\Exception $e){
            return false;
        }
        $results = explode('<returnstatus>', $results);
        $results = explode('</returnstatus>', $results[1]);
        $results = $results[0];
        return $results == 'Success' ? true : false;
    }
}