<?php

namespace App\Model;

class Store extends BaseModel
{
    //
    protected $table = 'store';

    public function articles()
    {
        return $this->belongsTo(Article::class, 'aid', 'id');
    }

}
