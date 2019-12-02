<?php


namespace App\Services;


interface IndexServiceInterface
{
    public function getContainCategoryOrTagList($categoryOrTag_name);
}