<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //时间全局格式化
        \Carbon\Carbon::setLocale('ja');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //repository的接口绑定到实例
        $this->app->bind('App\Repositories\AdminRepositoryInterface', 'App\Repositories\AdminRepository');
        $this->app->bind('App\Repositories\PositionRepositoryInterface', 'App\Repositories\PositionRepository');
        $this->app->bind('App\Repositories\AuthRepositoryInterface', 'App\Repositories\AuthRepository');
        $this->app->bind('App\Repositories\MemoRepositoryInterface', 'App\Repositories\MemoRepository');

        $this->app->bind('App\Repositories\UsersRepositoryInterface', 'App\Repositories\UsersRepository');
        $this->app->bind('App\Repositories\CategoryRepositoryInterface', 'App\Repositories\CategoryRepository');
        $this->app->bind('App\Repositories\CategoriesRepositoryInterface', 'App\Repositories\CategoriesRepository');
        $this->app->bind('App\Repositories\ArticleRepositoryInterface', 'App\Repositories\ArticleRepository');
        $this->app->bind('App\Repositories\ArticleRelateRepositoryInterface', 'App\Repositories\ArticleRelateRepository');
        $this->app->bind('App\Repositories\CommentRepositoryInterface', 'App\Repositories\CommentRepository');
        $this->app->bind('App\Repositories\NoticeRepositoryInterface', 'App\Repositories\NoticeRepository');
        $this->app->bind('App\Repositories\AttendRepositoryInterface', 'App\Repositories\AttendRepository');
        $this->app->bind('App\Repositories\LikeRepositoryInterface', 'App\Repositories\LikeRepository');
        $this->app->bind('App\Repositories\StoreRepositoryInterface', 'App\Repositories\StoreRepository');
        $this->app->bind('App\Repositories\TagRepositoryInterface', 'App\Repositories\TagRepository');
        $this->app->bind('App\Repositories\TagsRepositoryInterface', 'App\Repositories\TagsRepository');
        $this->app->bind('App\Repositories\LinksRepositoryInterface', 'App\Repositories\LinksRepository');

        //service的接口绑定到实例
        $this->app->bind('App\Services\AdminServiceInterface', 'App\Services\AdminService');
        $this->app->bind('App\Services\PositionServiceInterface', 'App\Services\PositionService');
        $this->app->bind('App\Services\AuthServiceInterface', 'App\Services\AuthService');
        $this->app->bind('App\Services\MemoServiceInterface', 'App\Services\MemoService');

        $this->app->bind('App\Services\IndexServiceInterface', 'App\Services\IndexService');
        $this->app->bind('App\Services\UsersServiceInterface', 'App\Services\UsersService');
        $this->app->bind('App\Services\CategoryServiceInterface', 'App\Services\CategoryService');
        $this->app->bind('App\Services\CategoriesServiceInterface', 'App\Services\CategoriesService');
        $this->app->bind('App\Services\ArticleServiceInterface', 'App\Services\ArticleService');
        $this->app->bind('App\Services\ArticleRelateServiceInterface', 'App\Services\ArticleRelateService');
        $this->app->bind('App\Services\CommentServiceInterface', 'App\Services\CommentService');
        $this->app->bind('App\Services\NoticeServiceInterface', 'App\Services\NoticeService');
        $this->app->bind('App\Services\AttendServiceInterface', 'App\Services\AttendService');
        $this->app->bind('App\Services\LikeServiceInterface', 'App\Services\LikeService');
        $this->app->bind('App\Services\StoreServiceInterface', 'App\Services\StoreService');
        $this->app->bind('App\Services\TagServiceInterface', 'App\Services\TagService');
        $this->app->bind('App\Services\TagsServiceInterface', 'App\Services\TagsService');
        $this->app->bind('App\Services\LinksServiceInterface', 'App\Services\LinksService');


    }
}
