<?php
/**
 * Created by PhpStorm.
 * User: Hou-ShiShu
 * Date: 2019/1/9
 * Time: 11:48
 */

namespace app\index\controller;
use app\api\controller\WxPay;
use think\Db;
use think\facade\Config;
use app\common\controller\Alipay;

use app\common\controller\BaseController;
use think\facade\Env;
use think\facade\Request;

class Test extends BaseController
{
    //压缩临界点，单位：字节(1048576 b = 1Mb)
    const CRITICAL_POINT = 1048576;
    private $src;
    private $image;
    private $imageinfo;
    private $percent;


    /*public function indexs(Request $request)
    {
        $pay = new WxPay();
        $resource = $pay -> getClientIp();
        var_dump($resource);die;
        $type = 0;
        $type       =  $type ? 1 : 0;
        $ip         =   'unknown';
        if ($ip !== 'unknown') return $ip[$type];
        //var_dump($_SERVER);die;
        if(isset($_SERVER['HTTP_X_REAL_IP'])){//nginx 代理模式下，获取客户端真实IP
            $ip=$_SERVER['HTTP_X_REAL_IP'];
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {//客户端的ip
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {//浏览当前页面的用户计算机的网关
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];//浏览当前页面的用户计算机的ip地址
        }else{
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        //return $ip[$type];
        var_dump($ip[$type]);


    }*/

    public function index(){
        return view('/test');
    }

