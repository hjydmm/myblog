<?php
   
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* ----------------------------------------------------------------------------------------- */
/* -----------------------------------------Frontend---------------------------------------- */
/* ----------------------------------------------------------------------------------------- */

//不需要路由验证的都写在这里
Route::namespace('Home')->group(function(){
    //实现路由保护(middleware('auth:home'))后，没有登录的情况下所有尝试登录非login主页的页面都会跳转到login主页，
    //这一自动跳转由/vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/Handler.php
    //里面的unauthenticated方法定义好，所有这里要起别名name('login')
    Route::get('/login', 'LoginController@login') -> name('login');
    //前台登录提交处理
    Route::post('/doLogin', 'LoginController@doLogin');
    //前台退出页面
    Route::get('/logout', 'LoginController@logout');
    //前台注册页面
    Route::get('/register', 'RegisterController@register');
    //前台注册提交处理
    Route::post('doRegister', 'RegisterController@doRegister');

    //前台登录页面
    Route::get('/', 'IndexController@index');
    /* 根据分类获取文章 */
    Route::get('/category/{category}', 'CategoriesController@getArticles')->name('category.articles');
    /* 根据标签获取文章 */
    Route::get('/tag/{tag}', 'TagsController@getArticles')->name('tag.articles');
    /* 根据分类和标签获取文章 */
    Route::get('/categoryAndTag/{categoryOrTag}', 'IndexController@getArticles')->name('categoryAndTag.articles');
    /* 全站搜索(根据分类或标签或文章标题获取文章) */
    Route::get('/keyword/{keyword}', 'IndexController@homeSearch')->name('keyword.articles');

    /* 根据名称获取文章series */
    Route::get('/series/{series}', 'ArticleController@getSeries')->name('series.articles');
    /* 根据名称获取文章rankings */
    Route::get('/rankings/{rankings}', 'ArticleController@getRankings')->name('rankings.articles');

    /* 详情页面(审核通过的文章页面)  */
    Route::get('/detail/{id}', 'ArticleController@articleDetail')->name('user.articleDetail')->where(['id' => '[0-9]+']);

    /* 用户中心之基本信息 */
    Route::prefix('user')->group(function () {
        Route::get('/{id}', 'UserController@index')->name('user.page')->where(['id' => '[0-9]+']);
        Route::get('/{id}/like', 'UserController@like')->name('user.like')->where(['id' => '[0-9]+']);
        Route::get('/{id}/attend', 'UserController@attend')->name('user.attend')->where(['id' => '[0-9]+']);
        Route::get('/{id}/comment', 'UserController@comment')->name('user.comment')->where(['id' => '[0-9]+']);
        Route::get('/{id}/share', 'UserController@share')->name('user.share')->where(['id' => '[0-9]+']);
        Route::get('/{id}/store', 'UserController@store')->name('user.stores')->where(['id' => '[0-9]+']);
    });

    /* 判断是否已经点赞 */
    Route::post('/isLiked', 'LikeController@isLiked');
    /* 判断是否已经收藏 */
    Route::post('/isStored', 'StoreController@isStored');

    /*ajax请求需要自定义身份验证*/
    /* 关注 */
    Route::post('/clickToAttend', 'AttendController@clickAttend');
    /* 点赞 */
    Route::post('/clickForLike', 'LikeController@clickLike');
    /* 收藏 */
    Route::post('/clickForStore', 'StoreController@clickStore');

    Route::get('/test', 'IndexController@test');

});

//需要路由验证的都写在这里
//Route::namespace('Home')->middleware('auth:home')->group(function(){
Route::namespace('Home')->middleware('checkLogin')->group(function(){

    /* 用户中心之登录后信息 */
    Route::prefix('user')->group(function () {
        Route::get('/{id}/account', 'UserController@account')->name('user.account')->where(['id' => '[0-9]+']);
        Route::get('/{id}/edit', 'UserController@edit')->name('user.edit')->where(['id' => '[0-9]+']);
        Route::any('/{id}/updateUserInfo', 'UserController@updateUserInfo')->name('user.updateUserInfo')->where(['id' => '[0-9]+']);
        Route::get('/{id}/setPassword', 'UserController@setPassword')->name('user.setPassword')->where(['id' => '[0-9]+']);
        Route::post('/{id}/confirmPassword', 'UserController@confirmPassword')->name('user.confirmPassword')->where(['id' => '[0-9]+']);
        Route::get('/{id}/setAvatar', 'UserController@setAvatar')->name('user.setAvatar')->where(['id' => '[0-9]+']);
        Route::get('/{id}/notice', 'UserController@notice')->name('user.notice')->where(['id' => '[0-9]+']);
        /* 上传头像  */
        Route::post('/uploadAvatar', 'FileController@uploadAvatar')->name('user.uploadAvatar');
    });

    /* 用户中心之写文章 */
    Route::get('/writeArticle', 'UserController@writeArticle');
    Route::post('/submitArticle', 'UserController@submitArticle');
    Route::post('/submitArticleDraft', 'UserController@submitArticleDraft');



    /* 详情页面(草稿阶段的可编辑页面)  */
    Route::get('/draft/{id}', 'ArticleController@articleDraft')->name('user.articleDraft')->where(['id' => '[0-9]+']);
    /* 详情页面(审查阶段的文章页面)  */
    Route::get('/audit/{id}', 'ArticleController@articleDetail')->name('user.articleAudit')->where(['id' => '[0-9]+']);

    /* 评论 */
    Route::post('/submitComment', 'UserController@submitComment');
    Route::post('/submitReplyComment', 'UserController@submitReplyComment');
    Route::post('/saveCommentList', 'UserController@saveCommentList');

    /* 消息通知  */
    //Route::post('/readNotice', 'NoticeController@readNotice');
    //Route::post('/deleteNotice', 'NoticeController@deleteNotice');
});

