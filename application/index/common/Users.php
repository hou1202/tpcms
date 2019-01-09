<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/11/13
 * Time: 15:29
 */

namespace app\index\common;

use think\facade\Config;
use think\Db;

class Users
{

    /*
     *前台用户检测专用
     *  */

    /**
     * 生成session的key
     * var string
     */
    private static $sessionKey;
    /**
     * 用户加密密钥
     * var string
     */
    private static $authKey;
    /**
     * 是否已初始化
     * var boolean
     */
    private static $handler = false;

    /**
     * 用户表名
     * var string
     * */
    private static $table;

    /**
     * 用户帐户字段名称,即$uid
     * $name
     * */
    private static $name;

    /**
     * 用户帐户密码字段名称,
     * $name
     * */
    private static $password;

    /**
     * 初始化
     */
    public static function init(){
        self::$sessionKey = 'login_user_'.md5('user');
        self::$authKey = Config::get('crypt_user_key');
        self::$handler = true;  // 标记为初始化成功
        self::$table = Config::get('user_table');
        self::$name = Config::get('user_name');
        self::$password = Config::get('user_pwd');
    }

    /**
     * 内容信息定义
     * @param   string  $uid        用户Phone
     * @param   string  $token      $user[phone].$user[password]
     * @param   string  $uid       用户phone
     * */

    /**
     * 获取用户信息
     * @param  string  $uid        uid，为空，则获取当前登录用户的用户信息
     * @param  boolean $refresh     是否重新刷新，false为不刷新直接读取静态变量；true重新获取
     * return array|false
     */
    public static function user($uid = '', $refresh = false){
        !self::$handler && self::init();
        // 设置静态变量
        static $users = array();
        // 如未设置uid，则获取当前登录的用户uid
        if (empty($uid)) {
            if (!$uid = self::login_uid()) return false;
        }
        // 读取静态变量（不刷新），如果存在，则直接返回
        if (!$refresh && array_key_exists($uid, $users))
            return $users[$uid];

        //读取缓存信息，如果存在，则直接返回
        if($ache_user = cache('login_'.md5($uid)))
            return $ache_user;

        // 数据库获取用户信息
        $users[$uid] = Db::table(self::$table)->where(self::$name,$uid)->find();
        //缓存用户数据
        self::cacheUser($uid,$users[$uid]);
        return $users[$uid];
    }

    /**
     * 判断用户是否登录
     * return string|false 如登录，则返回uid，否则false
     */

    public static function check(){
        !self::$handler && self::init(); // 初始化
        //获取并判断session存储的用户信息
        if (!$sArrs = session(self::$sessionKey)) {
            return false;
        }
        if (!array_key_exists('uid', $sArrs) || !array_key_exists('token', $sArrs)) {
            return false;
        }
        // 解密 并 获取uid
        $uid = DDecrypt($sArrs['uid'], self::$authKey);
        // 设置静态变量
        static $users = array();
        // 读取数据
        if (array_key_exists($uid, $users)) {
            $user = $users[$uid];
        } elseif($cache_user = cache('login_'.md5($uid))) {
            $user = $users[$uid] = $cache_user;
        }else{
            $user = $users[$uid] = Db::table(self::$table)->where(array('status' => 1, self::$name => $uid))->find();
            self::cacheUser($uid,$user);
        }
        if (!$user) {
            self::logout(); //登出
            return false;
        }
        // 校验token
        $tokenStr       = $user[self::$name].$user[self::$password];
        $verifyTokenStr = DDecrypt($sArrs['token'], self::$authKey); //待校验token
        if (!$verifyTokenStr || $verifyTokenStr != $tokenStr) {
            self::logout(); //登出
            return false;
        }
        return $user[self::$name];
    }

    /**
     * 用户登录
     * @param  string $uid uid
     * return boolean
     */

    public static function login($uid){
        !self::$handler && self::init(); // 初始化
        if (empty($uid))
            return false;
        // 读取用户信息
        $user = self::user($uid);
        if (!$user) return false;
        // 加密用户信息并生成session
        $tokenStr = $user[self::$name].$user[self::$password];
        $sArrs    = array(
            'uid'       => DEncrypt($user[self::$name], self::$authKey),
            'token'     => DEncrypt($tokenStr, self::$authKey),
            'timestamp' => time()
        );
        session(self::$sessionKey, $sArrs);
        return true;
    }

    /**
     * 登出
     */
    public static function logout(){
        !self::$handler && self::init(); // 初始化
        session(self::$sessionKey, null);
        cache('login_'.md5(self::login_uid()),null);
    }

    /**
     * 获取登录用户的uid
     * return string      返回uid
     */
    public static function login_uid(){
        static $uid = null;
        if ($uid == null) {
            $uid = self::check();
        }
        return $uid;
    }

    /**
     * 缓存用户信息
     * @param  string $uid uid
     * @param  array $user 用户数据
     * return boolean
     * */
    public static function cacheUser($uid,$user='')
    {
        if(!$user)
            $user = Db::table(self::$table)->where(array('status' => 1, self::$name => $uid))->find();
        cache('login_'.md5($uid),$user,86400);
        return true;
    }

}