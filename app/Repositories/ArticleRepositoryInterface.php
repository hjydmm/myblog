<?php


namespace App\Repositories;


interface ArticleRepositoryInterface
{
    public function getArticleList($article_status);

    public function getAllArticleList();

    public function getAllArticles($condition, $article_status, $limit = 6);

    public function getAllArticlesByCondition($condition);

    public function changeArticleStatus($id, $str_status, $after);

    public function selectArticleField($id, $field);

    public function getArticleById($id);

    public function getSeriesArticlesByIds($article_status, array $ids);

    public function createArticle(array $data);

    public function updateArticle($aid, array $data);

    public function getUserArticleList(array $with = null, $user_id, $article_status, $limit=5);

    public function getUserAllArticleList(array $with = null, $user_id);

    public function countArticle(array $where);

    public function getUserArticle($aid, array $with = null, array $withOnly = null);

    public function updateArticleCommentCount($aid, array $data);

    public function updateCommentList($id, array $commentList);

    public function getLatestArticlesPage($article_status, $limit = 5);

    public function getArticlesPageByIds($article_status, array $ids, $limit = 5);

//    public function getMostLikeArticles($article_status);
//
//    public function getMostStoreArticles($article_status);
//
//    public function getMostCommentArticles($article_status);
}