/* ----------------------------------------------------------------------------------------- */
/* ----------------------------------------Backend------------------------------------------ */
/* ----------------------------------------------------------------------------------------- */

//不需要路由验证的都写在这里
//Route::domain(config('home.admin_domain'))->namespace('Admin')->prefix('admin')->group(function(){
Route::namespace('Admin')->prefix('admin')->group(function(){
    Route::get('/login','IndexController@login')->name('login');
    Route::post('/doLogin','IndexController@doLogin');
    Route::get('/logout','IndexController@logout');
});

//需要路由验证的都写在这里
//Route::domain(config('home.admin_domain'))->namespace('Admin')->prefix('admin')->middleware('auth:admin')->group(function(){
Route::namespace('Admin')->prefix('admin')->middleware('auth:admin')->group(function(){
    //首页相关
    Route::get('/index','IndexController@index');
    //Memo
    //Route::post('/memo/add','MemoController@createMemo');
    Route::post('/memo/update','MemoController@updateMemo');
    //Route::post('/memo/find','MemoController@getMemosByAid');

    //管理员模块
    Route::get('/admin/index','AdminController@index');
    Route::get('/admin/index2','AdminController@index2');
    Route::post('/admin/find','AdminController@getAdminById');
    Route::post('/admin/delete','AdminController@deleteAdminById');
    Route::post('/admin/edit','AdminController@updateAdmin');
    Route::post('/admin/status_stop','AdminController@status_stop');
    Route::post('/admin/status_start','AdminController@status_start');
    Route::post('/admin/add','AdminController@createAdmin');
    Route::post('/admin/changePassword','AdminController@changeAdminPassword');

    //用户模块
    Route::get('/users/index','UsersController@index');
    Route::post('/users/find','UsersController@getUserById');
    Route::post('/users/delete','UsersController@deleteUserById');
    Route::post('/users/edit','UsersController@updateUser');
    Route::post('/users/status_stop','UsersController@status_stop');
    Route::post('/users/status_start','UsersController@status_start');
    Route::post('/users/add','UsersController@createUser');

    //文章模块
    //文章模块之文章管理模块
    Route::get('/articles/article/index','ArticleController@index');
    Route::post('/articles/article/delete','ArticleController@deleteArticleById');
    Route::post('/articles/article/passToAudit','ArticleController@passToAudit');
    Route::post('/articles/article/auditToPass','ArticleController@auditToPass');
    Route::post('/articles/article/auditToNotPass','ArticleController@auditToNotPass');
    Route::post('/articles/article/draftToPass','ArticleController@draftToPass');
    //查看文章详情
    Route::post('/articles/article/detail', 'ArticleController@adminArticleDetail');
//    /* 详情页面(审查阶段的文章页面)  */
//    Route::post('/articles/article/audit', 'ArticleController@adminArticleDetail');
//    /* 详情页面(草稿阶段的可编辑页面)  */
//    Route::post('/articles/article/draft', 'ArticleController@adminArticleDraft');


    //文章模块之分类管理模块
    Route::get('/articles/category/index','CategoryController@index');
    Route::post('/articles/category/find','CategoryController@getCategoryById');
    Route::post('/articles/category/delete','CategoryController@deleteCategoryById');
    Route::post('/articles/category/edit','CategoryController@updateCategory');
    Route::post('/articles/category/add','CategoryController@createCategory');
    Route::get('/articles/category/getOptionById','CategoryController@optionCategory');
    //文章模块之标签管理模块
    Route::get('/articles/tag/index','TagController@index');
    Route::post('/articles/tag/find','TagController@getTagById');
    Route::post('/articles/tag/delete','TagController@deleteTagById');
    Route::post('/articles/tag/edit','TagController@updateTag');
    Route::post('/articles/tag/add','TagController@createTag');

    Route::get('/articles/tag/index_test','TagController@index_test');

    //链接模块
    Route::get('/links/index','LinksController@index');
    Route::post('/links/find','LinksController@getLinkById');
    Route::post('/links/delete','LinksController@deleteLinkById');
    Route::post('/links/edit','LinksController@updateLink');
    Route::post('/links/add','LinksController@createLink');
});
