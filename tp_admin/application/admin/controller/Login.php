<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/17 0017
 * Time: 下午 2:13
 */

namespace app\admin\controller;

use think\Controller;
use app\admin\validate\LoginValidate;
use think\Db;

class Login extends Controller
{
    public function Index(){
        return $this->fetch();
    }

    public function LoginIn(Db $db){
        $username = input('post.username');
        $password = trim(input('post.password'));
        $code = trim(input('post.code'));
        //验证密码格式
        $v = new LoginValidate();
        $v->toCheck(['username'=>$username,'password'=>$password]);
        $admin_user = $db::table('ta_auth_user')->where('username',$username)->find();
        if (!$admin_user) {
            exit(json_encode(array('code'=>400,'msg'=>'用户不存在')));
        }
        if (md5($password)!=$admin_user['password']) {
            exit(json_encode(array('code'=>400,'msg'=>'密码错误')));
        }
        if (!captcha_check($code)) {
            exit(json_encode(array('code'=>400,'msg'=>'验证码错误')));
        }
        //保存用户
        session('admin_ID',$admin_user['id']);
        exit(json_encode(array('code'=>0,'msg'=>'登录成功')));
    }
}