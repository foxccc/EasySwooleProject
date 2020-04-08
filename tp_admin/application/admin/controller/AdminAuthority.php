<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\AdminAccess;
use think\Db;

class AdminAuthority extends Base
{
    public function Index(){
        $ruleList = Db::name('auth_rule')->select();
        $this->assign('ruleList', $ruleList);
        return $this->fetch();
    }
}