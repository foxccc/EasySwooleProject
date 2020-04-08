<?php
namespace app\admin\model;

use think\Db;
use think\Model;

class AdminRole extends Model
{
    protected $name = 'auth_role';

    public function getList(){
        $role = $this->alias('r')
            ->join('auth_rule u','FIND_IN_SET(u.id,r.rules)','left')
            ->field('r.*,GROUP_CONCAT(u.title) as title')
            ->group('r.id')
            ->select();
        $result = [];
        foreach($role as $k => $v){
            $result[$k] = $v->toArray();
        }
        return $result;
    }

    //编辑角色
    public function saveData(array $data = []) {
        $data['rules'] = implode(',',array_keys($data['ruleList']));
        $this->allowField(true)->save($data,['id'=>$data['id']]);
        exit(json_encode(['code'=>0,'msg'=>'修改成功']));
    }

    //添加角色
    public function addSaveData(array $data = []) {
        $data['rules'] = implode(',',array_keys($data['ruleList']));
        unset($data['ruleList']);
        $this->allowField(true)->insert($data);
        exit(json_encode(['code'=>0,'msg'=>'添加成功']));
    }

    //删除角色
    public function deleteById($id)
    {
        $result = $this::destroy($id);
        Db::name('auth_role_access')->where(['role_id'=>$id])->delete();
        exit(json_encode(['code'=>0,'msg'=>'删除成功']));
    }
}