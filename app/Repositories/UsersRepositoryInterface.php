<?php


namespace App\Repositories;


interface UsersRepositoryInterface
{
    public function getUsersList();

    public function getUserById($id);

    public function createUser(array $data);

    public function deleteUserById($id);

    public function batchDeleteUsers(array $ids);

    public function updateUser($user_id, array $data);
}