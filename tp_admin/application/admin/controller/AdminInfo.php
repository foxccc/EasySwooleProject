<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/17 0017
 * Time: 下午 2:13
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class AdminInfo extends Controller
{
    public function Index(){
        $id = session('admin_ID');
        $admin_info = Db::name('auth_user')->where(['id'=>$id])->find();
        $this->assign('admin_info',$admin_info);
        return $this->fetch();
    }

    public function save(){
        $data = request()->put();
        Db::name('auth_user')->where(['id'=>$data['id']])->update($data);
        exit(json_encode(['code'=>0,'msg'=>'修改成功']));
    }

    public function changePassword() {
        $data = request()->put();
        $password = Db::name('auth_user')->where(['id'=>$data['id']])->value('password');
        if ($password != md5($data['oldPassword'])) {
            exit(json_encode(['code'=>400,'msg'=>'原密码错误']));
        }
        unset($data['oldPassword']);
        Db::name('auth_user')->where(['id'=>$data['id']])->update($data);
        exit(json_encode(['code'=>0,'msg'=>'修改成功']));
    }
}