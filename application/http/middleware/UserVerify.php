<?php

namespace app\http\middleware;
use app\index\common\Users;

class UserVerify
{
    public function handle($request, \Closure $next)
    {
        if(!Users::check())
            return redirect('/login');

        return $next($request);
    }
}
