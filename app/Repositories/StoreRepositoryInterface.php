<?php


namespace App\Repositories;


interface StoreRepositoryInterface
{
    public function createStore(array $storeData);

    public function cancelStore(array $isStoreData);

    public function isStore(array $isStoreData);

    public function getUserStoreById($id, $with);

    public function countUserStore($where);

    public function deleteStoreById($aid);

    public function deleteStoresById($aid);
}