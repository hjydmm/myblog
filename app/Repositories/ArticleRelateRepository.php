<?php

namespace App\Repositories;

use App\Model\Article;
use App\Model\ArticleRelate;

class ArticleRelateRepository implements ArticleRelateRepositoryInterface
{
    //
    protected static $article_relate;
    protected static $article;

    public function __construct(ArticleRelate $article_relate, Article $article)
	{
	    self::$article_relate = $article_relate;
	    self::$article = $article;
    }

    public function getArticleRelateById($id)
    {
        return self::$article_relate::where('aid', $id)
            ->select('like_number', 'store_number', 'comment_number', 'pv_number')
            ->get();
    }

    public function createArticleRelate(array $data)
    {
        return self::$article_relate::insert($data);
    }

    public function updateArticleRelate($aid, array $data)
    {
        return self::$article_relate::where('aid', '=', $aid)
            ->update($data);
    }

    public function deleteArticleRelateById($aid)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
        return self::$article_relate::where('aid', '=', $aid)
            ->delete();
    }

    public function incrementLikeNumber($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)
            ->increment('like_number');
    }

    public function decrementLikeNumber($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)
            ->decrement('like_number');
    }

    public function incrementStoreNumber($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)
            ->increment('store_number');
    }

    public function decrementStoreNumber($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)
            ->decrement('store_number');
    }

    public function incrementCommentNumber($aid)
    {
        return self::$article_relate::where('aid', '=', $aid)
            ->increment('comment_number');
    }

    public function getMostSeriesArticles($where, $order_by, $limit = 5)
    {
        return self::$article_relate::with('articles', 'articles.categories')
            ->withOnly('users', ['user_name', 'avatar'])
            ->select('article_relate.*')
            ->where($where)
            ->orderBy($order_by, 'DESC')
            ->limit($limit)
            ->get();
    }

}
