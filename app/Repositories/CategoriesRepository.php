<?php


namespace App\Repositories;

use App\Model\Categories;


class CategoriesRepository implements CategoriesRepositoryInterface
{
    protected static $categories;

    public function __construct(Categories $categories)
    {
        self::$categories = $categories;
    }

    /**
     * author: カ シュンヨウ
     * description: 新建文章的同时插入分类数据
     * @param array $data
     * @return mixed
     */
    public function createCategories(array $data)
    {
        return self::$categories->insert($data);
    }

    public function updateCategories($aid, array $data)
    {
        $result = self::$categories::where('aid', '=', $aid)->update($data);
        return $result;
    }

    public function getAllCategories()
    {
        return self::$categories->get();
    }

    public function deleteCategoriesById($aid)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
        return self::$categories::where('aid', '=', $aid)
            ->delete();
    }
}