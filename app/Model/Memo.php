<?php

namespace App\Model;


class Memo extends BaseModel
{
    protected $table = 'memo';

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

}