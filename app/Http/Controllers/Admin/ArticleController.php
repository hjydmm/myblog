<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
use App\Services\ArticleServiceInterface;
use App\Services\ArticleRelateServiceInterface;
use App\Services\CategoryServiceInterface;
use App\Services\CategoriesServiceInterface;
use App\Services\TagsServiceInterface;
use App\Services\CommentServiceInterface;
use App\Services\LikeServiceInterface;
use App\Services\StoreServiceInterface;
use App\Traits\Response;
use Carbon\Carbon;
use DB;

class ArticleController extends BaseController
{
    use Response;
    //
    protected $request;
    protected $articleService;
    protected $articleRelateService;
    protected $categoriesService;
    protected $tagsService;
    protected $commentService;
    protected $likeService;
    protected $storeService;

    //草稿状态
    const DRAFT_STATUS = 1;
    //审核状态
    const AUDIT_STATUS = 2;
    //通过状态
    const PASS_STATUS  = 3;

    public function __construct
    (
        Request $request,
        ArticleServiceInterface $articleService,
        ArticleRelateServiceInterface $articleRelateService,
        CategoriesServiceInterface $categoriesService,
        TagsServiceInterface $tagsService,
        CommentServiceInterface $commentService,
        LikeServiceInterface $likeService,
        StoreServiceInterface $storeService
    )
    {
        $this->request = $request;
        $this->articleService = $articleService;
        $this->articleRelateService = $articleRelateService;
        $this->categoriesService = $categoriesService;
        $this->tagsService = $tagsService;
        $this->commentService = $commentService;
        $this->likeService = $likeService;
        $this->storeService = $storeService;
    }

//    public function index()
//    {
//        $pass_data = $this->articleService->getArticleList(self::PASS_STATUS);
//        $audit_data = $this->articleService->getArticleList(self::AUDIT_STATUS);
//        $draft_data = $this->articleService->getArticleList(self::DRAFT_STATUS);
//        return view('admin.articles.article.index', compact('pass_data', 'audit_data', 'draft_data'));
//    }

    /**
     * author: カ シュンヨウ
     * description: 展示所有文章，并通过前端blade的if语句分类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->articleService->getAllArticleList();
        return view('admin.articles.article.index', compact('data'));
    }

    public function getArticle()
    {
        $id = $this->request->get('id');
        $data = $this->getArticleById($id);

    }

    public function deleteArticleById(){

        $id = $this->request->get('id');
        //开启事务
        DB::beginTransaction();
        $data = $this->articleService->deleteArticleById($id);
        $relate_data = $this->articleRelateService->deleteArticleRelateById($id);
        $categories_data = $this->categoriesService->deleteCategoriesById($id);
        $tags_data = $this->tagsService->deleteTagsById($id);
        $comment_data = $this->commentService->deleteCommentsById($id);
        $like_data = $this->likeService->deleteLikesById($id);
        $store_data = $this->storeService->deleteStoresById($id);
        if($data && $relate_data && $categories_data && $tags_data && $comment_data && $like_data && $store_data) {
            DB::commit();
            return $this->ajaxSuccess('削除は成功しました');
        }else {
            DB::rollback();
            return $this->ajaxError('削除は失敗しました');
        }
    }

    public function passToAudit()
    {
        $pageData = $this->request->all();
        $str_status = '->待审核';
        $pageData['status_change'] = $str_status;
        $pageData['updated_at'] = date('Y-m-d H:i:s');
        $pageData['updated_at_format'] = Carbon::parse(date('Y-m-d H:i:s'))->diffForHumans();
        $articleResult = $this->articleService->passToAudit($pageData['id'], $str_status, self::AUDIT_STATUS);
        $articleRelateResult = $this->articleRelateService->updateArticleRelate($pageData['id'], ['status'=>self::AUDIT_STATUS]);
        return ($articleRelateResult && $articleResult ) ? $this->ajaxSuccess('已转到待审核区，请查看!', $pageData) : $this->ajaxError('操作失败!');
    }

    public function auditToPass()
    {
        $pageData = $this->request->all();
        $str_status = '->审核通过';
        $pageData['status_change'] = $str_status;
        $pageData['updated_at'] = date('Y-m-d H:i:s');
        $pageData['updated_at_format'] = Carbon::parse(date('Y-m-d H:i:s'))->diffForHumans();
        $article_relate = $this->articleService->getArticleRelate($pageData['id']);
        $articleResult = $this->articleService->auditToPass($pageData['id'], $str_status, self::PASS_STATUS);
        $articleRelateResult = $this->articleRelateService->updateArticleRelate($pageData['id'], ['status'=>self::PASS_STATUS]);
        return ($articleRelateResult && $articleResult ) ? $this->ajaxSuccess('已转到审核通过区，请查看!', compact('pageData', 'article_relate')) : $this->ajaxError('操作失败!');
    }

    public function auditToNotPass()
    {
        $pageData = $this->request->all();
        $str_status = '->审核不通过';
        $pageData['status_change'] = $str_status;
        $pageData['updated_at'] = date('Y-m-d H:i:s');
        $pageData['updated_at_format'] = Carbon::parse(date('Y-m-d H:i:s'))->diffForHumans();
        $articleResult = $this->articleService->auditToNotPass($pageData['id'], $str_status, self::DRAFT_STATUS);
        $articleRelateResult = $this->articleRelateService->updateArticleRelate($pageData['id'], ['status'=>self::DRAFT_STATUS]);
        return ($articleRelateResult && $articleResult ) ? $this->ajaxSuccess('已转到审核不通过/草稿区，请查看!', $pageData) : $this->ajaxError('操作失败!');
    }

    public function draftToPass()
    {
        $pageData = $this->request->all();
        $str_status = '->审核通过';
        $pageData['status_change'] = $str_status;
        $pageData['updated_at'] = date('Y-m-d H:i:s');
        $pageData['updated_at_format'] = Carbon::parse(date('Y-m-d H:i:s'))->diffForHumans();
        $article_relate = $this->articleService->getArticleRelate($pageData['id']);
        $articleResult = $this->articleService->draftToPass($pageData['id'], $str_status, self::PASS_STATUS);
        $articleRelateResult = $this->articleRelateService->updateArticleRelate($pageData['id'], ['status'=>self::PASS_STATUS]);
        return ($articleRelateResult && $articleResult ) ? $this->ajaxSuccess('已转到审核通过区，请查看!', compact('pageData', 'article_relate')) : $this->ajaxError('操作失败!');
    }

    public function adminArticleDetail()
    {
        $pageData = $this->request->all();
        $id = $pageData['id'];
        $article_info = $this->articleService->getArticleInfoById($id);
        $tagsArray = $this->tagsService->stringToArray(',', $article_info->tags->str_tags);
        $categoriesArray = $this->categoriesService->stringToArray(',', $article_info->categories->str_categories);
        $user_id = $article_info->user_id;
        $user = $this->userService->getUserById($user_id);
        $viewPath = '';
        if($article_info->status == 3){
            $viewPath = 'home.article.detail';
        }else{
            $viewPath = 'home.article.audit';
        }
        return ($articleRelateResult && $articleResult ) ? $this->ajaxSuccess('已转到审核通过区，请查看!', compact('pageData', 'article_relate')) : $this->ajaxError('操作失败!');
    }

}
