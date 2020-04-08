<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/5/22 0022
 * Time: 上午 9:04
 */
namespace app\admin\model;

use app\common\model\Common;
use think\Cache;
use think\Db;
use think\Model;

class Sell extends  Model
{
    protected $table="sell";
    protected $autoWriteTimestamp=true;

    function country(){
        return $this->belongsTo('Country','place','id');
    }

    public function SellSelect(){
        //关联预载
//        $res = $this::with('country')->select();
//        foreach ($res as $v){
//            dump($v['name']);
//            dump($v->country->zh_name);
//        }
//        $res = $this::all();
//        $arr=load_relation($res,'country');
//        foreach ($arr as $v){
//            dump($v['name']);
//            dump($v->country->zh_name);
//        }
        Cache::remember('sell_list',function (){
            return $this::with('country')->select();
        });
        $data = Cache::get('sell_list');
        $res = [];
        foreach($data as $key=>$val){
            $res[$key] = $val->toArray();
        }
        return $res;
    }
}