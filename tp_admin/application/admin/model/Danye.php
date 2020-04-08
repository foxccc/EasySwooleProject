<?php
namespace app\admin\model;

use think\Model;

class Danye extends Model
{
    protected $name = "classification";

    public function saveData($data) {
        if( isset( $data['id']) && !empty($data['id'])) {
            $result = $this->edit( $data );
        } else {
            $result = $this->add( $data );
        }
        return $result;
    }

    public function edit($data) {
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