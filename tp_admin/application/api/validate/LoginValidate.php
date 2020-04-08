<?php
/**
 * Created by PhpStorm.
 * UserValidate: CYKn
 * Date: 2019/4/20 0020
 * Time: 下午 12:08
 */
namespace app\api\validate;

class LoginValidate extends BaseValidate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require|IsCharacter'
    ];
    protected $message = [
        'username.require'    => '用户名必填',
        'password.require'     => '密码必填',
    ];
    protected function IsCharacter($value,$rule='',$date='',$field=''){
        if (preg_match("/^[a-z0-9A-Z_]+$/",$value)) {
            return true;
        } else {
            exit(json_encode(['code'=>400,'msg'=>"密码必须由字母、数字、下划线组成"],JSON_UNESCAPED_UNICODE));
        }
    }
}