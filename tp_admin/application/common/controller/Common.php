<?php
namespace app\common\controller;


use think\Config;
use think\Controller;
use think\Lang;

class Common extends Controller
{
    public function _initialize()
    {
        $now_lang = $this->getSetLang();
        $this->assign('set_lang', $now_lang);
    }

    public function getSetLang()
    {
        $lang = Lang::detect();
        if($lang == 'zh-cn') {
            return 'en-us';
        }
        return 'zh-cn';
    }

    public function getLang() {
        switch ($_GET['lang']) {
            case 'zh-cn':
                cookie('think_var', 'zh-cn');
                break;
            case 'en-us':
                cookie('think_var', 'en-us');
                break;
        }
    }
}