<?php


namespace App\Services;


interface ArticleRelateServiceInterface
{
    public function createArticleRelate(array $data);

    public function updateArticleRelate($aid, array $data);

    public function deleteArticleRelateById($aid);

    public function getMostLikeArticles($limit);

    public function getMostStoreArticles($limit);

    public function getMostCommentArticles($limit);

}