<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/10
 * Time: 22:16
 */

namespace app\admin\common;

use think\Db;
use think\facade\Config;
class Auth
{
    /**
     * 管理员用户表名
     * var string
     * */
    private static $defaultAdmin;

    /**
     * 管理员用户帐户字段名称,即$uuid
     * var  string
     * */
    private static $defaultField;

    /**
     * 认证开关
     * var boolean
     */
    private static $authNo;

    /**
     * 认证方式，1为实时认证；2为登录认证
     * var  number  1|2
     * */
    private static $authType;

    /*
     * 权限组表名
     * var string
     * */
    private static $authGroup;

    /*
     * 路由表名
     * var string
     * */
    private static $authRoute;

    /*
     * 用户信息表名
     * var string
     * */
    private static $authUser;

    /**
     * 是否已初始化
     * var boolean
     */
    private static $handler = false;

    /**
     * 初始化
     */
    public static function init(){
        self::$handler = true;  // 标记为初始化成功
        self::$authNo = true;
        self::$authType = 1;
        self::$authGroup = 'permissions';
        self::$authRoute = 'router';
        self::$authUser = 'adminer';
        self::$defaultAdmin = Config::get('default_admin');
        self::$defaultField = Config::get('admin_name');
    }

    /**
     * 检查权限
     * @param name string        需要验证的规则列
     * @param boolean $refresh   是否刷新
     * @param type int           认证方式，1为实时认证；2为登录认证
     * @param uid  int           认证用户的id
     * @return boolean           通过验证返回true;失败返回false
     */
    public static function check($name, $refresh=false, $type=1, $uid='') {
        !self::$handler && self::init(); // 初始化
        if (!self::$authNo)
            return true;
        if(empty($uid)){
            if(!$user = User::user()){
                return false;
            }
            $uid = $user['id'];
        }else{
            $user = self::getUserInfo($uid);
        }
        //系统默认管理员通过
        if($user[self::$defaultField] === self::$defaultAdmin) return true;
        if (!is_string($name)) return false;
        $name = strtolower($name);
        // 获取所有权限
        $allRules = self::allRules($refresh);
        // 转换为小写
        $allRulesTmp = array();
        foreach($allRules as $v){
            $allRulesTmp[] = strtolower($v['path']);
        }
        $allRules = array_unique($allRulesTmp);
        // 判断当前校验的权限规则是否需要权限(如果不存在预置的权限规则，则直接通过，可用)
        if (!in_array($name, $allRules)) {
            return true;
        }
        //获取用户需要验证的所有有效规则列表
        $authList = self::getAuthList($uid,$type,$refresh);
        if(in_array($name,$authList)){
            return true;
        }

        return false;
    }

    /**
     * 根据用户id获取用户权限数组,返回值为数组
     * @param  uid int     用户id
     * @return array       用户所属的路由组 array()
     */
    public static function getGroups($uid='') {
        !self::$handler && self::init(); // 初始化
        static $groups = array();
        if(empty($uid)){
            if(!$user = User::user()) return $groups;
            $uid = $user['id'];
        }
        if (isset($groups[$uid]))
            return $groups[$uid];

        $user_groups = Db::table(self::$authUser)
            ->alias('a')
            ->field('p.router_id')
            ->join(self::$authGroup.' p','a.permissions_id = p.id')
            ->where('a.id',$uid)
            ->find();
        $groups[$uid] = $user_groups ? explode('-',trim($user_groups['router_id'])) : array();
        return $groups[$uid];
    }

    /**
     * 获得权限列表
     * @param integer $uid  用户id
     * @param integer $type
     * @param boolean $refresh 是否刷新
     */
    public static function getAuthList($uid='',$type,$refresh=false) {
        !self::$handler && self::init(); // 初始化
        if(empty($uid)){
            if(!$user = User::user()) return false;
            $uid = $user['id'];
        }
        //保存用户验证通过的权限列表
        static $_authList = array();
        $t = implode(',',(array)$type);
        //如何不刷新，则判断数据是否存在并返回
        if(!$refresh){
            if (isset($_authList[$uid.$t])) return $_authList[$uid.$t];
            if (isset($_SESSION['_auth_list_'.$uid.$t]) && !empty($_SESSION['_auth_list_'.$uid.$t]))
                return $_SESSION['_auth_list_'.$uid.$t];
        }
        //读取用户所属用户权限数组
        $groups = self::getGroups($uid);

        //读取用户组所有权限规则
        $rules = Db::name(self::$authRoute)
            ->field('router,path')
            ->where('id','in',$groups)
            ->where('status',1)
            ->select();
        //循环规则，判断结果。
        $authList = array();
        foreach ($rules as $rule) {
            if (!empty($rule['path'])) {
                $authList[] = strtolower($rule['path']);
            }
        }

        $_authList[$uid.$t] = $authList = array_unique($authList);
        //规则列表结果保存到session
        $_SESSION['_auth_list_'.$uid.$t]=$authList;
        return $authList;
    }

    /**
     * 获取所有可用的权限规则
     * @param  boolean $refresh 是否刷新
     * return array|false
     */
    public static function allRules($refresh = false){
        !self::$handler && self::init(); // 初始化
        // 设置静态变量
        static $allRules = null;
        // 读取静态变量（不刷新），如果存在，则直接返回
        if (!$refresh) {
            if($allRules != null) return $allRules;
            if (isset($_SESSION['_all_router_list']) && !empty($_SESSION['_all_router_list']))
                return $_SESSION['_all_router_list'];
        }
        $allRules = Db::name(self::$authRoute)->where('status',1)->select();
        //规则列表结果保存到session
        $_SESSION['_all_router_list']=$allRules;
        return $allRules;
    }

    /**
     * 获得用户资料,根据自己的情况读取数据库
     */
    public static function getUserInfo($uid) {
        static $userinfo=array();
        if(!isset($userinfo[$uid])){
            $userinfo[$uid]=Db::name(self::$authUser)->where(array('id'=>$uid))->find();
        }
        return $userinfo[$uid];
    }



}