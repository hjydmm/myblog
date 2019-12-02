<?php


namespace App\Services;

use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\ArticleRelateRepositoryInterface;


class ArticleRelateService implements ArticleRelateServiceInterface
{
    protected $articleRepository;
    protected $articleRelateRepository;

    //草稿状态
    const DRAFT_STATUS = 1;
    //审核状态
    const AUDIT_STATUS = 2;
    //通过状态
    const PASS_STATUS  = 3;

    //分页相关
    const PAGE_LIMIT = 8;

    public function __construct
    (
        ArticleRepositoryInterface $articleRepository,
        ArticleRelateRepositoryInterface $articleRelateRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->articleRelateRepository = $articleRelateRepository;
    }

    public function createArticleRelate(array $data)
    {
        return $this->articleRelateRepository->createArticleRelate($data);
    }

    public function updateArticleRelate($aid, array $data)
    {
        return $this->articleRelateRepository->updateArticleRelate($aid, $data);
    }

    public function deleteArticleRelateById($aid)
    {
        return $this->articleRelateRepository->deleteArticleRelateById($aid);
    }

    public function getMostLikeArticles($limit)
    {
        $where[] = ['article_relate.status', '=', self::PASS_STATUS];
        $order_by = 'article_relate.like_number';
        return $this->articleRelateRepository->getMostSeriesArticles($where, $order_by, $limit);
    }

    public function getMostStoreArticles($limit)
    {
        $where[] = ['article_relate.status', '=', self::PASS_STATUS];
        $order_by = 'article_relate.store_number';
        return $this->articleRelateRepository->getMostSeriesArticles($where, $order_by, $limit);
    }

    public function getMostCommentArticles($limit)
    {
        $where[] = ['article_relate.status', '=', self::PASS_STATUS];
        $order_by = 'article_relate.comment_number';
        return $this->articleRelateRepository->getMostSeriesArticles($where, $order_by, $limit);
    }
}