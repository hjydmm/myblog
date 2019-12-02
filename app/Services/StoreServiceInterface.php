<?php


namespace App\Services;


interface StoreServiceInterface
{
    public function changeStoreAndUpdateNumber($aid, array $isStoreData, array $StoreData);

    public function userStoreList($id);

    public function countUserStore($id);

    public function isStored($isStoreData);

    public function deleteStoreById($aid);

    public function deleteStoresById($aid);
}