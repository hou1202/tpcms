<?php

namespace app\http\middleware;

use app\admin\model\Admin;

class Auth
{
    public function handle($request, \Closure $next)
    {

        //var_dump($request->cookie('admif_account'));die;
        /*if(empty($request->cookie('admin_account'))){
            return redirect('/login');
        }*/
        //var_dump($request->baseUrl());
        //var_dump($request->method());
        if(!\app\admin\common\Auth::verifyRule($request->baseUrl())) return false;
        return $next($request);
    }
}
