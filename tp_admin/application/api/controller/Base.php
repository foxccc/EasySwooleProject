<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/7/16 0016
 * Time: 下午 3:23
 */
namespace app\api\controller;

use think\Controller;

class Base extends Controller
{
    protected function buildParam($array)
    {
        $data=[];
        if (is_array($array)&&!empty($array)){
            foreach( $array as $item=>$value ){
                $data[$item] = trim($this->request->param($value));
            }
        }
        return $data;
    }

    static public function showReturnCode($code = '', $result = [], $msg = '')
    {
        $return_data = [
            'code' => '500',
            'msg' => '未定义消息',
            'result' => $code == 200 ? $result : [],
        ];
        if (empty($code)) return $return_data;
        $return_data['code'] = $code;
        if(!empty($msg)){
            $return_data['msg'] = $msg;
        }else if (isset(ReturnCode::$return_code[$code]) ) {
            $return_data['msg'] = ReturnCode::$return_code[$code];
        }
        return $return_data;
    }
}