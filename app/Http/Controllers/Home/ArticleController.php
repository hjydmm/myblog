<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Services\UsersServiceInterface;
use App\Services\ArticleServiceInterface;
use App\Services\CategoryServiceInterface;
use App\Services\CategoriesServiceInterface;
use App\Services\TagServiceInterface;
use App\Services\TagsServiceInterface;
use App\Http\Controllers\Home\UserController;
use App\Traits\Response;

//之后要删除
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;


class ArticleController extends BaseController
{
    use Response;

    protected $request;
    protected $userService;
    protected $articleService;
    protected $categoryService;
    protected $categoriesService;
    protected $tagService;
    protected $tagsService;
    protected $userController;

    public function __construct
    (
        Request $request,
        UsersServiceInterface $userService,
        ArticleServiceInterface $articleService,
        CategoryServiceInterface $categoryService,
        CategoriesServiceInterface $categoriesService,
        TagServiceInterface $tagService,
        TagsServiceInterface $tagsService,
        UserController $userController
    )
    {
        $this->request = $request;
        $this->userService = $userService;
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
        $this->categoriesService = $categoriesService;
        $this->tagService = $tagService;
        $this->tagsService = $tagsService;
        $this->userController = $userController;
    }

    /**
     * author: カ シュンヨウ
     * description: 通过文章id来展示某文章的详细信息(包括pass,audit两种状态)
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articleDetail($id)
    {

        if(isset($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'], "/series/") !== false) {
            $before_page = "series";
        }elseif(isset($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'], "/rankings/") !== false) {
            $before_page = "rankings";
        }else {
            $before_page = "normal";
        }

        $article_info = $this->articleService->getArticleInfoById($id);
        $tagsArray = $this->tagsService->stringToArray(',', $article_info->tags->str_tags);
        $categoriesArray = $this->categoriesService->stringToArray(',', $article_info->categories->str_categories);
        $id = $article_info->user_id;
        $user = $this->userService->getUserById($id);
        $pageElement = $this->userController->userPage($id);
        $viewPath = '';
        if($article_info->status == 3){
            $viewPath = 'home.article.detail';
        }else{
            $viewPath = 'home.article.audit';
        }
        return view($viewPath,compact('pageElement', 'article_info', 'id', 'user', 'tagsArray', 'categoriesArray', 'before_page'));
    }

    public function articleDraft($id)
    {
        $article_info = $this->articleService->getArticleInfoById($id);
        $tagsIdsArray = $this->tagsService->stringToArray(',', $article_info->tags->ids_tags);
        $categoriesIdsArray = $this->categoriesService->stringToArray(',', $article_info->categories->ids_categories);
        $id = $article_info->user_id;
        $user = $this->userService->getUserById($id);
        $pageElement = $this->userController->navPage();
        $tagData = $this->tagService->getAlltag();
        //自定义返回的分类，标签的背景颜色
        $button_rand = array("btn-primary", "btn-info", "btn-warning");
        return view('home.article.draft', compact('pageElement', 'tagData', 'button_rand', 'article_info', 'id', 'user', 'tagsIdsArray', 'categoriesIdsArray'));
    }

    public function getSeries() {
        $series_name = $this->request->route('series');
        $pageElement = $this->userController->navPage();
        $articles = $this->articleService->getContainSeriesList($series_name);
        return view('home.user.seriesArticles',compact('pageElement', 'articles', 'series_name'));
    }
    public function getRankings() {
        $rankings_name = $this->request->route('rankings');
        $pageElement = $this->userController->navPage();
        $articles = $this->articleService->getContainRankingsList($rankings_name);
        return view('home.user.rankingsArticles',compact('pageElement', 'articles', 'rankings_name'));
    }

}
