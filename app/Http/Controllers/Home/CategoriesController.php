<?php


namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Services\CategoryServiceInterface;
use App\Services\CategoriesServiceInterface;
use App\Services\TagServiceInterface;
use App\Services\ArticleServiceInterface;
use App\Services\ArticleRelateServiceInterface;
use App\Http\Controllers\Home\IndexController;
use App\Traits\Response;

class CategoriesController extends BaseController
{
    use Response;

    protected $request;
    protected $categoryService;
    protected $categoriesService;
    protected $tagService;
    protected $articleService;
    protected $articleRelateService;
    protected $indexController;


    public function __construct
    (
        Request $request,
        CategoryServiceInterface $categoryService,
        CategoriesServiceInterface $categoriesService,
        TagServiceInterface $tagService,
        ArticleServiceInterface $articleService,
        ArticleRelateServiceInterface $articleRelateService,
        IndexController $indexController
    )
    {
        $this->request = $request;
        $this->categoryService = $categoryService;
        $this->categoriesService = $categoriesService;
        $this->tagService = $tagService;
        $this->articleService = $articleService;
        $this->articleRelateService = $articleRelateService;
        $this->indexController = $indexController;
    }

    /**
     * author: カ シュンヨウ
     * description: 通过分类名获取文章列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getArticles()
    {
        $condition_name = $this->request->route('category');
        $flag = "category";
        $articles = $this->categoriesService->getContainCategoryList($condition_name);
        $pageElement = $this->indexController->homePage();

        return view('home.index.condition', compact('pageElement','condition_name', 'flag', 'articles'));
    }
}