<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/17 0017
 * Time: 下午 2:13
 */

namespace app\admin\controller;


use think\Controller;

class Email extends Controller
{
    public function Index(){
        return $this->fetch();
    }
    public function Write(){
        return $this->fetch();
    }
}