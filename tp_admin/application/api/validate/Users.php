<?php
/**
 * Created by PhpStorm.
 * UserValidate: CYKn
 * Date: 2019/4/21 0021
 * Time: 下午 5:02
 */
namespace app\api\validate;

class Users extends BaseValidate
{
    protected $rule =   [
        'username'          =>'unique:users,username',
        'mobile'              => 'require|length:11',
        'password'              => 'length:4,16',
    ];

    protected $message  =   [
        'username.unique'   =>'用户名已存在',
        'mobile.require'      => '电话必须',
        'mobile.length'       => '电话长度必须是11位',
        'password.length'       => '密码长度在4到16位之间',
    ];

//    protected $scene = [
//        'add' => ['mobile','password'],
//        'edit' => ['mobile', 'password','username']
//    ];
}