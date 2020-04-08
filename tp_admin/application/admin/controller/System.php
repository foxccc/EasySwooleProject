<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/17 0017
 * Time: 下午 3:03
 */

namespace app\admin\controller;


use think\Controller;

class System extends Controller
{
    public function Index(){
        return $this->fetch();
    }
}