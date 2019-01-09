<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 应用设置
// +----------------------------------------------------------------------

return [
    // 应用名称
    'app_name'               => '',
    // 应用地址
    'app_host'               => '',
    // 应用调试模式
    'app_debug'              => true,
    // 应用Trace
    'app_trace'              => false,
    // 是否支持多模块
    'app_multi_module'       => true,
    // 入口自动绑定模块
    'auto_bind_module'       => false,
    // 注册的根命名空间
    'root_namespace'         => [],
    // 默认输出类型
    'default_return_type'    => 'html',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    // 默认JSONP格式返回的处理方法
    'default_jsonp_handler'  => 'jsonpReturn',
    // 默认JSONP处理方法
    'var_jsonp_handler'      => 'callback',
    // 默认时区
    'default_timezone'       => 'Asia/Shanghai',
    // 是否开启多语言
    'lang_switch_on'         => false,
    // 默认全局过滤方法 用逗号分隔多个
    //'default_filter'         => 'trim,htmlentities,htmlspecialchars',
    'default_filter'         => 'trim,htmlspecialchars',
    // 默认语言
    'default_lang'           => 'zh-cn',
    // 应用类库后缀
    'class_suffix'           => false,
    // 控制器类后缀
    'controller_suffix'      => false,

    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

    // 默认模块名
    'default_module'         => 'index',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空模块名
    'empty_module'           => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 操作方法前缀
    'use_action_prefix'      => false,
    // 操作方法后缀
    'action_suffix'          => '',
    // 自动搜索控制器
    'controller_auto_search' => false,

    // +----------------------------------------------------------------------
    // | URL设置
    // +----------------------------------------------------------------------

    // PATHINFO变量名 用于兼容模式
    'var_pathinfo'           => 's',
    // 兼容PATH_INFO获取
    'pathinfo_fetch'         => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
    // pathinfo分隔符
    'pathinfo_depr'          => '/',
    // HTTPS代理标识
    'https_agent_name'       => '',
    // IP代理获取标识
    'http_agent_ip'          => 'X-REAL-IP',
    // URL伪静态后缀
    'url_html_suffix'        => '',
    // URL普通方式参数 用于自动生成
    'url_common_param'       => false,
    // URL参数方式 0 按名称成对解析 1 按顺序解析
    'url_param_type'         => 0,
    // 是否开启路由延迟解析
    'url_lazy_route'         => false,
    // 是否强制使用路由
    'url_route_must'         => true,
    // 合并路由规则
    'route_rule_merge'       => false,
    // 路由是否完全匹配
    'route_complete_match'   => false,
    // 使用注解路由
    'route_annotation'       => false,
    // 域名根，如thinkphp.cn
    'url_domain_root'        => '',
    // 是否自动转换URL中的控制器和操作名
    'url_convert'            => true,
    // 默认的访问控制器层
    'url_controller_layer'   => 'controller',
    // 表单请求类型伪装变量
    'var_method'             => '_method',
    // 表单ajax伪装变量
    'var_ajax'               => '_ajax',
    // 表单pjax伪装变量
    'var_pjax'               => '_pjax',
    // 是否开启请求缓存 true自动缓存 支持设置请求缓存规则
    'request_cache'          => false,
    // 请求缓存有效期
    'request_cache_expire'   => null,
    // 全局请求缓存排除规则
    'request_cache_except'   => [],
    // 是否开启路由缓存
    'route_check_cache'      => false,
    // 路由缓存的Key自定义设置（闭包），默认为当前URL和请求类型的md5
    'route_check_cache_key'  => '',
    // 路由缓存类型及参数
    'route_cache_option'     => [],

    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => Env::get('think_path') . 'tpl/dispatch_jump.tpl',
    'dispatch_error_tmpl'    => Env::get('think_path') . 'tpl/dispatch_jump.tpl',

    // 异常页面的模板文件
    'exception_tmpl'         => Env::get('think_path') . 'tpl/think_exception.tpl',

    // 错误显示信息,非调试模式有效
    'error_message'          => '页面错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'         => false,
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => '',

    /*
     * 自定义配置项
     * */

    /*
     * Admin权限及用户验证配置项
     * */

    //加密、解密密钥
    'crypt_key'         => '84e7871c139909e1982c05be74c3d06d',
    //默认系统超级管理员帐户名称
    'default_admin'         => 'admin',
    //默认管理员用户表
    'admin_table'           => 'adminer',
    //默认管理员帐户字段名
    'admin_name'            => 'account',
    //kit_admin主框架路由
    'admin_main'            =>  'admin/home/home',

    /*
     * 前台用户验证配置项
     * */

    //加密、解密密钥
    'crypt_user_key'         => '84e7871c139909e1982c05be74c3d06d',
    //默认用户表
    'user_table'           => 'user',
    //默认帐户字段名
    'user_name'            => 'phone',
    //默认帐户密码字段名
    'user_pwd'            => 'password',


    /*
     * 短信验证码配置项
     * */
    //帐户
    'sms_account'       => '8E00048',
    //密码
    'sms_password'      =>'8E0004888',

    /*支付配置项*/
    //支付宝配置参数
    'alipay_config'=>[
        'app_id' =>'2019010962841618',   //应用APPID。
        'partner' =>'2088521367543235',   //这里是你在成功申请支付宝接口后获取到的PID；
        'seller_id' => 'xiaojikeji@aliyun.com', //收款支付宝用户ID
        // 'key'=>'9t***********ie',//这里是你在成功申请支付宝接口后获取到的Key
        'sign_type'=>'RSA',     //签名方式
        'input_charset'=> 'utf-8',      //编码格式
        'transport'=> 'http',
        'gateway_url' => "https://openapi.alipay.com/gateway.do",       //支付宝网关
        //密钥
        'private_key'=> 'MIIEogIBAAKCAQEAyk/5XFglqUM09O8hEXy77P+NpPskjQFS9LqBRmj07HthDx0NAbtyaSHRQZjiqzSdrMxwlFOG0GmeKG5zufVdZYUeovbjDcVsFWeY1FeprTJbhzgj1cA7L/9vOIzuFsPl4HRSzrrcBpkEjJnjtTqhnk1BrmC9yicwlwKJdQy+pLqk3WHkNb4zY7a9SnTDTVi5Fv3qNLr9qJTONr7cu+JzUwTV5rKyavWjzNCmgJN47OMPy/ilAu9pw7Psmnr31/JIvbXY1YymN46sLBKT0CZvTkpd7SwAxgj5LXXtSHoCCYuRamuQV9GWYSHJ0D4CxZ9DrAtcxvIk9UVLuzYKMNs9sQIDAQABAoIBACW6sGhWT/+29uNOzT3zoyBZsFK6O2DIhG37cixtWm/XuowVAN331ShiFCJFntAK6fTV05D12sh3SfWEU7S0W4yZPNNrc4CX9sYvIcNH7e7M22DmSViNlvwmiNlk/unj8rTfPKotEudwFfcao+qiWo2pHrykcgCHOnqPEI9xpwQVLaD+3KLRSuI3hQFUIkZzDCDprL/ZCKvxTadSpIRZ9lVmRK/LEYwMBfkNmOW0rooynEg+jmy2F12FcQtIdxTt8jv3OewqbI5FgWPjTPkCwrM26COVQR6PW4tTMJuJBslA7xfmfKl3Gg7tfqwOTu2PKqpe+0vUmZuwo0P86InvaLkCgYEA86ecxG08ZggubElo+FkE1EHhgCWe5JlHPdJzlFYFG/UdzTCPWhlOtEz/9gB8NWYsPVY+KzN6pfFHzuTbDLZ0ebECH9Re7lI1h9rHaWqQPQIx8cZUcsC367XO+wLhEqugds5IOxTiFRAi+vx5NuclFQj5iRHKiFHtB8cS8rnyh4cCgYEA1JAevPettf4FlrxnVZqGskUiKRhUmU/GWJ7vq0iHyL0xg/9T9AHGD4YbonsyyA2Uy8f8cPHWn0zwRb4jk4xLLeTqj6uWLlnZAJi/D9S7G+14aOpyad9E3CWHcfwAW9xE/wcYo47ZJRy5UWm4au87YcEnvkizCgLaRvTt64tabwcCgYBt1PJfwPXm8G0stvKwcEAzBfeGcm7rkQSCI6miBhyLe7SRWABmlt3ZfJQs6g8TaxkqFQQ1KSFySA8cfiEX2+8pI9dXTb31I+2pbb9SD40xUxn8aHCMwb6ma+//Sk72wZK1u0roBwPahsmd5c0mKI+YqdECLpjjVjrItL4f2B4xZQKBgHhgLagiM3PPKWcVxwdJfWJTmGbhandwIAlr6Jp9drgNvI7d97NFld6QufGoBzgXyN4moSVtL3gDYEZ+yTLzzldtPhCiwWf6ZdParMjQVi4Yq4nuy2B9mkd50VyRs7pR4ZjzcdaePQaxX5llX5TfaieP9WvjS9EtkGOCrYIo5svdAoGAOwoPKDeprC/7qn6B4T1tVSipW46pFJP+H7MkpVzvdKX+ZGCpqHV46X02QmqbrW6rGhOUUi1JDswUHLu7sjMpzdYibUwwqtlBQz4G7UfknE8CMQusW8ly3922RXdkWhxIZD+fTO0H5VHQNwTJWlbos+uo7upZWIf8ZaXInPz7ou0=',
        //公钥
        'public_key'=> 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyk/5XFglqUM09O8hEXy77P+NpPskjQFS9LqBRmj07HthDx0NAbtyaSHRQZjiqzSdrMxwlFOG0GmeKG5zufVdZYUeovbjDcVsFWeY1FeprTJbhzgj1cA7L/9vOIzuFsPl4HRSzrrcBpkEjJnjtTqhnk1BrmC9yicwlwKJdQy+pLqk3WHkNb4zY7a9SnTDTVi5Fv3qNLr9qJTONr7cu+JzUwTV5rKyavWjzNCmgJN47OMPy/ilAu9pw7Psmnr31/JIvbXY1YymN46sLBKT0CZvTkpd7SwAxgj5LXXtSHoCCYuRamuQV9GWYSHJ0D4CxZ9DrAtcxvIk9UVLuzYKMNs9sQIDAQAB',
    ],

    //以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；
    'alipay_url'   =>[
        //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
        'notify_url'=>'http://aoogi.min-ji.com/api/callback/alicomplete',
        //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
        'return_url'=>'http://aoogi.min-ji.com/Pay/returnurl',
        //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
        'successpage'=>'http://aoogi.min-ji.com/pay/success',
        //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
        'errorpage'=>'http://aoogi.min-ji.com/pay/error',
    ],
    'alipay_key' =>[
        'cacert'=> getcwd().'/../pay/alipay/key/cacert.pem',
        'rsa_key'=> getcwd().'/../pay/alipay/key/rsa_private_key.pem',      //密钥路径
        'public_key'=> getcwd().'/../pay/alipay/key/alipay_public_key.pem',     //公钥路径
    ],

];
