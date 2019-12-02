<?php

namespace App\Repositories;

use App\Model\Store;

class StoreRepository implements StoreRepositoryInterface
{
    protected static $store;
    
    public function __construct(Store $store)
    {
        self::$store= $store;
    }

    public function isStore(array $isStoreData)
    {
        return self::$store::where($isStoreData)->first() ? true : false;
    }

    public function createStore(array $storeData)
    {
        return self::$store->insert($storeData);
    }

    public function cancelStore(array $isStoreData)
    {
        return self::$store::where($isStoreData)->delete();
    }

    public function getUserStoreById($id, $with)
    {
        return self::$store::with($with)
            ->select('store.*')
            ->where('store.user_id', '=', $id)
            ->orderBy('store.created_at', 'DESC')
            ->get();
    }

    public function countUserStore($where)
    {
        return self::$store->where($where)->count();
    }

    public function countArticleStored($whereIn){

        return self::$store->whereIn("aid", $whereIn)->count();
    }

    public function deleteStoreById($aid)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
        return self::$store::where('aid', '=', $aid)
            ->delete();
    }

    public function deleteStoresById($aid)
    {
        $flag = true;
        $data = self::$store::where('aid', '=', $aid)
            ->get();
        foreach ($data as $d) {
            $flag = self::$store::where('id', '=', $d->id)
                ->delete();
            if(!$flag) {
                break;
            }
        }
        return $flag;
    }
}
