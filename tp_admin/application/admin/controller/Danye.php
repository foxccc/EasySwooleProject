<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/17 0017
 * Time: 下午 2:13
 */

namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\model\Danye as ModelDanye;

class Danye extends Controller
{
    public function Index(){
        $type = Db::name('classification')->select();
        $this->assign('type',$type);
        return $this->fetch();
    }

    public function Detail(){
        $id = (int)input('get.id');
        $type = Db::name('classification')->where(['id'=>$id])->find();
        $this->assign('type',$type);
        return $this->fetch();
    }

    public function save(ModelDanye $type) {
        $data = request()->put();
        $type->saveData($data);
    }
}