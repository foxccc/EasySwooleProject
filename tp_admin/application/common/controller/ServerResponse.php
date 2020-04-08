<?php
/**
 * Created by PhpStorm.
 * User: CYKn
 * Date: 2019/5/25 0025
 * Time: 上午 9:00
 */
namespace app\lib\common;

use think\Config;
use think\exception\HttpResponseException;
use think\Response;

class ServerResponse
{
    //构造函数
    private function __construct($status, $msg = "", $data = [])
    {
        $result['status'] = $status;
        $msg ? $result['msg'] = $msg : null;
        $data ? $result['data'] = $data : null;
        $type = $this->getResponseType();
        $header['Access-Control-Allow-Origin'] = '*';
        $header['Access-Control-Allow-Headers'] = 'X-Requested-With,Content-Type';
        $header['Access-Control-Allow-Methods'] = 'GET,POST,PATCH,PUT,DELETE,OPTIONS';
        $response = Response::create($result, $type)->header($header);
        throw  new HttpResponseException($response);
    }

    public static function createBySuccess($msg,$data = null){
        return new ServerResponse(1,$msg,$data);
    }

    public static function createByError($msg){
        return new ServerResponse(0,$msg);
    }

    /**
     * 获取当前的response 输出类型
     * @access protected
     * @return string
     */
    private function getResponseType()
    {
        return Config::get('default_return_type');
    }
}