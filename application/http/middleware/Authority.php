<?php

namespace app\http\middleware;

use app\admin\common\Auth;
use app\admin\common\User;
use think\facade\Config;

class Authority
{
    public function handle($request, \Closure $next)
    {

        //判断用户登录情况
        if(!User::check()) return redirect($request->domain().'/login');
        //判断用户请求权限
        $baseUrl = $request->module().'/'.$request->controller().'/'.$request->action();
        //var_dump(Config::get('admin_main'));die;
        $refresh = strtolower($baseUrl) == Config::get('admin_main') ? true : false;
        //var_dump($refresh);die;
        if(!Auth::check($baseUrl,$refresh)){
            if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($request->server('HTTP_X_REQUESTED_WITH')) =='xmlhttprequest'){
                return json(['code' => 0, 'data' => '你暂无权限进行该操作',]);
            }else{
                return redirect('/error/403');
            }
        }
        return $next($request);
    }
}
