<?php
namespace app\admin\model;

use think\Model;
use think\model\Pivot;

class AdminAccess extends Pivot
{
    protected $name = 'auth_role_access';
}