<?php
namespace app\api\controller;

use think\Db;

class Classification extends Base
{
    public function getList() {
        $data = Db::table("ta_classification")->field('id,title')->select();
        if (!$data) {
            return self::showReturnCode(1030);
        }
        return self::showReturnCode(200,$data);
    }

    public function getArticleList() {
        $id = (int)input('get.id');
        $data = Db::table('ta_article')->where(['label_id'=>$id])->select();
        if (!$data) {
            return self::showReturnCode(1030);
        }
        return self::showReturnCode(200,$data);
    }
}