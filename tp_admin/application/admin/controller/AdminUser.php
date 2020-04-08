<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/17 0017
 * Time: 下午 2:13
 */

namespace app\admin\controller;

use think\Controller;
use app\admin\model\AdminUser as ModelAdminUser;
use think\Db;

class AdminUser extends Base
{
    public function Index(ModelAdminUser $users){
        $userList = $users->getList();
        $this->assign('userList', $userList);
        return $this->fetch();
    }

    public function Add(){
        $roles = Db::name('auth_role')->select();
        $this->assign('roles', $roles);
        return $this->fetch();
    }
    public function Detail(){
        $id = (int)input('get.id');
        $db = new Db;
        $data['item'] = $db::name('auth_user')->where(['id'=>$id])->find();
        $data['roleId'] = $db::name('auth_role_access')->where('user_id',$id)->select();
        $data['roles'] = $db::name('auth_role')->select();
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function save(ModelAdminUser $users) {
        $data = request()->put();
        $users->saveData($data);
    }

    public function addSave(ModelAdminUser $users) {
        $data = request()->put();
        $users->addSaveData($data);
    }

    public function del(ModelAdminUser $users) {
        $id = input('post.id');
        $users->deleteById($id);
    }

    public function delList(){
        $data = request()->put();
        Db::name('auth_user')->where(['id','in',$data])->delete();
        exit(json_encode(['code'=>0,'msg'=>'删除成功']));
    }
}