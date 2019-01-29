<?php
namespace app\index\controller;
use app\common\controller\BaseController;

use app\common\model\Banner;
use app\common\model\Classify;
use app\common\model\Recom;
use app\common\model\Goods;


class Index extends BaseController
{

    public function index()
    {
        $banner = Banner::where('status',1)->all();
        $recom = Recom::where('status',1)->all();
        $classify = Classify::limit(3)->select();
        $this->assign('Banner',$banner);
        $this->assign('Recom',$recom);
        $this->assign('Classify',$classify);
        return view('/index');
    }

   public function getData($page, $limit)
   {
       $resource = Goods::where('status',1)
           ->order('recom desc')
           ->order('id desc')
           ->limit(($page-1)*$limit,$limit)
           ->select()
           ->toArray();
       return $this->successJson('获取数据成功','',$resource);



   }




}
