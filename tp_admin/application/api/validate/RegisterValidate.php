<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/16 0016
 * Time: 下午 6:07
 */

namespace app\api\validate;


class RegisterValidate extends BaseValidate
{
    protected $rule =   [
        'username'          =>'require|unique:user,username|min:3',
        'password'              => 'require|IsCharacter|length:4,16',
    ];

    protected $message  =   [
        'username.require'    => '用户名必填',
        'password.require'     => '密码必填',
        'username.unique'   =>'用户名已存在',
        'password.length'       => '密码长度在4到16位之间',
    ];

    protected function IsCharacter($value,$rule='',$date='',$field=''){
        if (preg_match("/^[a-z0-9A-Z_]+$/",$value)) {
            return true;
        } else {
            exit(json_encode(['code'=>400,'msg'=>"密码必须由字母、数字、下划线组成"],JSON_UNESCAPED_UNICODE));
        }
    }
}