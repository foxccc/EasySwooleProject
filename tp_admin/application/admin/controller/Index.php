<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/5/22 0022
 * Time: 上午 10:30
 */
namespace app\admin\controller;

use app\base\controller\Base;
use think\Controller;
use think\Db;
use app\common\controller\Common;

class Index extends Common
{
    public function Index(){
        $admin_id = session('admin_ID');
        $admin_user = Db::name('auth_user')->where(['id'=>$admin_id])->value('username');
        $menus = model('menu')->getList();
        $this->assign('admin_user',$admin_user);
        $this->assign('admin_id',$admin_id);
        $this->assign('menus', $menus);
        return $this->fetch();
    }

    public function Welcome(){
        return $this->fetch();
    }

    public function lang() {
        $this->getLang();
    }
}