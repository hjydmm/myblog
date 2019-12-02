<?php

namespace App\Repositories;

use App\Model\Article;
use App\Model\ArticleRelate;


class ArticleRepository implements ArticleRepositoryInterface
{
    protected static $article;
    protected static $articleRelate;

    public function __construct(Article $article, ArticleRelate $articleRelate)
	{
        self::$article = $article;
        self::$articleRelate = $articleRelate;
    }

    /**
     * author: カ シュンヨウ
     * description: 使用laravel的分页器实现快速分页
     * @param $article_status
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getLatestArticlesPage($article_status, $limit = 5)
    {
        $data = self::$article::with(['tags','categories','article_relate'])
            ->withOnly('users', ['user_name', 'avatar'])
            ->select('articles.*')
            ->where('articles.status', '=', $article_status)
            ->orderBy('articles.updated_at', 'DESC')
            ->paginate($limit);

        $total = self::$article::where('articles.status', '=', $article_status)->count();

        return ['data' => $data, 'total' => $total];
    }

    public function getArticlesPageByIds($article_status, array $ids, $limit = 10)
    {
        $data = self::$article::with(['tags','categories','article_relate'])
            ->withOnly('users', ['user_name', 'avatar'])
            ->select('articles.*')
            ->where('articles.status', '=', $article_status)
            ->whereIn('articles.id', $ids)
            ->orderBy('articles.updated_at', 'DESC')
            ->paginate($limit);

        return $data;
    }

    public function getSeriesArticlesByIds($article_status, array $ids)
    {
        $data = self::$article::with(['categories','article_relate'])
            ->withOnly('users', ['user_name', 'avatar'])
            ->select('articles.*')
            ->where('articles.status', '=', $article_status)
            ->whereIn('articles.id', $ids)
            ->orderBy('articles.created_at', 'DESC')
            ->get();

        return $data;
    }

//    public function getMostLikeArticles($article_status)
//    {
//        $like_number = self::$article->article_relate()->like_number;
//        $data = self::$article::with(['categories','article_relate'])
//            ->withOnly('users', ['user_name', 'avatar'])
//            ->select('articles.*')
//            ->where('articles.status', '=', $article_status)
//            ->orderBy( $like_number."", 'DESC')
//            ->get();
//
//        return $data;
//    }
//    public function getMostStoreArticles($article_status)
//    {
//        $data = self::$article::with(['categories','article_relate'])
//            ->withOnly('users', ['user_name', 'avatar'])
//            ->select('articles.*')
//            ->where('articles.status', '=', $article_status)
//            ->orderBy('articles.article_relate.store_number', 'DESC')
//            ->get();
//
//        return $data;
//    }
//    public function getMostCommentArticles($article_status)
//    {
//        $data = self::$article::with(['categories','article_relate'])
//            ->withOnly('users', ['user_name', 'avatar'])
//            ->select('articles.*')
//            ->where('articles.status', '=', $article_status)
//            ->orderBy('articles.article_relate.comment_number', 'DESC')
//            ->get();
//
//        return $data;
//    }

//if($rankings_name == "いいね！") {
//$articles = $this->articleRepository->getMostLikeArticles(ArticleService::PASS_STATUS, 10);
//}elseif($rankings_name == "ブックマーク") {
//$articles = $this->articleRepository->getMostStoreArticles(ArticleService::PASS_STATUS, 10);
//}else {
//    $articles = $this->articleRepository->getMostCommentArticles(ArticleService::PASS_STATUS, 10);
//}



    public function getArticlesPageByIdsWithoutLimit($article_status, array $ids)
    {
        $data = self::$article::with(['tags','categories','article_relate'])
            ->withOnly('users', ['user_name', 'avatar'])
            ->select('articles.*')
            ->where('articles.status', '=', $article_status)
            ->whereIn('articles.id', $ids)
            ->orderBy('articles.updated_at', 'DESC')
            ->get();

        return $data;
    }




    /**
     * author: カ シュンヨウ
     * description: (非常重要!!!)一个withOnly对应一个关联表(多个表可以写多个)，必须在article表里面写好关联关系，
     *              withOnly第二个参数里面要包含与article表关联的字段(默认id可以不用写),然后select里面只写
     *              article自身相关的字段(必须要写上与withOnly关联的字段!!!)
     *              with和withOnly的区别是withOnly可以指定查询的字段，而with默认查询全部字段
     *              可以实现多重关联，比如with('users.attend')关联到了写这篇文章作者的关注表，
     *              前提是在users表已经写好了users和attend的关联关系
     * @return mixed
     */
    public function getArticleList($article_status)
    {
        return self::$article::with(['tags','categories','article_relate'])->withOnly('users', ['user_name'])
            ->select('articles.title', 'articles.id', 'articles.created_at', 'articles.user_id', 'articles.status', 'articles.status_change')
            ->where('articles.status', '=', $article_status)
            ->orderBy('articles.updated_at', 'DESC')
            ->get();
    }

