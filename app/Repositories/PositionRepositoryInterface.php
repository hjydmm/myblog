<?php


namespace App\Repositories;


interface PositionRepositoryInterface
{
    public function createPosition(array $obj_data);

    public function updatePosition($position_id, array $data);
}