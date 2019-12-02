<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Services\TagServiceInterface;
use App\Services\TagsServiceInterface;
use App\Services\ArticleServiceInterface;
use App\Services\ArticleRelateServiceInterface;
use App\Http\Controllers\Home\IndexController;
use App\Traits\Response;

class TagsController extends BaseController
{
    use Response;

    protected $request;
    protected $tagService;
    protected $tagsService;
    protected $articleService;
    protected $articleRelateService;
    protected $indexController;

    public function __construct
    (
        Request $request,
        TagServiceInterface $tagService,
        TagsServiceInterface $tagsService,
        ArticleServiceInterface $articleService,
        ArticleRelateServiceInterface $articleRelateService,
        IndexController $indexController
    )
    {
        $this->request = $request;
        $this->tagService = $tagService;
        $this->tagsService = $tagsService;
        $this->articleService = $articleService;
        $this->articleRelateService = $articleRelateService;
        $this->indexController = $indexController;
    }


    public function getArticles()
    {
        $condition_name = $this->request->route('tag');
        $flag = "tag";
        $articles = $this->tagsService->getContainTagList($condition_name);
        $pageElement = $this->indexController->homePage();

        return view('home.index.condition', compact('pageElement','condition_name', 'flag', 'articles'));
    }
}
