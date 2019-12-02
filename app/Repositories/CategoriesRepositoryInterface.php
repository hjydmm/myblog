<?php


namespace App\Repositories;


interface CategoriesRepositoryInterface
{
    public function createCategories(array $data);

    public function updateCategories($aid, array $data);

    public function getAllCategories();

    public function deleteCategoriesById($aid);
}