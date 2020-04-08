<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/5/25 0025
 * Time: 下午 4:06
 */
namespace app\base\model;
use think\Model;

class AdminUser extends  Model
{
    protected $table = "ta_auth_user";
    protected $name = "adminUser";
}