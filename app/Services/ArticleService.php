<?php

namespace App\Services;

use App\Repositories\ArticleRepositoryInterface;
use App\Services\ArticleRelateServiceInterface;
use App\Repositories\ArticleRelateRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\CategoriesRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use App\Repositories\TagsRepositoryInterface;


//这之后要删
use DB;
use App\Repositories\ArticleRepository;
use App\Repositories\TagsRepository;
use App\Repositories\ArticleRelateRepository;
use App\Repositories\TagsRelateRepository;

class ArticleService implements ArticleServiceInterface
{
    protected $articleRepository;
    protected $articleRelateService;
    protected $articleRelateRepository;
    protected $tagRepository;
    protected $tagsRepository;
    protected $categoryRepository;
    protected $categoriesRepository;

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
        ArticleRelateServiceInterface $articleRelateService,
        ArticleRelateRepositoryInterface $articleRelateRepository,
        TagRepositoryInterface $tagRepository,
        TagsRepositoryInterface $tagsRepository,
        CategoryRepositoryInterface $categoryRepository,
        CategoriesRepositoryInterface $categoriesRepository
    )
    {
        $this->articleRepository = $articleRepository;
        $this->articleRelateService = $articleRelateService;
        $this->articleRelateRepository = $articleRelateRepository;
        $this->tagRepository = $tagRepository;
        $this->tagsRepository = $tagsRepository;
        $this->categoryRepository = $categoryRepository;
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getArticleList($article_status)
    {
       return $this->articleRepository->getArticleList($article_status);
    }

    public function getAllArticleList()
    {
        return $this->articleRepository->getAllArticleList();
    }

    public function getArticleRelate($id)
    {
        return $this->articleRelateRepository->getArticleRelateById($id);
    }

    public function deleteArticleById($id)
    {
        return $this->articleRepository->deleteArticleById($id);
    }

    public function passToAudit($id, $str_status, $after)
    {
        return $this->articleRepository->changeArticleStatus($id, $str_status, $after);
    }

    public function auditToPass($id, $str_status, $after)
    {
        return $this->articleRepository->changeArticleStatus($id, $str_status, $after);
    }

    public function auditToNotPass($id, $str_status, $after)
    {
        return $this->articleRepository->changeArticleStatus($id, $str_status, $after);
    }

    public function draftToPass($id, $str_status, $after)
    {
        return $this->articleRepository->changeArticleStatus($id, $str_status, $after);
    }

    public function getArticleById($id)
    {
        return $this->articleRepository->getArticleById($id);
    }

    public function createArticle(array $data)
    {
        //$data['markdown_data'] = $this->modifyMarkdownContent($data['markdown_data']);
        return $this->articleRepository->createArticle($data);
    }

    public function updateArticle($aid, array $data)
    {
        //$data['markdown_data'] = $this->modifyMarkdownContent($data['markdown_data']);
        return $this->articleRepository->updateArticle($aid, $data);
    }

    public function modifyMarkdownContent($markdownData)
    {
        //需要用到正则表达式，有待完善
    }

    public function userLatestArticleList($id, $article_status)
    {
        $with = ['article_relate', 'categories'];
        return $this->articleRepository->getUserArticleList($with, $id, $article_status, $limit=5);
    }

    public function userSharePageArticleList($id, $article_status)
    {
        $with = ['article_relate', 'categories'];
        return $this->articleRepository->getUserArticleList($with, $id, $article_status, null);
    }

    public function userSharePageAllArticleList($id)
    {
        $with = ['article_relate'];
        return $this->articleRepository->getUserAllArticleList($with, $id);
    }


    public function countPassArticle($id)
    {
        $where = array();
        $where[] = ['articles.status', '=', self::PASS_STATUS];
        $where[] = ['articles.user_id', '=', $id];
        return $this->articleRepository->countArticle($where);
    }

    public function countAuditArticle($id)
    {
        $where = array();
        $where[] = ['articles.status', '=', self::AUDIT_STATUS];
        $where[] = ['articles.user_id', '=', $id];
        return $this->articleRepository->countArticle($where);
    }

    public function countDraftArticle($id)
    {
        $where = array();
        $where[] = ['articles.status', '=', self::DRAFT_STATUS];
        $where[] = ['articles.user_id', '=', $id];
        return $this->articleRepository->countArticle($where);
    }

    public function getArticleInfoById($aid)
    {
        $with = ['article_relate', 'tags', 'categories'];
        $withOnly = ['user_name', 'avatar'];
        return $this->articleRepository->getUserArticle($aid, $with, $withOnly);
    }

    public function updateArticleCommentCount($aid, array $data)
    {
        return $this->articleRepository->updateArticleCommentCount($aid, $data);
    }

    public function saveCommentList($id, array $commentList)
    {
        return $this->articleRepository->updateCommentList($id, $commentList);
    }

    public function getLatestArticles()
    {
        return $this->articleRepository->getLatestArticlesPage(self::PASS_STATUS, self::PAGE_LIMIT);
    }

    /**
     * author: カ シュンヨウ
     * description: 根据用户id获取该用户所有文章的id集合
     * @param $id
     * @return array
     */
    public function getUserArticleIds($id)
    {
        $userAllArticles = $this->articleRepository->getUserAllArticleList([], $id);
        $count = array();
        foreach ($userAllArticles as $article){
            $count[] = $article->id;
        }
        return $count;
    }

    public function getContainSeriesList($series_name)
    {
        $articleList = $this->articleRepository->getAllArticlesByCondition($series_name);
        $containSeries = array();
        foreach ($articleList as $article) {
            if(strpos($article->title, $series_name) !== false){
                $containSeries[] = $article->id;
            }
        }
        return $this->articleRepository->getSeriesArticlesByIds(ArticleService::PASS_STATUS, $containSeries);
    }

    public function getContainRankingsList($rankings_name)
    {
        if($rankings_name == "いいね！") {
            $articles = $this->articleRelateService->getMostLikeArticles(100);
        }elseif($rankings_name == "ブックマーク") {
            $articles = $this->articleRelateService->getMostStoreArticles(100);
        }else {
            $articles = $this->articleRelateService->getMostCommentArticles(100);
        }

        return $articles;
    }

}
