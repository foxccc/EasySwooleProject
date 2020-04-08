<?php
namespace app\admin\model;

use think\Model;
use app\admin\validate\UserValidate;

class AdminUser extends Model
{
    protected $autoWriteTimestamp = 'datetime';
    protected $name = 'auth_user';

    public function AdminRole()
    {
        return $this->belongsToMany('AdminRole','\app\admin\model\AdminAccess','role_id','user_id');
    }

    public function getList() {
        $user = $this::with(['AdminRole'])->select();
        $result = [];
        foreach($user as $k => $v){
            $result[$k] = $v->toArray();
        }
        return $result;
    }

    public function saveData(array $data = []) {
        $v = new UserValidate();
        $v->toCheck($data);
        $data['password'] = md5($data['password']);
        $this->allowField(true)->save($data,['id'=>$data['id']]);
        $rid = array_keys($data['role']);
        $u = $this::get($data['id']);
        $u->AdminRole()->attach($rid);
        exit(json_encode(['code'=>0,'msg'=>'修改成功']));
    }

    public function addSaveData(array $data = []) {
        $v = new UserValidate();
        $v->toCheck($data);
        $data['password'] = md5($data['password']);
        $data['create_time'] = date('Y-m-d h:i:s',time());
        $rid = array_keys($data['role']);
        unset($data['role']);
        $id = $this->allowField(true)->insertGetId($data);
        $u = $this::get($id);
        $u->AdminRole()->attach($rid);
        exit(json_encode(['code'=>0,'msg'=>'添加成功']));
    }

    public function deleteById($id)
    {
        $u = $this::get($id);
        $access = $u->AdminRole()->detach();
        $result = $this::destroy($id);
        exit(json_encode(['code'=>0,'msg'=>'删除成功']));
    }

}