<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Admin;

class Position extends Model
{
    //
    protected $table = 'position';
    public $timestamps = false;

    public function admin(){
        return $this->hasMany(Admin::class, 'position_id', 'id');
    }

}