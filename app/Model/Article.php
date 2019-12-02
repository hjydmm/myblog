<?php

namespace App\Model;

//use App\Model\Users;
//use App\Model\ArticleRelate;
//use App\Model\Categories;
//use App\Model\Tags;
//use App\Model\Like;
//use App\Model\Store;
//use App\Model\Comment;

class Article extends BaseModel
{
    protected $table = 'articles';

    /**
     * author: カ シュンヨウ
     * description: 文章article关联文章相关article_relate(一对一关系)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function article_relate()
    {
        return $this->hasOne(ArticleRelate::class, 'aid', 'id');
    }

    /**
     * author: カ シュンヨウ
     * description: 文章关联点赞(一对多)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function like()
    {
        return $this->hasMany(Like::class, 'aid', 'id');
    }

    /**
     * author: カ シュンヨウ
     * description: 文章关联收藏(一对多)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function store()
    {
        return $this->hasMany(Store::class, 'aid', 'id');
    }

    /**
     * author: カ シュンヨウ
     * description: 文章关联点评(一对多)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment()
    {
        return $this->hasMany(Comment::class, 'aid', 'id');
    }

    /**
     * author: カ シュンヨウ
     * description: 文章关联标签(多对多关系)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->hasOne(Tags::class, 'aid', 'id');
    }

    /**
     * author: カ シュンヨウ
     * description: 文章关联分类(多对多关系)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->hasOne(Categories::class, 'aid', 'id');
    }

    /**
     * author: カ シュンヨウ
     * description: 文章关联用户(反向一对多或者说一对一也可以)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

}
