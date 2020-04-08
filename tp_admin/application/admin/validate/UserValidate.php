<?php
/**
 * Created by PhpStorm.
 * UserValidate: CYKn
 * Date: 2019/4/21 0021
 * Time: 下午 5:02
 */
namespace app\admin\validate;

class UserValidate extends BaseValidate
{
    protected $rule =   [
        'username'          =>'unique:auth_user,username',
        'mail'              => 'unique:auth_user',
        'password'              => 'require|length:6,16',
    ];

    protected $message  =   [
        'username.unique'   =>'用户名已存在',
        'mail.unique' => '邮箱已存在',
        'password.require'      => '密码必须',
        'password.length'       => '密码长度在6到16位之间',
    ];

//    protected $scene = [
//        'add' => ['mobile','password'],
//        'edit' => ['mobile', 'password','username']
//    ];
}