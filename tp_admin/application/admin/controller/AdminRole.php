<?php

namespace app\admin\controller;


use think\Controller;
use app\admin\model\AdminRole as ModelAdminRole;
use think\Db;

class AdminRole extends Base
{
    public function Index(ModelAdminRole $roles){
        $roleList = $roles->getList();
        $this->assign('roleList',$roleList);
        return $this->fetch();
    }

    public function Add(){
        $rules = Db::name('auth_rule')->where("pid!=0")->select();
        $this->assign('ruleList', $rules);
        return $this->fetch();
    }
    public function Detail(){
        $id = (int)input('get.id');
        $db = new Db();
        $roleList = $db::name('auth_role')->where(['id'=>$id])->find();
        $roleList['rule'] = explode(',',$roleList['rules']);
        $ruleList = $db::name('auth_rule')->where("pid!=0")->select();
        $this->assign('roleList',$roleList);
        $this->assign('ruleList',$ruleList);
        return $this->fetch();
    }

    //编辑角色
    public function save(ModelAdminRole $roles){
        $data = request()->put();
        $roles->saveData($data);
    }

    //添加角色
    public function addSave(ModelAdminRole $roles) {
        $data = request()->put();
        $roles->addSaveData($data);
    }

    //删除角色
    public function del(ModelAdminRole $roles) {
        $id = input('post.id');
        $roles->deleteById($id);
    }
}