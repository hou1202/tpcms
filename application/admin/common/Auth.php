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
     * $name
     * */
    private static $account;

    //默认配置
    protected $_config = array(
        'auth_on'           => true,                // 认证开关
        'auth_type'         => 1,                   // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        => 'permissions',        // 用户组数据表名
        'auth_group_access' => 'group_access',      // 用户-用户组关系表
        'auth_rule'         => 'router',         // 权限规则表
        'auth_user'         => 'adminer'             // 用户信息表
    );

    public function __construct() {
        if (config('auth_config')) {
            //可设置配置项 auth_config, 此配置项为数组。
            $this->_config = array_merge($this->_config, config('auth_config'));
        }

        self::$defaultAdmin = Config::get('default_admin');
        self::$account = Config::get('admin_name');
    }

    /**
     * 检查权限
     * @param name string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
     * @param uid  int           认证用户的id
     * @param string mode        执行check的模式
     * @param relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
     * @return boolean           通过验证返回true;失败返回false
     */
    public  function check($name, $uid='', $type=1, $mode='url', $relation='or') {
        if (!$this->_config['auth_on'])
            return true;
        if(empty($uid)){
            if(!$user = User::user()){
                return false;
            }
            $uid = $user['id'];
        }

        //var_dump($uid);die;
        $authList = $this->getAuthList($uid,$type); //获取用户需要验证的所有有效规则列表

        if (is_string($name)) {
            $name = strtolower($name);
            if (strpos($name, ',') !== false) {
                $name = explode(',', $name);
            } else {
                $name = array($name);
            }
        }
        $list = array(); //保存验证通过的规则名
        if ($mode=='url') {
            $REQUEST = unserialize( strtolower(serialize($_REQUEST)) );
        }
        foreach ( $authList as $auth ) {
            $query = preg_replace('/^.+\?/U','',$auth);
            if ($mode=='url' && $query!=$auth ) {
                parse_str($query,$param); //解析规则中的param
                $intersect = array_intersect_assoc($REQUEST,$param);
                $auth = preg_replace('/\?.*$/U','',$auth);
                if ( in_array($auth,$name) && $intersect==$param ) {  //如果节点相符且url参数满足
                    $list[] = $auth ;
                }
            }else if (in_array($auth , $name)){
                $list[] = $auth ;
            }
        }
        if ($relation == 'or' and !empty($list)) {
            return true;
        }
        $diff = array_diff($name, $list);
        if ($relation == 'and' and empty($diff)) {
            return true;
        }
        return false;
    }

    /**
     * 根据用户id获取用户组,返回值为数组
     * @param  uid int     用户id
     * @return array       用户所属的路由组 array()
     */
    public function getGroups($uid) {
        static $groups = array();
        if (isset($groups[$uid]))
            return $groups[$uid];
        /*$user_groups = Db::table($this->_config['auth_group_access'])
            ->alias('a')
            ->join($this->_config['auth_group']." g", "g.id=a.group_id")
            ->where("a.aid='$uid' and g.status='1'")
            ->field('aid,group_id,title,rules')->select();*/
        $user_groups = Db::table($this->_config['auth_user'])
            ->alias('a')
            ->field('p.router_id')
            ->join($this->_config['auth_group'].' p','a.permissions_id = p.id')
            ->where('a.id',$uid)
            ->find();
        $groups[$uid] = $user_groups ? explode('-',trim($user_groups['router_id'])) : array();
        return $groups[$uid];
    }

    /**
     * 获得权限列表
     * @param integer $uid  用户id
     * @param integer $type
     */
    protected function getAuthList($uid,$type) {
        //保存用户验证通过的权限列表
        static $_authList = array();
        $t = implode(',',(array)$type);
        if (isset($_authList[$uid.$t])) {
            return $_authList[$uid.$t];
        }
        if( $this->_config['auth_type']==2 && isset($_SESSION['_auth_list_'.$uid.$t])){
            return $_SESSION['_auth_list_'.$uid.$t];
        }

        //读取用户所属用户组
        $groups = $this->getGroups($uid);
        $ids = array();//保存用户所属用户组设置的所有权限规则id
        /*foreach ($groups as $g) {
            $ids = array_merge($ids, explode('-', trim($g['router_id'])));
        }*/
        $ids = array_merge($ids, $groups);
        //var_dump($ids);die;
        //$ids = array_unique($ids);
        if (empty($ids)) {
            $_authList[$uid.$t] = array();
            return array();
        }
        //读取用户组所有权限规则
        //$rules = \think\Db::name($this->_config['auth_rule'])->where($map)->field('condition,name')->select();
        //$rules = Db::name($this->_config['auth_rule'])->where($map)->field('id,router,menu,path,title')->select();
        $rules = Db::name($this->_config['auth_rule'])
            ->field('id,router,menu,path,title')
            ->where('id','in',$ids)
            ->where('status',1)
            ->select();
        var_dump($rules);die;
        //循环规则，判断结果。
        $authList = array();   //
        foreach ($rules as $rule) {
            if (!empty($rule['condition'])) { //根据condition进行验证
                $user = $this->getUserInfo($uid);//获取用户信息,一维数组

                $command = preg_replace('/\{(\w*?)\}/', '$user[\'\\1\']', $rule['condition']);
                //dump($command);//debug
                @(eval('$condition=(' . $command . ');'));
                if ($condition) {
                    $authList[] = strtolower($rule['name']);
                }
            } else {
                //只要存在就记录
                $authList[] = strtolower($rule['name']);
            }
        }
        $_authList[$uid.$t] = $authList;
        if($this->_config['auth_type']==2){
            //规则列表结果保存到session
            $_SESSION['_auth_list_'.$uid.$t]=$authList;
        }
        return array_unique($authList);
    }

    /**
     * 获得用户资料,根据自己的情况读取数据库
     */
    protected function getUserInfo($uid) {
        static $userinfo=array();
        if(!isset($userinfo[$uid])){
            $userinfo[$uid]=Db::name($this->_config['auth_user'])->where(array('id'=>$uid))->find();
        }
        return $userinfo[$uid];
    }



}