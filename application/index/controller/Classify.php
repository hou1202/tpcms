<?php

namespace app\index\controller;

use app\common\controller\BaseController;
use app\common\model\Classify as ClassifyM;

class Classify extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $resource = ClassifyM::where('p_id',0)->all();
        $this->assign('Classify',$resource);
        return view('goods/category');
    }


}
