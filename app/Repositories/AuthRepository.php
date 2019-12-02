<?php


namespace App\Repositories;

use App\Model\Position;
use App\Model\Admin;
use App\Model\Auth as AdminAuth;  //为了区分在config里面定义好的Auth，这里最好重命名

class AuthRepository implements AuthRepositoryInterface
{
    protected static $auth;
    //模型model的各种CRUD都写在repository里面，model里面只保留$table等字段以及与其他数据库关联的设置
    //对于数据库的操作，需要引入相关的model
    public function __construct(AdminAuth $auth)
    {
        self::$auth = $auth;
    }

    /**
     * author: カ シュンヨウ
     * description: 根据id数组获取子权限collection集合
     * @param array $ids
     * @return mixed
     */
    public function getChildAuthByIds(array $ids){

        return self::$auth::where('pid', '!=', '0') -> whereIn('id', $ids) -> get();
    }


}