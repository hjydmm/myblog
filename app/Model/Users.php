<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use App\Model\Article;
use App\Model\ArticleRelate;
use App\Model\Like;
use App\Model\Store;
use App\Model\Comment;
use App\Model\Attend;


class Users extends BaseModel implements \Illuminate\Contracts\Auth\Authenticatable
{
    protected $table = 'users';

    use Authenticatable;
    /**
     * author: カ シュンヨウ
     * description: 关联文章article(一对多)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }

    /**
     * author: カ シュンヨウ
     * description: 关联文章附加信息article_relate(远程一对多)
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function article_relate()
    {
        return $this->hasManyThrough(ArticleRelate::class, Article::class, 'user_id', 'aid', 'id', 'id');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'user_id', 'id');
    }

    public function store()
    {
        return $this->hasMany(Store::class, 'user_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class,'user_id', 'id');
    }

    public function attend()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}
