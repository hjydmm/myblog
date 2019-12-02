<?php


namespace App\Services;

use App\Repositories\AdminRepositoryInterface;
use App\Traits\Response;

class AdminService implements AdminServiceInterface
{
    use Response;

    protected $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * author: カ シュンヨウ
     * description: 获取管理员列表
     * @return mixed
     */
    public function getAdminList()
    {
        return $this->adminRepository->getAdminList();
    }

    /**
     * author: カ シュンヨウ
     * description: 通过id查找管理员
     * @param $id
     * @return mixed
     */
    public function getAdminById($id){
        return $this->adminRepository->getAdminById($id);
    }

    /**
     * author: カ シュンヨウ
     * description: 创建新的管理员
     * @param array $data
     * @return mixed
     */
    public function createAdmin(array $data)
    {
        return $this->adminRepository->createAdminGetId($data);
    }

    /**
     * author: カ シュンヨウ
     * description: 根据id删除一个管理员
     * @param $id
     * @return int
     */
    public function deleteAdminById($id)
    {
        return $this->adminRepository->deleteAdminById($id);
    }

    /**
     * author: カ シュンヨウ
     * description: 根据ids数组批量删除管理员
     * @param array $ids
     * @return mixed
     */
    public function batchDeleteAdmin(array $ids)
    {
        return $this->adminRepository->batchDeleteAdmin($ids);
    }

    /**
     * author: カ シュンヨウ
     * description: 更新一个管理员的信息
     * @param $admin_id
     * @param array $data
     * @return mixed
     */
    public function updateAdmin($admin_id, array $data){

        return $this->adminRepository->updateAdmin($admin_id, $data);
    }
}