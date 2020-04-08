<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/16 0016
 * Time: 下午 8:02
 */
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Menu as ModelMenu;
use think\Db;

class Menu extends Base
{
    public function Index(ModelMenu $menu){
        $menuList = $menu->getList();
        $this->assign('menuList',$menuList);
        return $this->fetch();
    }

    public function add(ModelMenu $menu){
        $id = (int)input('get.id');
        $menuList = $menu->getList();
        $menu = Db::name('auth_rule')->where('id',$id)->find();
            if (!empty($menu['rule_val'])) {
            $rule_val = explode('/',$menu['rule_val']);
            $menu['controller'] = $rule_val[1];
            $menu['method'] = $rule_val[2];
        }
        $this->assign('menuList',$menuList);
        $this->assign('menu',$menu);
        return $this->fetch();
    }

    public function save(ModelMenu $menu) {
        $data = request()->put();
        $menu->saveData($data);
    }

    public function del(ModelMenu $menu) {
        $id = input('post.id');
        $menu->deleteById($id);
    }
}