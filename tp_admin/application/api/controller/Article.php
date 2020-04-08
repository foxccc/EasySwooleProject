<?php
namespace app\api\controller;

use think\Db;

class Article extends Base
{
    public function getList() {
        $username = input('get.uploader');
        $data = Db::table('user')->alias('u')
            ->where(['username'=>$username])
            ->join('ta_article a','a.author=u.id')
            ->select();
        if (!$data) {
            return self::showReturnCode(1030);
        }
        return self::showReturnCode(200,$data);
    }

    public function getListById() {
        $id = input('get.id');
        $data = Db::table('ta_article')->alias('a')
            ->where(['a.id'=>$id])
            ->join('user u','u.id=a.author')
            ->find();
        if (!$data) {
            return self::showReturnCode(1030);
        }
        return self::showReturnCode(200,$data);
    }

    public function add() {
        $data = input('get.');
        $user_id = Db::table('user')->where(['username'=>$data['author']])->value('id');
        $data['author'] = $user_id;
        $res = Db::table('ta_article')->insert($data);
        if (!$res) {
            return self::showReturnCode(1030);
        }
        return self::showReturnCode(200,$data);
    }

    public function upImage() {
        $this->uploadFile('img','article',$width="",$height="");
    }

    public function uploadFile($name,$filePath,$width="",$height="")
    {
        $file = request()->file($name);
        if($file==null){
            exit(json_encode(array('code'=>1,'msg'=>'没有文件上传')));
        }
        //获取文件格式
        $fileName = $file->getInfo();
        $ext = substr($fileName['name'],strpos($fileName['name'],"."));
        $ext = substr($ext,1);
        if(!in_array($ext,array('jpg','jpeg','gif','png'))){
            exit(json_encode(array('code'=>400,'msg'=>'文件格式不支持')));
        }
        if($file){
            $filePaths = ROOT_PATH . 'public' . DS . 'uploads' . DS .$filePath;
            if(!file_exists($filePaths)){
                mkdir($filePaths,0777,true);
            }
            $info = $file->move($filePaths);
            if($info){
                $imgPath = 'uploads/'.$filePath.'/'.$info->getSaveName();
                //改类型
//                $image = \think\Image::open($imgPath);
//                $date_path = 'uploads/'.$filePath.'/change/'.date('Ymd');
//                if(!file_exists($date_path)){
//                    mkdir($date_path,0777,true);
//                }
//                $change_path = $date_path.'/'.$info->getFilename();
//                $image->thumb($width, $height)->save($change_path);
                unset($info);
                //水印
                //$image->text('这是一张图片',$font,100,'#00ffff',\think\Image::WATER_SOUTHWEST,0,50))->save($change_path);
                exit(json_encode(array('code'=>1,'result'=>$imgPath)));
            }else{
                // 上传失败获取错误信息
                exit(json_encode(array('code'=>0,'msg'=>$file->getError())));
            }
        }
    }
}