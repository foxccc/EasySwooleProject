<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/16 0016
 * Time: 下午 8:02
 */
namespace app\admin\controller;

use think\Controller;

class Menus extends Controller
{
    public function Index(){
        return $this->fetch();
    }

    public function add(){
        return $this->fetch();
    }
}