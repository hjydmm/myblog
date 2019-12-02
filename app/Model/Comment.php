<?php

namespace App\Model;

use App\Model\Article;

class Comment extends BaseModel
{

    protected $table = 'comments';

    public function articles()
    {
        return $this->belongsTo(Article::class, 'aid', 'id');
    }

}
