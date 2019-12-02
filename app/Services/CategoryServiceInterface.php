<?php


namespace App\Services;


interface CategoryServiceInterface
{
    public function treeTypeCategoryList($fid = 0, $level = 0, &$tree_menu = []);

    public function getFirstLevelCategory();
}