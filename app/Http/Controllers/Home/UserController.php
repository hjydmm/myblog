<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Services\ArticleService;
use App\Services\UsersServiceInterface;
use App\Services\ArticleServiceInterface;
use App\Services\ArticleRelateServiceInterface;
use App\Services\CategoryServiceInterface;
use App\Services\CategoriesServiceInterface;
use App\Services\TagServiceInterface;
use App\Services\TagsServiceInterface;
use App\Services\CommentServiceInterface;
use App\Services\AttendServiceInterface;
use App\Services\LikeServiceInterface;
use App\Services\StoreServiceInterface;
use App\Traits\Response;
use Auth;
use Hash;

//要删
//use App\Http\Requests\StoreArticleRequest;
//use App\Http\Controllers\Controller;
//use App\Repositories\UsersRepository;
//use App\Services\UsersService;
//use App\Repositories\ArticleRepository;
//use App\Http\Requests\AdminRequest;
//use App\Repositories\CommentRepository;
//use App\Repositories\StoreRepository;
//use App\Repositories\AttendRepository;
//use App\Repositories\LikeRepository;
//use App\Repositories\NoticeRepository;
//use App\Services\BuildMenuService;
//use Hash;
  
class UserController extends BaseController
{
    use Response;

    protected $request;
    protected $usersService;
    protected $articleService;
    protected $articleRelateService;
    protected $categoryService;
    protected $categoriesService;
    protected $tagService;
    protected $tagsService;
    protected $commentService;
    protected $attendService;
    protected $likeService;
    protected $storeService;

    public function __construct
    (
        Request $request,
        UsersServiceInterface $usersService,
        ArticleServiceInterface $articleService,
        ArticleRelateServiceInterface $articleRelateService,
        CategoryServiceInterface $categoryService,
        CategoriesServiceInterface $categoriesService,
        TagServiceInterface $tagService,
        TagsServiceInterface $tagsService,
        CommentServiceInterface $commentService,
        AttendServiceInterface $attendService,
        LikeServiceInterface $likeService,
        StoreServiceInterface $storeService
    )
    {
        $this->request = $request;
        $this->usersService = $usersService;
        $this->articleService = $articleService;
        $this->articleRelateService = $articleRelateService;
        $this->categoryService = $categoryService;
        $this->categoriesService = $categoriesService;
        $this->tagService = $tagService;
        $this->tagsService = $tagsService;
        $this->commentService = $commentService;
        $this->attendService = $attendService;
        $this->likeService = $likeService;
        $this->storeService = $storeService;
    }


    /**
     * author: カ シュンヨウ
     * description: 用户每个页面都要加载的内容
     * @param $id
     */
    public function userPage($id){
        $categoryData = $this->categoryService->treeTypeCategoryList();
        $articleIds = $this->articleService->getUserArticleIds($id);
        $countPassArticle = $this->articleService->countPassArticle($id);
        $countArticleLiked = $this->likeService->countArticleLiked($articleIds);
        $countArticleStored = $this->storeService->countArticleStored($articleIds);
        $countAttended = $this->attendService->countAttended($id);

        return compact('categoryData', 'countPassArticle', 'countArticleLiked', 'countArticleStored', 'countAttended');
    }

    public function navPage(){
        $categoryData = $this->categoryService->treeTypeCategoryList();
        return compact('categoryData');
    }

    public function index($id)
    {
        $user = $this->usersService->getUserById($id);
        $pageElement = $this->userPage($id);
        $latestPassArticle = $this->articleService->userLatestArticleList($id, ArticleService::PASS_STATUS);
        $latestCommentData = $this->commentService->userLatestCommentList($id);

        return view('home.user.index', compact('pageElement', 'latestPassArticle', 'latestCommentData', 'user', 'id'));
    }

