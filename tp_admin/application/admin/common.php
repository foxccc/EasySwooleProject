<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/5/14 0014
 * Time: 下午 4:53
 */
//$type=0加密,$type=1解密
function encryption($value,$type=0){
    $key = md5(config('AUTO_LOGIN_KEY'));
    //加密
    if($type){
        return str_replace('=','',base64_encode($value ^ $key));
    };
    $value = base64_decode($value);
    return $value ^ $key;
}

//保存图片
function upload_img($file_name= ''){
    $file = request()->file('file');
    if($file==null){
        exit(json_encode(array('code'=>1,'msg'=>'没有文件上传')));
    }
    $info = $file->move(ROOT_PATH.'public'.DS.'uploads/'.$file_name);
    $ext = ($info->getExtension());
    if(!in_array($ext,array('jpg','jpeg','gif','png'))){
        exit(json_encode(array('code'=>1,'msg'=>'文件格式不支持')));
    }
    $img = '/uploads/'.$file_name.'/'.$info->getSaveName();
    //关闭移动文件
    unset($info);
    exit(json_encode(array('code'=>0,'msg'=>$img)));
}
/*
   * $name为表单上传的name值
   * $filePath为为保存在入口文件夹public下面uploads/下面的文件夹名称，没有的话会自动创建
   * $width指定缩略宽度
   * $height指定缩略高度
   * 自动生成的缩略图保存在$filePath文件夹下面的thumb文件夹里，自动创建
   * @return array 一个是图片路径，一个是缩略图路径，如下：
   * array(2) {
     ["img"] => string(57) "uploads/img/20171211\3d4ca4098a8fb0f90e5f53fd7cd71535.jpg"
     ["thumb_img"] => string(63) "uploads/img/thumb/20171211/3d4ca4098a8fb0f90e5f53fd7cd71535.jpg"
    }
   */
function uploadFile($name,$filePath,$width="",$height="")
{
    $file = request()->file($name);
    if($file==null){
        exit(json_encode(array('code'=>1,'msg'=>'没有文件上传')));
    }
    //获取文件格式
    $fileName = $file->getInfo();
    $ext = substr($fileName['name'],strpos($fileName['name'],"."));
    if(!in_array($ext,array('jpg','jpeg','gif','png'))){
        exit(json_encode(array('code'=>1,'msg'=>'文件格式不支持')));
    }
    if($file){
        $filePaths = ROOT_PATH . 'public' . DS . 'uploads' . DS .$filePath;
        if(!file_exists($filePaths)){
            mkdir($filePaths,0777,true);
        }
        $info = $file->move($filePaths);
        if($info){
            $imgPath = 'uploads/'.$filePath.'/'.$info->getSaveName();
            $image = \think\Image::open($imgPath);
            $date_path = 'uploads/'.$filePath.'/change/'.date('Ymd');
            if(!file_exists($date_path)){
                mkdir($date_path,0777,true);
            }
            $change_path = $date_path.'/'.$info->getFilename();
            $image->thumb($width, $height)->save($change_path);
            unset($info);
            //水印
            //$image->text('这是一张图片',$font,100,'#00ffff',\think\Image::WATER_SOUTHWEST,0,50))->save($change_path);
            return $change_path;
        }else{
            // 上传失败获取错误信息
            exit(json_encode(array('code'=>0,'msg'=>$file->getError())));
        }
    }
}