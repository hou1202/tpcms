<?php

namespace app\http\middleware;

class Users
{
    public function handle($request, \Closure $next)
    {
        if(1<2){
            return env('app_path');
        }

        return $next($request);
    }
}
