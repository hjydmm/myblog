<?php

namespace App\Repositories;

use App\Model\Admin;

class AdminRepository implements AdminRepositoryInterface
{
    protected static $admin;
    
    public function __construct(Admin $admin)
    {
        self::$admin = $admin;
    }

    /**
     * author: カ シュンヨウ
     * description: 获取所有管理员
     * @return mixed
     */
    public function getAdminList()
    {
        return self::$admin->get();
    }

    public function getAdminById($id){

        return self::$admin::where('id', $id)->get();
    }

    /**
     * author: カ シュンヨウ
     * description: 创建新的管理员
     * @param array $data
     * @return mixed
     */
    public function createAdmin(array $data)
    {
        return self::$admin->insert($data);
    }

    public function createAdminGetId(array $data)
    {
        $id = self::$admin->insertGetId($data);
        return $id;
    }

    /**
     * author: カ シュンヨウ
     * description: 根据id删除一个管理员
     * @param $id
     * @return int
     */
    public function deleteAdminById($id)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
       return self::$admin::destroy($id);
    }

    /**
     * author: カ シュンヨウ
     * description: 根据ids数组批量删除管理员
     * @param array $ids
     * @return int
     */
    public function batchDeleteAdmin(array $ids)
    {
        return self::$admin::destroy($ids);
    }

    /**
     * author: カ シュンヨウ
     * description: 更新一个管理员的信息
     * @param $admin_id
     * @param array $data
     * @return mixed
     */
    public function updateAdmin($admin_id, array $data){

        return self::$admin::where('id', '=', $admin_id) -> update($data);
    }

}