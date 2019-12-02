<?php


namespace App\Services;


interface ArticleServiceInterface
{
    public function getArticleList($article_status);

    public function getAllArticleList();

    public function getArticleRelate($id);

    public function passToAudit($id, $str_status, $after);

    public function auditToPass($id, $str_status, $after);

    public function auditToNotPass($id, $str_status, $after);

    public function draftToPass($id, $str_status, $after);

    public function getArticleById($id);

    public function createArticle(array $data);

    public function updateArticle($aid, array $data);

    public function userLatestArticleList($id, $article_status);

    public function userSharePageArticleList($id, $article_status);

    public function userSharePageAllArticleList($id);

    public function countDraftArticle($id);

    public function countAuditArticle($id);

    public function countPassArticle($id);

    public function getArticleInfoById($aid);

    public function updateArticleCommentCount($aid, array $data);

    public function saveCommentList($id, array $commentList);

    public function getLatestArticles();

    public function getUserArticleIds($id);

    public function getContainSeriesList($series_name);

}