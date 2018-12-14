<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/12/14
 * Time: 17:20
 */

namespace app\index\controller;
use think\Request;


class SelfFunction
{

    /*
     * 重置TOKEN
     * @return json     新Token
     * */
    public function resetToken(Request $request)
    {
        return json($request->token());
    }

}