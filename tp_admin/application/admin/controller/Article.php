<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/17 0017
 * Time: 下午 2:13
 */

namespace app\admin\controller;


use think\Controller;
use app\admin\model\Article as ModelArticle;
use think\Db;

class Article extends Controller
{
    public function Index(ModelArticle $article){
        $user = $article::with(['Danye'])->paginate(3);
        $page = $user->render();
        $result = [];
        foreach($user as $k => $v){
            $result[$k] = $v->toArray();
        }
        $this->assign('page',$page);
        $this->assign('articleData',$result);
//        $articleData = $article->getList();
//        $this->assign('articleData',$articleData);
        return $this->fetch();
    }
    public function Add(){
        $type = Db::name('classification')->select();
        $this->assign('type',$type);
        return $this->fetch();
    }
    public function Detail(){
        $id = (int)input('get.id');
        $db = new Db();
        $article = $db::name('article')->where(['id'=>$id])->find();
        $type = $db::name('classification')->select();
        $this->assign('article',$article);
        $this->assign('type',$type);
        return $this->fetch();
    }

    public function save(ModelArticle $article) {
        $data = request()->put();
        $article->saveData($data);
    }

    public function addSave(ModelArticle $article) {
        $data = request()->put();
        $article->add($data);
    }

    public function del(ModelArticle $article) {
        $id = input('post.id');
        $article->deleteById($id);
    }

    public function delList() {
        $data = request()->put();
        Db::name('article')->where(['id','in',$data])->delete();
        exit(json_encode(['code'=>0,'msg'=>'删除成功']));
    }

    public function search() {
        $data = request()->put();
        return $articleData = Db::name('article')->where('title','like','%'.$data['title'].'%')
            ->where(['status'=>$data['status']])
            ->select();
    }
}