    public function uploader($genre=0, $percent=1){
        /**@param   $percent    float   压缩百分比，1为不压缩*/
        $this->percent = $percent;

        header('content-type:text/plain;charset=utf-8');
        //定义站点根目录
        define('ROOT_PATH', str_replace("\\", '/',Env::get('root_path')));
        //定义附件上传路径
        define('ATTACHMENTS_PATH', ROOT_PATH . "public/uploads/");
        //定义日期目录
        define('DATE_PATH',date('Y').date('m').date('d').'/');
        //完整上传路径
        define('UPLOAD_PATH',ATTACHMENTS_PATH.DATE_PATH);
        //var_dump(uniqid());die;

        //判断附件文件夹是否存在，不存在则创建
        if (!is_dir(ATTACHMENTS_PATH)) {
            mkdir(ATTACHMENTS_PATH);
        }
        //判断当天附件文件夹是否存在，不存在则创建
        if (!is_dir(UPLOAD_PATH)) {
            mkdir(UPLOAD_PATH);
        }
        //判断上传文件是否成功
        if ($_FILES['file']['error'] > 0) {
            $return = array();
            if($genre){
                $return['code'] = 1;
                $return['msg'] = '上传失败!';
                $return['data']['src'] = '';
            }else{
                $return['error'] = 1;
                $return['message'] = '上传失败!';
            }

            exit(json_encode($return));
        }


        //判断被上传的图片大小是否合法
        /**
         * getimagesize()根据图片的绝对路径（必须是绝对路径），获取这个图片的信息。返回的是一个数组：
         * 0=>图片的宽
         * 1=>图片的高
         * 2=>返回的是数字，其中1 = GIF，2 = JPG，3 = PNG，4 = SWF，5 = PSD，6 = BMP，7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)，9 = JPC，10 = JP2，11 = JPX，12 = JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM
         * 3=>height="yyy" width="xxx"
         * 'bits'=>给出的是图像的每种颜色的位数，二进制格式
         * 'channels'=>给出的是图像的通道值，RGB 图像默认是 3
         * 'mime'=>类似于'image/jpeg'的MIME信息
         */
        $source_info = getimagesize($_FILES['file']['tmp_name']);
        if (isset($_REQUEST['minWidth'])) {
            if ($source_info[0] < $_REQUEST['minWidth']) {
                $return = array();
                if($genre){
                    $return['code'] = 1;
                    $return['msg'] = '图片尺寸太小!';
                    $return['data']['src'] = '';
                }else{
                    $return['error'] = 1;
                    $return['message'] = '图片尺寸太小';
                }
                exit(json_encode($return));
            }
        }
        if (isset($_REQUEST['minHeight'])) {
            if ($source_info[1] < $_REQUEST['minHeight']) {
                $return = array();
                if($genre){
                    $return['code'] = 1;
                    $return['msg'] = '图片尺寸太小!';
                    $return['data']['src'] = '';
                }else{
                    $return['error'] = 1;
                    $return['message'] = '图片尺寸太小';
                }
                exit(json_encode($return));
            }
        }

        //获取后缀名(这里不用$_FILES["file"]["type"]去获取文件的MIME类型来判断文件格式，因为flash上传文件的MIME类型统一都是"application/octet-stream")
        //pathinfo  以数组的形式返回文件路径的信息
        $pathinfo = pathinfo($_FILES['file']['name']);
        $suffix = '.' . $pathinfo['extension']; //$_FILES['file']['name']是上传文件的原始文件名称

        var_dump($_FILES);die;
        //CRITICAL_POINT

        //is_uploaded_file  判断文件是否是通过 HTTP POST 上传
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            //新文件名
            $src = uniqid() . $suffix;

            //move_uploaded_file    将上传的文件移动到新位置
            if (!move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_PATH . $src)) {
                $return = array();
                if($genre){
                    $return['code'] = 1;
                    $return['msg'] = '上传失败!';
                    $return['data']['src'] = '';
                }else{
                    $return['error'] = 1;
                    $return['message'] = '上传失败!';
                }
                exit(json_encode($return));
            } else {

                //压缩图片
                if($percent != 1){}
                $this->compressImg(UPLOAD_PATH . $src, UPLOAD_PATH . $src);

                var_dump(UPLOAD_PATH . $src);die;


                $return = array();
                if($genre){
                    $return['code'] = 0;
                    $return['msg'] = '上传成功!';
                    $return['data']['src'] = "/uploads/".DATE_PATH. $src;;
                }else{
                    $return['error'] = 0;
                    $return['message'] = '上传成功';
                    $return['url'] = "/uploads/".DATE_PATH. $src;
                    $return['source_path'] = UPLOAD_PATH . $src;
                    if (isset($_REQUEST['uid'])) {
                        $return['uid'] = $_REQUEST['uid'];
                    }
                }
                exit(json_encode($return));
            }
        }


    }

    /** 高清压缩图片
     * @param string $saveName  提供图片名（可不带扩展名，用源图扩展名）用于保存。或不提供文件名直接显示
     */
    private function compressImg($imageName, $saveName)
    {
        $this->_openImage($imageName);
        /*if(!empty($saveName)) $this->_saveImage($saveName);  //保存
        else $this->_showImage();*/
        $this->_saveImage($saveName);
    }

    /**
     * 内部：打开图片
     */
    private function _openImage($imageName)
    {
        list($width, $height, $type, $attr) = getimagesize($imageName);
        var_dump($imageName);
        var_dump(getimagesize($imageName));die;
        $this->imageinfo = array(
            'width' => $width,
            'height' => $height,
            'type' => image_type_to_extension($type, false),        //image_type_to_extension 根据指定的图像类型返回对应的后缀名
            'attr' => $attr
        );
        //imagecreatefrompng($filename )  创建一块画布，并从 PNG 文件或 URL 地址载入一副图像
        $fun = "imagecreatefrom" . $this->imageinfo['type'];
        //var_dump($fun);die;
        $this->image = $fun($imageName);
        var_dump($imageName);
        var_dump($this->image);die;
        $this->_thumpImage();
    }

    /**
     * 内部：操作图片
     */
    private function _thumpImage()
    {
        $new_width = $this->imageinfo['width'] * $this->percent;
        $new_height = $this->imageinfo['height'] * $this->percent;
        //imagecreatetruecolor  建立的是一幅大小为 x和 y的黑色图像
        $image_thump = imagecreatetruecolor($new_width, $new_height);
        //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度
        imagecopyresampled($image_thump, $this->image, 0, 0, 0, 0, $new_width, $new_height, $this->imageinfo['width'], $this->imageinfo['height']);
        //imagedestroy  销毁一图像
        imagedestroy($this->image);
        $this->image = $image_thump;
        var_dump($this->image);die;
    }

    /**
     * 保存图片到硬盘：
     * @param  string $dstImgName  1、可指定字符串不带后缀的名称，使用源图扩展名 。2、直接指定目标图片名带扩展名。
     */
    private function _saveImage($dstImgName)
    {
        if (empty($dstImgName)) return false;
        $allowImgs = ['.jpg', '.jpeg', '.png', '.bmp', '.wbmp', '.gif'];   //如果目标图片名有后缀就用目标图片扩展名 后缀，如果没有，则用源图的扩展名
        $dstExt = strrchr($dstImgName, ".");
        $sourseExt = strrchr($this->src, ".");
        if (!empty($dstExt)) $dstExt = strtolower($dstExt);
        if (!empty($sourseExt)) $sourseExt = strtolower($sourseExt);

        //有指定目标名扩展名
        if (!empty($dstExt) && in_array($dstExt, $allowImgs)) {
            $dstName = $dstImgName;
        } elseif (!empty($sourseExt) && in_array($sourseExt, $allowImgs)) {
            $dstName = $dstImgName . $sourseExt;
        } else {
            $dstName = $dstImgName . $this->imageinfo['type'];
        }
        $funcs = "image" . $this->imageinfo['type'];
        $funcs($this->image, $dstName);
    }

}