    /**
     * author: カ シュンヨウ
     * description: 获取所有的文章(对比上面的获取单个状态的文章效率更高，之后在blade页面上根据状态分类即可，可减轻数据库压力)
     * @return mixed
     */
    public function getAllArticleList()
    {
        return self::$article::with(['tags','categories','article_relate'])->withOnly('users', ['user_name'])
            ->select('articles.title', 'articles.id', 'articles.created_at', 'articles.updated_at', 'articles.user_id', 'articles.status', 'articles.status_change')
            ->orderBy('articles.updated_at', 'DESC')
            ->get();
    }

    public function getAllArticles($condition, $article_status, $limit = 6)
    {
        return self::$article::where('title', 'like', '%'.$condition.'%')
            ->get();

//        $data = self::$article::where('title', 'like', '%'.$condition.'%')
//            ->where('articles.status', '=', $article_status)
//            ->paginate($limit);
//
//        return $data;
    }

    public function getAllArticlesByCondition($condition)
    {
        return self::$article::where('title', 'like', '%'.$condition.'%')
            ->get();
    }

    /**
     * author: カ シュンヨウ
     * description: 修改文章状态
     * @param $id
     * @param $after
     * @return mixed
     */
    public function changeArticleStatus($id, $str_status, $after)
    {
        $str_status = $this->selectArticleField($id, 'status_change')->status_change . $str_status;
        return self::$article::where('id', $id)
            ->update(['status_change'=>$str_status, 'status'=>$after, 'updated_at'=>date('Y-m-d H:i:s')]);
    }

    /**
     * author: カ シュンヨウ
     * description: 只查找文章表某些字段
     * @param $id
     * @param $field
     * @return mixed
     */
    public function selectArticleField($id, $field)
    {
        return self::$article::where('id', $id)
            ->select($field)
            ->first();
    }

    public function deleteArticleById($id)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
        return self::$article::destroy($id);
    }

    public function getArticleById($id)
    {
        return self::$article::where('id', $id)->get();
    }


    public function createArticle(array $data)
    {
        $id = self::$article->insertGetId($data);
        return $id;
    }

    public function updateArticle($aid, array $data)
    {
        $result = self::$article::where('id', '=', $aid)->update($data);
        return $result;
    }

    public function getPageLimit($limit = 6){
        return $limit ? : self::$article::LIMIT;        
    }

    /**
     * author: カ シュンヨウ
     * description: 获取某个用户的某状态的文章
     * @param array|null $with
     * @param $user_id
     * @param $article_status
     * @return mixed
     */
    public function getUserArticleList(array $with = null, $user_id, $article_status, $limit=5)
    {
        $data = self::$article::with($with)->withOnly('users', ['user_name'])
            ->select('articles.title', 'articles.id', 'articles.created_at', 'articles.user_id', 'articles.status', 'articles.status_change')
            ->where('articles.status', '=', $article_status)
            ->where('articles.user_id', '=', $user_id)
            ->orderBy('articles.updated_at', 'DESC')
            ->limit($limit)
            ->get();
        return $data;
    }

    /**
     * author: カ シュンヨウ
     * description: 获取某个用户的所有文章
     * @return mixed
     */
    public function getUserAllArticleList(array $with = null, $user_id)
    {
        return self::$article::with($with)->withOnly('users', ['user_name'])
            ->select('articles.title', 'articles.id', 'articles.created_at', 'articles.user_id', 'articles.status', 'articles.status_change')
            ->where('articles.user_id', '=', $user_id)
            ->orderBy('articles.updated_at', 'DESC')
            ->get();
    }

    public function countArticle(array $where)
    {
        return self::$article->where($where)->count();
    }

    /**
     * author: カ シュンヨウ
     * description: 获取某个用户的某个状态的文章，用于展示文章详细信息
     * @param array|null $with
     * @param array|null $withOnly
     * @param $article_status
     * @return mixed
     */
    public function getUserArticle($aid, array $with = null, array $withOnly = null)
    {
        return self::$article::with($with)->withOnly('users', $withOnly)
            ->select('articles.title', 'articles.id',
                'articles.created_at', 'articles.user_id',
                'articles.content', 'articles.markdown_content',
                'articles.intro', 'articles.status',
                'articles.comment_count', 'comment_list', 'articles.css_style')
            ->where('articles.id', '=', $aid)
            ->first();
    }

    public function updateArticleCommentCount($aid, array $data){

        return self::$article::where('id', '=', $aid) -> update($data);
    }

    public function updateCommentList($id, array $commentList)
    {
        $result = self::$article::where('id', '=', $id)->update($commentList);
        return $result;
    }

}
