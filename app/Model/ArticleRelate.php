<?php

namespace App\Model;
use App\Model\Article;
use App\Model\Users;

class ArticleRelate extends BaseModel
{

    protected $table = 'article_relate';

    /**
     * author: カ シュンヨウ
     * description: 通过文章附加关联指定文章(一对一)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function articles()
    {
        return $this->belongsTo(Article::class, 'aid', 'id');
    }

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

}
