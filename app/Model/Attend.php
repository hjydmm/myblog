<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    //关注的用户
    protected $table = 'attend';

    public function users()
    {
        //被关注用户对应一个users表的用户信息
        return $this->belongsTo(Users::class, 'attend_user_id', 'id');
    }
}
