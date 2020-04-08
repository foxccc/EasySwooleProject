<?php
/**
 * Created by PhpStorm.
 * UserValidate: CYKn
 * Date: 2019/4/20 0020
 * Time: 下午 12:08
 */
namespace app\admin\validate;

use think\Validate;

class BaseValidate extends Validate
{
    public function toCheck($data){
        $res = $this->check($data);
        if (!$res) {
            exit(json_encode(['code'=>400,'msg'=>$this->error]));
        } else {
            return true;
        }
    }
}