<?php
namespace app\common\tools;

use \think\Db;
use think\Model;
use think\Session;


/**
 * 权限验证类
 *
 * Class Auth
 * @package app\common\tools
 */
class Auth
{
    /**
     * 检查权限
     *
     * @param $name 获得权限$name
     * @param $uid 认证的用户id
     * @return bool
     */
    public function check($uid, $name)
    {
        $name = substr($name,1);
        $authList = $this->getAuthList($uid);
        if ($this->isCheck($name)) {
            return false;
        }
        if (in_array($name, $authList)) {
            return true;
        }
        return false;
    }

    //是否需要检查节点，如果不存在权限节点数据，则不需要检查
    public function isCheck( $name )
    {
        $rule_val = strtolower($name);
        $map = ['rule_val'=>$rule_val];
        if(Db::name('auth_rule')->where($map)->count()){
            return false;
        }
        return true;
    }

    /**
     * 获得权限列表
     *
     * @param $uid
     * @return array
     */
    protected function getAuthList($uid)
    {
        static $_authList = array();
        if (isset($_authList[$uid])) {
            return $_authList[$uid];
        }
        //获取所属角色的权限列表
        $roles = $this->getRoles($uid);
        $ids = array();
        foreach ($roles as $g) {
            $ids = array_merge($ids, explode(',', trim($g['rules'], ',')));
        }
        $ids = array_unique($ids);
        if (empty($ids)) {
            $_authList[$uid] = array();
        } else {
            $_authList[$uid] = $ids;
        }
        $map = array(
            'id' => ['in', $ids],
            'status' => 1,
        );
        //读取用户组所有权限规则
        $_authList[$uid] = Db::name('auth_rule')->where($map)->column('rule_val');
        return $_authList[$uid];
    }

    /**
     * 获得用户组，外部也可以调用
     *
     * @param $uid
     * @return mixed
     */
    public function getRoles($uid) {
        static $groups = array();
        if (isset($groups[$uid]))
            return $groups[$uid];
        $user_groups = Db::name('auth_role_access')->alias('a')
            ->where(['a.user_id'=>$uid])->join('auth_role g', 'a.role_id=g.id')->select();
        $groups[$uid]=$user_groups?$user_groups:array();
        return $groups[$uid];
    }
}
