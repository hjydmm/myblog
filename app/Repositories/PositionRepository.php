<?php


namespace App\Repositories;

use App\Model\Position;
use App\Model\Admin;
use App\Model\Auth as AdminAuth;  //为了区分在config里面定义好的Auth，这里最好重命名

class PositionRepository implements PositionRepositoryInterface
{
    protected static $position;
    //模型model的各种CRUD都写在repository里面，model里面只保留$table等字段以及与其他数据库关联的设置
    //对于数据库的操作，需要引入相关的model
    public function __construct(Position $position)
    {
        self::$position = $position;
    }

    /**
     * author: カ シュンヨウ
     * description: 创建一个新的position
     * @param array $obj_data
     * @return mixed
     */
    public function createPosition(array $obj_data){

        //insert是原生的插入语句，不会加上create_at和update_at。用create就可以。
        return self::$position::insert($obj_data);
    }

    /**
     * author: カ シュンヨウ
     * description: 更新一个已有的position
     * @param $position_id
     * @param array $data
     * @return mixed
     */
    public function updatePosition($position_id, array $data){

        return self::$position::where('id', '=', $position_id) -> update($data);
    }


}