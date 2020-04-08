<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/16 0016
 * Time: 下午 2:16
 */

namespace app\api\controller;

use think\Db;
use app\api\validate\LoginValidate;
use app\api\validate\RegisterValidate;

class User extends Base
{
   public function Login(){
       $param = [
           'username'=>'username',
           'password'=>'password'
       ];
       $data = $this->buildParam($param);
       //验证格式
       (new LoginValidate())->toCheck($data);
       //数据库验证
       $user = Db::table('user')->where('username',$data['username'])->find();
       if (!$user) {
           return self::showReturnCode(1021);
       }
       if ($data['password']!=$user['password']) {
           return self::showReturnCode(1021);
       }
       return self::showReturnCode(200);
   }

   public function register(){
       $param = [
           'username'=>'username',
           'password'=>'password'
       ];
       $data = $this->buildParam($param);
       (new RegisterValidate())->toCheck($data);
       $res = Db::table('user')->insert($data);
       if ($res) {
           return self::showReturnCode(200);
       }
   }
}