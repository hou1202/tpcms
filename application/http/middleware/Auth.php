<?php

namespace app\http\middleware;

use app\admin\model\Admin;

class Auth
{
    public function handle($request, \Closure $next)
    {

        //var_dump($request->cookie('admif_account'));die;
        if(empty($request->cookie('admin_account'))){
            return redirect('/login');
        }

        return $next($request);
    }
}
