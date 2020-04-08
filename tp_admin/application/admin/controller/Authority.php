<?php
namespace app\admin\controller;

use think\Controller;

class Authority extends Controller
{
    public function index() {
        return $this->fetch();
    }
}