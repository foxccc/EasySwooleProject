<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/6/5 0005
 * Time: 下午 6:41
 */
namespace app\base\model;

class Base
{
    public function editData($data){
        if (isset($data['id'])){
            if (is_numeric($data['id']) && $data['id']>0){
                $save = $this->allowField(true)->save($data,[ 'id' => $data['id']]);
            }else{
                $save  = $this->allowField(true)->save($data);
            }
        }else{
            $save  = $this->allowField(true)->save($data);
        }
        if ( $save == 0 || $save == false) {
            $res=['code'=> 1009, 'msg' => '数据更新失败',];
        }else{
            $res=['code'=> 1001, 'msg' => '数据更新成功',];
        }
        return $res;
    }
}