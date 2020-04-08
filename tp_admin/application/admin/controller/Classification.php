<?php
namespace app\admin\controller;

class Classification extends Base
{
    public function index() {
        return $this->fetch();
    }
}