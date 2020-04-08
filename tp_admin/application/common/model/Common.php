<?php
namespace app\common\model;


use think\Config;
use think\Controller;
use think\Lang;
use think\Model;
use think\Db;

class Common extends Model
{
    //修改处理
    public static function edit(array $data = [],$database,$check='id')
    {
        $data['update_time'] = date('Y-m-d h:i:s',time());
        $result = Db::name($database)->allowField(true)->save($data,['id'=>$data['id']]);
        if($result){
            exit(json_encode(['code'=>400,'msg'=>'修改失败']));
        }
        exit(json_encode(['code'=>0,'msg'=>'修改成功']));
    }
}