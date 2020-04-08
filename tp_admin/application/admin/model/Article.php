<?php
namespace app\admin\model;

use think\Model;

class Article extends Model
{
    protected $name = "article";

    public function Danye() {
        return $this->belongsTo('Danye','label_id','id');
    }

    public function getList() {
        $user = $this::with(['Danye'])->paginate(3);
        $page = $user->render();
        $result = [];
        foreach($user as $k => $v){
            $result[$k] = $v->toArray();
        }
        return $result;
    }

    public function saveData($data) {
        $this->allowField(true)->save($data,['id'=>$data['id']]);
        exit(json_encode(['code'=>0,'msg'=>'修改成功']));
    }

    public function add($data) {
        $id = $this->allowField(true)->insertGetId($data);
        if ($id) {
            exit(json_encode(['code'=>0,'msg'=>'添加成功']));
        }
    }

    public function deleteById($id) {
        $result = $this::destroy($id);
        if ($result>0) {
            exit(json_encode(['code'=>0,'msg'=>'删除成功']));
        }
    }
}