<?php


namespace App\Services;

use App\Repositories\CategoriesRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\TagsRepositoryInterface;
use App\Repositories\ArticleRepositoryInterface;
use App\Services\ArticleServiceInterface;


class IndexService implements IndexServiceInterface
{
    protected $categoriesRepository;
    protected $categoryRepository;
    protected $tagsRepository;
    protected $articleRepository;
    protected $articleService;

    public function __construct
    (
        CategoriesRepositoryInterface $categoriesRepository,
        CategoryRepositoryInterface $categoryRepository,
        TagsRepositoryInterface $tagsRepository,
        ArticleRepositoryInterface $articleRepository,
        ArticleServiceInterface $articleService
    )
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagsRepository = $tagsRepository;
        $this->articleRepository = $articleRepository;
        $this->articleService = $articleService;
    }

    /**
     * author: カ シュンヨウ
     * description: 通过分类名或者标签名获取文章列表(主页面搜索功能)
     * @param $categoryOrTag_name
     * @return mixed
     */
    public function getContainCategoryOrTagList($categoryOrTag_name)
    {
        $categoriesList = $this->categoriesRepository->getAllCategories();
        $tagsList = $this->tagsRepository->getAllTags();
        $containCategoryAids = array();
        $containTagAids = array();
        foreach ($categoriesList as $categories) {
            if(strpos($categories->str_categories, $categoryOrTag_name) !== false){
                $containCategoryAids[] = $categories->aid;
            }
        }
        foreach ($tagsList as $tags) {
            if(strpos($tags->str_tags, $categoryOrTag_name) !== false){
                $containTagAids[] = $tags->aid;
            }
        }
        //合并数组
        $combineAids = array_merge($containCategoryAids, $containTagAids);
        //去除数组中的相同元素
        $combineAids = array_unique($combineAids);
        return $this->articleRepository->getArticlesPageByIds(ArticleService::PASS_STATUS, $combineAids);
    }

    public function getContainCategoryOrTagOrTitleList($categoryOrTagOrTitle_name, $article_status)
    {
        $categoriesList = $this->categoriesRepository->getAllCategories();
        $tagsList = $this->tagsRepository->getAllTags();
        $articleList = $this->articleRepository->getAllArticles($categoryOrTagOrTitle_name, $article_status);
        $containCategoryAids = array();
        $containTagAids = array();
        $containTitleAids = array();
        foreach ($categoriesList as $categories) {
            if(preg_match('/(?<![a-zA-Z0-9])'.$categoryOrTagOrTitle_name.'(?![a-zA-Z0-9])/i', $categories->str_categories)){
                $containCategoryAids[] = $categories->aid;
            }
        }
        foreach ($tagsList as $tags) {
            if(preg_match('/(?<![a-zA-Z0-9])'.$categoryOrTagOrTitle_name.'(?![a-zA-Z0-9])/i', $tags->str_tags)){
                $containTagAids[] = $tags->aid;
            }
        }
        foreach ($articleList as $article) {
            $containTitleAids[] = $article->id;
        }
        //合并数组
        $combineAids = array_merge($containCategoryAids, $containTagAids, $containTitleAids);
        //去除数组中的相同元素
        $combineAids = array_unique($combineAids);
        return $this->articleRepository->getArticlesPageByIds(ArticleService::PASS_STATUS, $combineAids);
    }



}