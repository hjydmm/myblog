<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Model\Like;
use App\Services\ArticleService;
use App\Services\ArticleServiceInterface;
use App\Services\ArticleRelateServiceInterface;
use App\Services\CategoryServiceInterface;
use App\Services\CategoriesServiceInterface;
use App\Services\TagServiceInterface;
use App\Services\TagsServiceInterface;
use App\Services\LikeServiceInterface;
use App\Services\StoreServiceInterface;
use App\Services\CommentServiceInterface;
use App\Services\LinksServiceInterface;
use App\Services\IndexServiceInterface;
use App\Traits\Response;

class IndexController extends BaseController
{
    use Response;

    protected $request;
    protected $articleService;
    protected $articleRelateService;
    protected $categoryService;
    protected $categoriesService;
    protected $tagService;
    protected $tagsService;
    protected $likeService;
    protected $storeService;
    protected $commentService;
    protected $linksService;
    protected $indexService;

    public function __construct
    (
        Request $request,
        ArticleServiceInterface $articleService,
        ArticleRelateServiceInterface $articleRelateService,
        CategoryServiceInterface $categoryService,
        CategoriesServiceInterface $categoriesService,
        TagServiceInterface $tagService,
        TagsServiceInterface $tagsService,
        LikeServiceInterface $likeService,
        StoreServiceInterface $storeService,
        CommentServiceInterface $commentService,
        LinksServiceInterface $linksService,
        IndexServiceInterface $indexService
    )
    {
        $this->request = $request;
        $this->articleService = $articleService;
        $this->articleRelateService = $articleRelateService;
        $this->categoryService = $categoryService;
        $this->categoriesService = $categoriesService;
        $this->tagService = $tagService;
        $this->tagsService = $tagsService;
        $this->likeService = $likeService;
        $this->storeService = $storeService;
        $this->commentService = $commentService;
        $this->linksService = $linksService;
        $this->indexService = $indexService;
    }

    public function homePage()
    {
        //获取nav栏的分类信息
        $categoryData = $this->categoryService->treeTypeCategoryList();
        //获取右侧标签的信息
        $tagData = $this->tagService->getAlltag();
        //点赞最多
        $mostLikeArticles = $this->articleRelateService->getMostLikeArticles(5);
        //收藏最多
        //$mostStoreArticles = $this->articleRelateService->getMostStoreArticles(5);
        //评论最多
        //$mostCommentArticles = $this->articleRelateService->getMostCommentArticles(5);
        //links
        $links = $this->linksService->getMostLikeLinks();

        return compact('categoryData', 'tagData', 'mostLikeArticles', 'mostStoreArticles', 'mostCommentArticles', 'links');
    }

    public function index()
    {
        $latestArticlesInfo = $this->articleService->getLatestArticles();
        $articles = $latestArticlesInfo['data'];
        $total = $latestArticlesInfo['total'];
        $pageElement = $this->homePage();

        return view('home.index.index', compact( 'articles', 'total', 'pageElement'));
    }

    public function test()
    {
        $latestArticlesInfo = $this->articleService->getLatestArticles();
        $articles = $latestArticlesInfo['data'];
        $total = $latestArticlesInfo['total'];
        $pageElement = $this->homePage();

        return view('home.index.test', compact( 'articles', 'total', 'pageElement'));
    }

    /**
     * author: カ シュンヨウ
     * description: 根据分类名/标签名搜索文章列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getArticles()
    {
        $categoryOrTag_name = $this->request->route('categoryOrTag');
        $articles = $this->indexService->getContainCategoryOrTagList($categoryOrTag_name);
        $pageElement = $this->homePage();

        return view('home.index.index', compact('pageElement','categoryOrTag_name', 'articles'));
    }

    public function homeSearch()
    {
        $keyword = $this->request->route("keyword");
        if(!$keyword) {
            $message = "キーワードフォームにタイトル or カテゴリー名 or 記事タイトルを入力してください!";
            $pageElement = $this->homePage();
            return view('home.error.error', compact('message', 'pageElement'));
        }
        $articles = $this->indexService->getContainCategoryOrTagOrTitleList($keyword, ArticleService::PASS_STATUS);
        $pageElement = $this->homePage();

        return view('home.index.search', compact('pageElement', 'keyword', 'articles'));
    }


















//    public function index()
//    {
//
//        return view('home.index.index');
//    }
    
//    public function test()
//    {
//        $this->importComment();
//    }
//    public function importComment()
//    {
//
//        $users = (\DB::connection('mysql_old')->select('select * from user'));
//        //dd($reuslt);
//        $_users = \DB::connection('mysql')->select('select * from users');
//
//        foreach ($_users as $vo) {
//            foreach ($users as $user) {
//
//                if ($user->open_id == $vo->open_id) {
//                    $sql = sprintf('update users set `type` = "%d" where id = %d',$user->type + 1, $vo->id);
//
//                    \DB::connection('mysql')->update($sql);
//                }
//            }
//        }
//        die;
//        $results = $mysql_old->select('select * from articles');
//
//        foreach ($results as $vo) {
//
//
//            if ($vo->id > 80) {
//                $avatar = str_replace('img','images', $vo->thumb_img);
//                $intro = mb_substr(str_replace('&nbsp;','',strip_tags(html_entity_decode($vo->content))),0,200,'utf8');
//                $intro = str_replace('"','',$intro);
//                $sql = sprintf('update `articles` set `intro`="%s",`thumb_img`="%s" where id = %d',$intro, $avatar,$vo->id);
//                echo $mysql_old->update($sql);
//            }
//
//        }
//        die;
//
//    }
}
