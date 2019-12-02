<?php

namespace App\Model;


class Like extends BaseModel
{
    protected $table = 'like';

    public function articles()
    {
        return $this->belongsTo(Article::class, 'aid', 'id');
    }

}
