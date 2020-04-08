<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/5/25 0025
 * Time: 下午 4:05
 */
namespace app\api\controller;
use think\Controller;

class AdminUser extends Controller
{
    public function adminUserInfo($id=1){
        return model('base/AdminUser')->find($id);
    }
}