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
use think\facade\Config;



class Verify extends Controller
{
    /*
     * $ type       定义验证码类型
     * */
    protected static $codeType = [
      1 => 'login_',        //登录验证码
      2 => 'forget_'        //忘记密码验证码
    ];

    /*
     * $ verifyTable        定义验证码记录数据表名
     * */
    protected static $verifyTable = 'verify';

    /*
     * $ overTime        定义验证码过期时间
     * 单位：秒
     * 默认值：3000 s
     * */
    protected static $overTime = 3000;

    /*
     * $ switch         获取验证码开关
     *  true        开启验证
     *  false       关闭验证
     * */
    protected static $switch = true;

    /*
     * @ getCode        获取验证码
     * @ param  $mobile     string      手机号码
     * @ param  $type       int         验证码类型
     * @ param  $over       int         验证码过期时间，单位秒（可选参数）
     * */
    public function getCode($mobile,$type,$over='')
    {
        if(!self::$switch)
            return json(['msg'=>'发送成功','code'=>'1']);

        if(!empty($over) && is_numeric($over))
            self::$overTime = $over;

        //生成验证码
        $code = mt_rand(100000,999999);

        //请求验证码服务器，发送验证码
        if($this->sendCode($mobile,$code)){
            $logData = [
                'phone' => $mobile,
                'code'  => $code,
                'type'  => $type,
                'ip'    => $this->request->ip(),
                'over_time' => self::$overTime
            ];
            Db::table(self::$verifyTable)->insert($logData);
            cache(self::$codeType[$type].$mobile,$code,self::$overTime);
            return json(['msg'=>'发送成功','code'=>1]);
        }
        return json(['msg'=>'发送失败，请重新获取','code'=>0]);
    }

    /**
     * 检验CODE是否有效
     * @param $mobile string 手机号
     * @param $type int    验证码类型
     * @param $verifyCode string 检验验证码
     * @return bool
     */
    public static function checkCode($mobile, $type, $verifyCode)
    {
        if(!self::$switch)
            return true;
        $code = cache(self::$codeType[$type].$mobile);
        if($code && $code == $verifyCode)
            return true;
        return false;

    }

    /**
     * 刷新验证码  在成功操作过后刷新
     * @param $mobile string 手机号
     * @param $type int    验证码类型
     * @param $code string 验证码
     * @throws \think\Exception
     */
    public static function finishCode($mobile, $type, $code)
    {
        //更新缓存
        cache(self::$codeType[$type].$mobile,null);
        //更新数据库
        Db::name(self::$verifyTable)->where('phone',$mobile)
                                    ->where('code',$code)
                                    ->update(['use_time'=>date('Y-m-d H:i:s')]);

    }

    /**
     * 向验证码服务器发送请求
     * @param $mobile string 手机号
     * @param $code string 验证码
     * @return bool
     */
    protected function sendCode($mobile, $code){
        $text = '【USDT】您的验证码为：' . $code . '，请在10分钟内完成验证';
        $objecturl = 'https://dx.ipyy.net/sms.aspx?action=send&userid=&account='
            . Config::get('sms_account')
            . '&password='
            . Config::get('sms_password')
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