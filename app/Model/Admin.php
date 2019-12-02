<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//引入trait(php5.4新特性)
use Illuminate\Auth\Authenticatable;
use App\Model\Position;

class Admin extends BaseModel implements \Illuminate\Contracts\Auth\Authenticatable
{
    //定义当前模型需要关联的数据表
    protected $table = 'admin';

    //使用trait，相当于将整个trait代码段复制到这个位置
    //提高代码的复用性
    //这个trait,是\lluminate\Contracts\Auth\Authenticatable抽象类的6个方法的实现
    use Authenticatable;

    //定义与角色模型的关联操作
    //站在管理员表的角度，与角色表是1对1关系
    public function position(){
        return $this -> belongsTo(Position::class, 'position_id', 'id');
    }
}