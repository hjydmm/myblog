<?php


namespace App\Model;


class Categories extends BaseModel
{
    protected $table = 'categories';

    public function articles()
    {
        return $this->belongsTo(Article::class, 'aid', 'id');
    }
}