<?php

namespace app\http\middleware;
use app\index\common\Users;


class UserVerify
{
    public function handle($request, \Closure $next)
    {
        if(!Users::check()){
            if($request->isAjax())
                return json(['msg'=>'尚未登录，请先登录','code'=>2,'url'=>'/login']);
            return redirect('/login');

        }

        return $next($request);
    }
}
