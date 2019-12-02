<?php


namespace App\Repositories;


interface AdminRepositoryInterface
{
    public function getAdminList();

    public function getAdminById($id);

    public function createAdmin(array $data);

    public function deleteAdminById($id);

    public function batchDeleteAdmin(array $ids);

    public function updateAdmin($admin_id, array $data);
}