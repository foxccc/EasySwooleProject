<?php

return [
    //网站名称
    'website' => [
        'name' => 'Red-Team',
        'keywords' => 'TPAdmin,高性能，后台管理',
        'description' => 'ThinkPHP5,高性能，后台管理，权限管理，后台模版，组件化开发，软删除，验证器，多语言，国际化'
    ],
    //缓存
    'cache' => [
        // 驱动方式
        'type' => 'File',
        // 缓存保存目录
        'path' => CACHE_PATH,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],

    // 'app_debug'              => true,

    'session' => [
        'id' => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix' => '',
        // 驱动方式 支持redis memcache memcached
        'type' => '',
        // 是否自动开启 SESSION
        'auto_start' => true,
    ],

    //验证码

    'captcha' => [
        // 验证码字符集合
        'codeSet' => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
        // 验证码字体大小(px)
        'fontSize' => 50,
        // 是否画混淆曲线
        'useCurve' => false,
        // 验证码图片高度
        'imageH' => 30,
        // 验证码图片宽度
        'imageW' => 120,
        // 验证码位数
        'length' => 5,
        // 验证成功后是否重置
        'reset' => true
    ],

    //伪静态
    'url_html_suffix' => false,
    'user_auth_key' => 'Astonep@tp-admin!@#$',

    //异位或加密
    'AUTO_LOGIN_KEY' => md5('www.ta.com'),
    //自动登陆有效时间
    'AUTO_LOGIN_TIME' => 3600*24*7,
    'LV_LOGIN' => 1,
];