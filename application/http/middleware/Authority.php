<?php

namespace app\http\middleware;

use app\admin\model\Admin;
use app\admin\common\Auth;
use app\admin\common\User;

class Authority
{
    public function handle($request, \Closure $next)
    {

        //var_dump($request->cookie('admif_account'));die;
        /*if(empty($request->cookie('admin_account'))){
            return redirect('/login');
        }*/
        //var_dump($request->baseUrl());
        //var_dump($request->method());
        //var_dump($request);
        /*var_dump($request->module());
        var_dump($request->controller());
        var_dump($request->action());
        die;*/
        if(!$admin = User::user()) return redirect($request->domain().'/login');
        $baseUrl = strtolower($request->module()).'/'.strtolower($request->controller()).'/'.strtolower($request->action());
        //var_dump($baseUrl);die;
        $auth = new Auth();
        if(!$auth->check($baseUrl)) return redirect('/error/403');
        return $next($request);
    }
}
