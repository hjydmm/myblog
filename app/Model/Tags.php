<?php

namespace App\Model;

use App\Model\Article;

class Tags extends BaseModel
{

    protected $table = 'tags';

    public function articles()
    {
        return $this->belongsTo(Article::class, 'aid', 'id');
    }
}
