<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    // 定义一些基础的全局常量
    const NORMAL_STATUS = 1;
    const DELETE_STATUS = 2;
    const LIMIT         = 5;

    /**
     * author: カ シュンヨウ
     * description: 所有模型继承BaseModel，使用with时随自己喜欢的想关联的字段查询出来，可避免全部查询出来
     * @param $query
     * @param $relation
     * @param array $columns
     * @return mixed
     */
    public function scopeWithOnly($query, $relation, Array $columns)
    {
        //array_merge()方法：一个或多个数组合并成一个数组
        return $query->with([$relation => function ($query) use ($columns){
            $query->select(array_merge(['id'], $columns));
        }]);
    }
}