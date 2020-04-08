<?php
namespace app\admin\model;

use think\Model;
use think\Db;

class Menu extends Model
{

    protected $name = 'auth_rule';

    public function getList(){
        $menu_list = Db::name('auth_rule')->select();
        $res = [];
        foreach ($menu_list as $key => $value){
            $res[$value['id']] = $value;
        }
        $res && $res = $this->getItems($res);
        $result = [];
        foreach ($res as $key => $value){
            $result[$value['id']] = $value;
        }
        return $result;
    }
    public function getItems($items){
        $tree = array();
        foreach ($items as $item){
            if (isset($items[$item['pid']])){
                $items[$item['pid']]['child'][] = &$items[$item['id']];
            }else{
                $tree[] = &$items[$item['id']];
            }
        }
        return $tree;
    }

    public function saveData(array $data = []) {
        if( isset( $data['id']) && !empty($data['id'])) {
            $result = $this->edit($data);
        } else {
            $result = $this->add($data);
        }
        return $result;
    }

    public function edit($data) {
        if (!empty($data['controller'])) {
            $rule_val = ['admin',$data['controller'],$data['method']];
            $data['rule_val'] = implode('/', $rule_val);
        }
        $this->allowField(true)->save($data,['id'=>$data['id']]);
        exit(json_encode(['code'=>0,'msg'=>'修改成功']));
    }

    public function add($data) {
        if (!empty($data['controller'])) {
            $rule_val = ['admin',$data['controller'],$data['method']];
            $data['rule_val'] = implode('/', $rule_val);
        }
        unset($data['controller']);
        unset($data['method']);
        $this->allowField(true)->insertGetId($data);
        exit(json_encode(['code'=>0,'msg'=>'添加成功']));
    }

    public function deleteById($id) {
        $db = new Db();
        $pid = $db::name('auth_rule')->where(['id'=>$id])->value('pid');
        if ($pid == 0) {
            $db::name('auth_rule')->where(['pid'=>$id])->delete();
        }
        $result = $this::destroy($id);
        exit(json_encode(['code'=>0,'msg'=>'删除成功']));
    }
}