    /**
     * author: カ シュンヨウ
     * description: 编写文章页面，需要带入树形分类，标签，以及用户的数据
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function writeArticle()
    {
        $pageElement = $this->navPage();
        $tagData = $this->tagService->getAlltag();
        $user = $this->request->user('home');
        //自定义返回的分类，标签的背景颜色
        //$button_rand = array("btn-primary", "btn-info", "btn-warning");
        $button_rand = array("#d9be48", "#d32e27", "#8569a9", "#5e89ae", "#79cb96", "#585AAE");
        return view('home.user.writeArticle', compact('pageElement', 'tagData', 'button_rand', 'user'));
    }

    /**
     * author: カ シュンヨウ
     * description: 提交写好的文章，往article表,categories表,tags表插入数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitArticle()
    {
        //接收articles表需要的数据
        $articleData = $this->request->except('ids_categories', 'str_categories', 'ids_tags', 'str_tags');
        //接收categories表需要的数据
        $c_array = array();
        $cData = $this->request->only('ids_categories', 'str_categories');
        $cIds = $this->categoriesService->arrayToString(',', $cData['ids_categories']);
        $cStr = $this->categoriesService->arrayToString(',', $cData['str_categories']);
        $c_array['ids_categories'] = $cIds;
        $c_array['str_categories'] = $cStr;
        //接收tags表需要的数据
        $t_array = array();
        $tData = $this->request->only('ids_tags', 'str_tags');
        $tIds = $this->tagsService->arrayToString(',', $tData['ids_tags']);
        $tStr = $this->tagsService->arrayToString(',', $tData['str_tags']);
        $t_array['ids_tags'] = $tIds;
        $t_array['str_tags'] = $tStr;
        //由于要调用insertGetId和insert方法，不会自动添加created_at属性，所以要手动加
        $articleData['created_at'] = date('Y-m-d H:i:s');
        $articleData['updated_at'] = date('Y-m-d H:i:s');
        //categories表和tags表需要文章的id，所以article需要使用insertGetId方法
        $articleId = $this->articleService->createArticle($articleData);
        //categories表添加aid
        $c_array['aid'] = $articleId;
        //tags表添加aid
        $t_array['aid'] = $articleId;
        $categoriesResult = $this->categoriesService->createCategories($c_array);
        $tagsResult = $this->tagsService->createTags($t_array);
        //每创建一个文章数据就需要初始化一个article_relate，否则获取文章内容时会报错
        $ar_array = array();
        $ar_array['aid'] = $articleId;
        $ar_array['user_id'] = $articleData['user_id'];
        $ar_array['status'] = $articleData['status'];
        $ar_array['created_at'] = date('Y-m-d H:i:s');
        $ar_array['updated_at'] = date('Y-m-d H:i:s');
        $articleRelateResult = $this->articleRelateService->createArticleRelate($ar_array);
        return ($articleId && $categoriesResult && $tagsResult && $articleRelateResult) ?
            $this->ajaxSuccess('文章添加成功') : $this->ajaxError('文章添加失败');
    }

    /**
     * author: カ シュンヨウ
     * description: 文章提交后返回个人分享页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function share($id)
    {
        $user = $this->usersService->getUserById($id);
        //$total = $this->articleService->userSharePageAllArticleList($id);
        $pageElement = $this->userPage($id);
        $passArticle = $this->articleService->userSharePageArticleList($id, ArticleService::PASS_STATUS);
        $auditArticle = $this->articleService->userSharePageArticleList($id, ArticleService::AUDIT_STATUS);
        $draftArticle = $this->articleService->userSharePageArticleList($id, ArticleService::DRAFT_STATUS);
        $passCount = $this->articleService->countPassArticle($id);
        $auditCount = $this->articleService->countAuditArticle($id);
        $draftCount = $this->articleService->countDraftArticle($id);

        return view('home.user.share', compact('pageElement', 'passArticle', 'auditArticle', 'draftArticle', 'passCount', 'auditCount', 'draftCount','id', 'user'));
    }

    /**
     * author: カ シュンヨウ
     * description: 提交评论
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitComment()
    {
        $comment = $this->request->except('comment_count');
        $articleCommentCount = $this->request->get('comment_count');
        $updateResult = $this->articleService->updateArticleCommentCount($comment['aid'], ['comment_count'=>$articleCommentCount]);
        $result = $this->commentService->createComment($comment);
        return ( $result && $updateResult ) ? $this->ajaxSuccess('评论成功', compact('articleCommentCount', 'comment')) : $this->ajaxError('评论失败');

    }

    /**
     * author: カ シュンヨウ
     * description: 回复评论
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitReplyComment()
    {
        $replyComment = $this->request->all();
        $result = $this->commentService->createComment($replyComment);
        return $result ? $this->ajaxSuccess('回复成功', compact('replyComment')) : $this->ajaxError('回复失败');

    }

    /**
     * author: カ シュンヨウ
     * description: 保存文章的评论信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveCommentList()
    {
        $commentList = $this->request->only('id', 'comment_list');
        $commentNumber = $this->commentService->updateCommentNumber($commentList['id']);
        $result = $this->articleService->saveCommentList($commentList['id'], ['comment_list'=>$commentList['comment_list']]);
        return ($commentNumber && $result) ? $this->ajaxSuccess('') : $this->ajaxError('');
    }

    public function submitArticleDraft()
    {
        $aid = $this->request->get('aid');
        //接收articles表需要的数据
        $articleData = $this->request->except('ids_categories', 'str_categories', 'ids_tags', 'str_tags', 'aid');
        $articleData['updated_at'] = date('Y-m-d H:i:s');
        //接收categories表需要的数据
        $c_array = array();
        $cData = $this->request->only('ids_categories', 'str_categories');
        $cIds = $this->categoriesService->arrayToString(',', $cData['ids_categories']);
        $cStr = $this->categoriesService->arrayToString(',', $cData['str_categories']);
        $c_array['ids_categories'] = $cIds;
        $c_array['str_categories'] = $cStr;
        //接收tags表需要的数据
        $t_array = array();
        $tData = $this->request->only('ids_tags', 'str_tags');
        $tIds = $this->tagsService->arrayToString(',', $tData['ids_tags']);
        $tStr = $this->tagsService->arrayToString(',', $tData['str_tags']);
        $t_array['ids_tags'] = $tIds;
        $t_array['str_tags'] = $tStr;
        // 更新
        $articleResult = $this->articleService->updateArticle($aid, $articleData);
        $articleRelateResult = $this->articleRelateService->updateArticleRelate($aid, [ 'status'=>$articleData['status'] ]);
        $categoriesResult = $this->categoriesService->updateCategories($aid, $c_array);
        $tagsResult = $this->tagsService->updateTags($aid, $t_array);
        return ($articleResult && $categoriesResult && $tagsResult) ?
            $this->ajaxSuccess('文章添加成功') : $this->ajaxError('文章添加失败');
    }

    /**
     * author: カ シュンヨウ
     * description: 获取用户评论列表
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comment($id)
    {
        $user = $this->usersService->getUserById($id);
        $pageElement = $this->userPage($id);
        $commentData = $this->commentService->userCommentList($id);
        $commentCount = $this->commentService->countUserComment($id);
        return view('home.user.comment', compact('pageElement', 'commentData', 'commentCount', 'id', 'user'));
    }

    /**
     * author: カ シュンヨウ
     * description: 获取用户点赞列表
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function like($id)
    {
        $user = $this->usersService->getUserById($id);
        $pageElement = $this->userPage($id);
        $likeData = $this->likeService->userLikeList($id);
        $likeCount = $this->likeService->countUserLike($id);
        return view('home.user.like', compact('pageElement', 'likeData', 'likeCount', 'id', 'user'));
    }

    /**
     * author: カ シュンヨウ
     * description: 获取用户收藏列表
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store($id)
    {
        $user = $this->usersService->getUserById($id);
        $pageElement = $this->userPage($id);
        $storeData = $this->storeService->userStoreList($id);
        $storeCount = $this->storeService->countUserStore($id);
        return view('home.user.store', compact('pageElement', 'storeData', 'storeCount', 'id', 'user'));
    }

    public function attend($id)
    {
        $user = $this->usersService->getUserById($id);
        $pageElement = $this->userPage($id);
        $attendData = $this->attendService->userAttendList($id);
        $attendCount = $this->attendService->countUserAttend($id);
        return view('home.user.attend', compact('pageElement', 'attendData', 'attendCount', 'id', 'user'));
    }



    /**
     * author: カ シュンヨウ
     * description: 个人账号信息展示
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function account($id)
    {
        $user = $this->usersService->getUserById($id);
        $pageElement = $this->navPage();
        return view('home.user.account', compact('user', 'id', 'pageElement'));
    }
    /**
     * author: カ シュンヨウ
     * description: 个人账号信息编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->usersService->getUserById($id);
        $pageElement = $this->navPage();
        return view('home.user.edit', compact('user', 'id', 'pageElement'));
    }


    public function updateUserInfo($id)
    {
        $pageElement = $this->navPage();
        $userData = $this->request->except('_token');
        $userData['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->usersService->updateUser($id, $userData);
        $user = $this->usersService->getUserById($id);
        return view('home.user.account', compact('id', 'user', 'userData', 'pageElement'));
    }

    public function setPassword($id)
    {
        $pageElement = $this->navPage();
        $user = $this->usersService->getUserById($id);
        return view('home.user.setPassword', compact('id', 'user', 'pageElement'));
    }
    public function confirmPassword($id)
    {
        //规则
        $rule = [
            'old_password'   => 'required|alpha_num|min:6|max:10',
            'new_password'   => 'required|alpha_num|min:6|max:10',
            'confirm_new_password'   => 'required|alpha_num|min:6|max:10',
        ];
        // 自定义消息
        $messages = [
            'old_password.required'           => 'パスワードを入力してください',
            'old_password.alpha_num'          => 'パスワードはアルファベットと数字のみ許可します',
            'old_password.min'                => 'パスワードは少なくとも6文字が必要です',
            'old_password.max'                => 'パスワードは10文字以上含めることはできません',
            'new_password.required'           => 'パスワードを入力してください',
            'new_password.alpha_num'          => 'パスワードはアルファベットと数字のみ許可します',
            'new_password.min'                => 'パスワードは少なくとも6文字が必要です',
            'new_password.max'                => 'パスワードは10文字以上含めることはできません',
            'confirm_new_password.required'   => 'パスワードを入力してください',
            'confirm_new_password.alpha_num'  => 'パスワードはアルファベットと数字のみ許可します',
            'confirm_new_password.min'        => 'パスワードは少なくとも6文字が必要です',
            'confirm_new_password.max'        => 'パスワードは10文字以上含めることはできません',
        ];
        //开始自动验证
        $this -> validate($this->request, $rule, $messages);

        $pageElement = $this->navPage();
        $user = $this->usersService->getUserById($id);
        $password = $user->password;
        $passwordData = $this->request -> only('old_password', 'new_password', 'confirm_new_password');
        $old_password = $passwordData['old_password'];
        $new_password = $passwordData['new_password'];
        $confirm_new_password = $passwordData['confirm_new_password'];
        if (!Hash::check($old_password, $password)) {
            return redirect()->route('user.setPassword', ['id' => $id])
                -> withErrors([
                'setPasswordError' => '入力した古いパスワードは現在のパスワードと一致しません'
            ]);
        }
        if (!($new_password === $confirm_new_password)) {
            return redirect()->route('user.setPassword', ['id' => $id])
                -> withErrors([
                'setPasswordError' => '入力した新しいパスワードは再入力のパスワードと一致しません'
            ]);
        }
        $re_coded_password = bcrypt($new_password);
        $result = $this->usersService->updateUser($id, ['password' => $re_coded_password]);
        if($result){
            return redirect()->route('user.account',['id' => $id]);

        }else{
            return redirect()->route('user.setPassword', ['id' => $id])
                -> withErrors([
                'setPasswordError' => 'パスワードの更新はエラーが発生しました'
            ]);
        }
    }
    

    public function setAvatar($id)
    {
        $pageElement = $this->navPage();
        $user = $this->usersService->getUserById($id);
        return view('home.user.setAvatar', compact('id', 'user', 'pageElement'));
    }
//
//    /**
//     *
//     * @description:消息通知
//     * @author wuyanwen(2017年9月19日)
//     * @param@param NoticeRepository $notice
//     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
//     */
//    public function notice(NoticeRepository $notice)
//    {
//        return view('home.user.notice',[
//            'notice' => $notice->getNotice($this->request->user('home')->id),
//        ]);
//    }
//
//    /**
//     *
//     * @description:激活页面
//     * @author wuyanwen(2017年9月19日)
//     * @param@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
//     */
//    public function activation(Request $request, UsersRepository $user)
//    {
//        # home对应auth.php的guard
//        $user = $user->find('id', $request->user('home')->id);
//
//        return view('home.user.activation',[
//            'activation' => $user->activation,
//            'email'      => $user->email,
//        ]);
//    }
    

   
}
