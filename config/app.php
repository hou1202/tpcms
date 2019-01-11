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

    /**
     * 支付配置项
     */
    //支付宝配置参数
    'alipay_config'=>[
        'app_id' =>'2017090508565516',   //应用APPID。
        'partner' =>'2088521367543235',   //这里是你在成功申请支付宝接口后获取到的PID；
        'seller_id' => 'xiaojikeji@aliyun.com', //收款支付宝用户ID
        // 'key'=>'9t***********ie',//这里是你在成功申请支付宝接口后获取到的Key
        'sign_type'=>'RSA',     //签名方式
        'input_charset'=> 'utf-8',      //编码格式
        'transport'=> 'http',
        'gateway_url' => "https://openapi.alipay.com/gateway.do",       //支付宝网关- 正式地址
        //'gateway_url' => "https://openapi.alipaydev.com/gateway.do",       //支付宝网关- 测试地址
        //应用密钥
        //'private_key'=> 'MIIEowIBAAKCAQEApkzGcTl2mRws8vUszmtnr8S4yweCWvAH4IcKsntBuSB4HSYshFM5fdpjKRIFGwit2aLviNomGTW/0R2RGXOaP/tqJP8dGGkSmLpz/ief9pUxpWEErZliI/K78uC5I5c8kQ7kOdUZ5pp+tR7aNNOy5eG5xB24O2Q9WKObpoesAZIZiwaNOPj0SDguImwOUv1b1ZBtUT9zMBuuTuSnJCDZ+n7rb1BEZIsADupy5JQSFBzc65xtpcVf9eHxfUkYbP0orzV39DCBVsTC/mjGpV7opKYg2OXIrdYilSO9InExzX7yzDQvEwCkV3pbblhOuo9J5fyXMkLAKNVUiJf5XOyh/QIDAQABAoIBAEeMGIR2GJRfDueonBJjG0T/+hE/tdGyG3F6KBwJ84jWc1b3KYf01nNTFf6BhjjPTxyngS77zBBkk5ZAhkDQ/7gvTseECtyJuDqFXYonOic4oRdp2j1mFFcrA7nG/WBWnPQ71+0Zxf700TbTg0XfHsTQjL/XmX/T7KDKIxlOna4+n7uuiWz+7o7eEEzOLT3o1pDaDbuSktxH6aixP4KNByOqEbSnqSi/v2rKRtsUvDDj+bG6YYA11x2DFxjYZceyRFmPcQ8RR+D5a2YNJMK578cZrexggEKa9W3bKARq5o6g752Anfbn3CGB1SgkvEtavjumDhnRsBDj5ht8TroiA/ECgYEAzoHuo2l06cPX2vHcfo0V7FK+w8ERoaR6pd+K7byrcrZ8lloqrivH3YLLv/L7ypt5FpByLpX9nz0yOQxkHVCp2kLOZLqfGGlBV60AKqRuZ1PB7FkbvDp6ytuIC6KQTM+sRuz9wf1gs8YC6HkW9hBPLQEBl+JPhNjJCha40IhW+scCgYEAzifxQwKJyIMsEnJFvxf2SPaOam3bP1e+LZT8K1VCQN9BE3gP/3ccVBjoBtL7r50++JqJsejRYgxgpwJiwocPrut6eyRWZ2sWIykXc4LbouZlaZOGF+YNu4RvOV22vVG4ZMbqDk0HPA8tz1TAmQ38ec74OKiHm0/d4vJEduPnWRsCgYEAvmvxsZ28wRJmKO59c/SFErX6Umfl6jfRIMNRSIeBUPYVTE84rAKS+h9x4j4dEGbs8XGg2HRWuk+j0Bcs+hs3hJu11gyAR/JG3qIYVTnq1DzXxSkl+huyvvxQJupwRWP6aCyAkjEiyqL8a4G9OokveUBER9nXmZiNSVBKe4A9NGECgYBREP3bVuUtdv9epZbtpROQ73tjOJ3Nk8hSDlL3C0jJT8E8UasgzwrRuxWKkW6tSQ1ZHxPkZOPpRWrAYbzKN+gf5bM9NzXO5xpGa0MwhhWuQiFA2eUSAsIFqfc+vK4+ViNHZbzmML4WjPV7oR03UnukvpF3XjYtCcP8GT547fesXwKBgERj3E0+Xu5fmY3kTzRfs3t6Qv28sIMrsiTBdgTZ1Srtx4J5rTjl6Hrvx4IG9Jz2EXm3kAVAAJX/edPE8q2Ksj4bpozF1ucDZsvDTLHKDCVnlpvy+bTFZYGZBQU+Ap+9YPoMdijEOlualUcoENkq4T5REOxSsAuHa04+HPxoXdFC',
        'private_key'=> 'MIICXQIBAAKBgQDqEOILRHyJsRvZO837C8MLpIuzU35F4NUx5w/UkPWKsCOqqZbpqXHJzkXAEZg8ElXtTJATLrzCOXuEw5Rr2NZIkkh7VYOkZnbIy5mqwd2Vl9E9J1J6DuPbMk3znsq7vU1YpkCILIEjjJAVd9wqYsjvb34tp6NlUU5m7WOPeaSZ6wIDAQABAoGAZ05ORgTTJn5puSYhEkUtr6zPD7WxDKxfzCecIAhepvh4tXEmLzjfBN+qf0wEsbayAAsDp8PAAcUXFBCyKCtK32K90pxZ30IUE7Hk9XpM5dS0YMDloTLESlKiYhDEN8YYN0riIb7A2anXnr8oYqxdCXkAevKFPu1QRTLpTMyLEJkCQQD4q5yKCoEnmkSggaJxeaeIhLFLeC7PqG8WNPurtn9kaiNgsiBVVAScKbwmjiNnzF7cZ4rPqqGzV045AlGJaAiPAkEA8PcSO3Q4Y8hZGig5vdvKbmeEvZbsW4gX2pkHW1yXqeVhwx085iejg1d71h9pzpqgeDyLC3HDjNZ6W/EFPmDu5QJBANn8RgtUTgfTWhmByk7DIDOybmEEB7UNp+PFqmDKaD40NLMNMv7Z2fizNTZvH2ZcZ0O6mJqWr40xGWcsOyHCys0CQQCkT8YF9qUxHX/svztIhKSQDlTMtypq6+1gKXOD0Cq3NmwokTpisurj9/bAtuD+eiAsfRRPdH7k/aeoJDzwIUclAkAFplCoJWY0S05YTp06sBPwFB6q+HZqUMLkN7cSE6LlUpX9U3/+RW8oTyDsZtuVlITPiRsT4tFuKB7C/BBbANLM',
        //应用公钥
        //'public_key'=> 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApkzGcTl2mRws8vUszmtnr8S4yweCWvAH4IcKsntBuSB4HSYshFM5fdpjKRIFGwit2aLviNomGTW/0R2RGXOaP/tqJP8dGGkSmLpz/ief9pUxpWEErZliI/K78uC5I5c8kQ7kOdUZ5pp+tR7aNNOy5eG5xB24O2Q9WKObpoesAZIZiwaNOPj0SDguImwOUv1b1ZBtUT9zMBuuTuSnJCDZ+n7rb1BEZIsADupy5JQSFBzc65xtpcVf9eHxfUkYbP0orzV39DCBVsTC/mjGpV7opKYg2OXIrdYilSO9InExzX7yzDQvEwCkV3pbblhOuo9J5fyXMkLAKNVUiJf5XOyh/QIDAQAB',
        'public_key'=> 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDqEOILRHyJsRvZO837C8MLpIuzU35F4NUx5w/UkPWKsCOqqZbpqXHJzkXAEZg8ElXtTJATLrzCOXuEw5Rr2NZIkkh7VYOkZnbIy5mqwd2Vl9E9J1J6DuPbMk3znsq7vU1YpkCILIEjjJAVd9wqYsjvb34tp6NlUU5m7WOPeaSZ6wIDAQAB',
        //支付宝公钥
        'ali_public_key' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDDI6d306Q8fIfCOaTXyiUeJHkrIvYISRcc73s3vF1ZT7XN8RNPwJxo8pWaJMmvyTn9N4HQ632qJBVHf8sxHi/fEsraprwCtzvzQETrNRwVxLO5jVmRGi60j8Ue1efIlzPXV9je9mkjzOmdssymZkh2QhUrCmZYI/FCEa3/cNMW0QIDAQAB',

        //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
        'notify_url'=>'http://www.aoogi.com/api/callback/alicomplete',
        //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
        'return_url'=>'http://www.aoogi.com/Pay/returnurl',
        //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
        'successpage'=>'http://www.aoogi.com/pay/success',
        //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
        'errorpage'=>'http://www.aoogi.com/pay/error',

        'cacert_pem'=> getcwd().'/../pay/alipay/key/cacert.pem',
        'rsa_key_pem'=> getcwd().'/../pay/alipay/key/rsa_private_key.pem',      //密钥路径
        'public_key_pem'=> getcwd().'/../pay/alipay/key/alipay_public_key.pem',     //公钥路径
    ],


];
