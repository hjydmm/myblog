<?php


namespace App\Repositories;


interface CategoryRepositoryInterface
{
    public function getCategoryList($where = null);

    public function getCategoryById($id);
}