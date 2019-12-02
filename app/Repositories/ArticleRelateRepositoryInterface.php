<?php


namespace App\Repositories;


interface ArticleRelateRepositoryInterface
{
    public function getArticleRelateById($id);

    public function createArticleRelate(array $data);

    public function deleteArticleRelateById($aid);

    public function incrementLikeNumber($aid);

    public function decrementLikeNumber($aid);

    public function incrementStoreNumber($aid);

    public function decrementStoreNumber($aid);

    public function incrementCommentNumber($aid);

    public function getMostSeriesArticles($where, $order_by, $limit = 5);

}