<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/5/22 0022
 * Time: 上午 9:12
 */
namespace app\admin\controller;

use think\Controller;

class Sell extends Base
{
    public function index(){
        model('Sell')->SellSelect();
        return $this->fetch();
    }
}