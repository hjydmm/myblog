<?php


namespace App\Services;

use App\Repositories\StoreRepositoryInterface;
use App\Repositories\ArticleRelateRepositoryInterface;

class StoreService implements StoreServiceInterface
{
    protected $storeRepository;
    protected $articleRelateRepository;

    public function __construct
    (
        StoreRepositoryInterface $storeRepository,
        ArticleRelateRepositoryInterface $articleRelateRepository
    )
    {
        $this->storeRepository = $storeRepository;
        $this->articleRelateRepository = $articleRelateRepository;
    }

    public function changeStoreAndUpdateNumber($aid, array $isStoreData, array $storeData)
    {
        $flag = $this->storeRepository->isStore($isStoreData);
        if( $flag === true ){
            $this->articleRelateRepository->decrementStoreNumber($aid);
            $this->storeRepository->cancelStore($isStoreData);
            return [ 'status'=>true, 'judge'=>'down' ];
        }elseif( $flag === false ){
            $this->articleRelateRepository->incrementStoreNumber($aid);
            $this->storeRepository->createStore($storeData);
            return [ 'status'=>true, 'judge'=>'up' ];
        }else{
            return false;
        }
    }

    public function userStoreList($id)
    {
        $with = ['articles'];
        return $this->storeRepository->getUserStoreById($id, $with);
    }

    public function countUserStore($id)
    {
        $where[] = ['user_id', '=', $id];
        return $this->storeRepository->countUserStore($where);
    }

    public function countArticleStored($whereIn)
    {
        return $this->storeRepository->countArticleStored($whereIn);
    }

    public function isStored($isStoreData) {
        return $this->storeRepository->isStore($isStoreData);
    }

    public function deleteStoreById($aid)
    {
        return $this->storeRepository->deleteStoreById($aid);
    }

    public function deleteStoresById($aid)
    {
        return $this->storeRepository->deleteStoresById($aid);
    }
}