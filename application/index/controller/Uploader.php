<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2018/12/6
 * Time: 17:24
 */

namespace app\index\controller;


class Uploader
{
    /*图像上传*/
    public function uploader(){
        // 获取表单上传文件
        $files = request()->file('');
        foreach($files as $file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
                $path['name'] = DS . 'uploads/' . $info->getSavename();
            }else{
                // 上传失败获取错误信息
                return $this->error($file->getError()) ;
            }
        }
        echo json_encode($path);
    }
}