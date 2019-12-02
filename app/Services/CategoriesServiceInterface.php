<?php


namespace App\Services;


interface CategoriesServiceInterface
{
    public function createCategories(array $data);

    public function updateCategories($aid, array $data);

    public function arrayToString($glue, array $array);

    public function stringToArray($delimiter, $str);

    public function getContainCategoryList($category_name);

    public function deleteCategoriesById($id);

//    public function checkContainCategory($str_category, $category_name);
}