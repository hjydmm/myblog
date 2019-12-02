<?php

namespace App\Repositories;

use App\Model\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected static $category;
    
    public function __construct(Category $category)
	{
	    self::$category = $category;
    }

    /**
     * author: カ シュンヨウ
     * description: 获取分类列表(通过传入不同的where条件可以获取不同层级的分类列表)
     * @param null $where
     * @return mixed
     */
    public function getCategoryList($where = null)
    {
        return self::$category::where($where ? : [])
            ->select('id', 'fid', 'ffid', 'name', 'code', 'color_code', 'weight')
            ->orderBy('weight','DESC')
            ->get();
    }

    public function getCategoryById($id)
    {
        return self::$category::where('id', '=', $id)
            ->first();
    }

    public function getCategoryByFid($id)
    {
        return self::$category::where('fid', '=', $id)
            ->get();
    }

    public function createCategory(array $data)
    {
        return self::$category->insert($data);
    }

    public function createCategoryGetId(array $data)
    {
        $id = self::$category->insertGetId($data);
        return $id;
    }

    public function deleteCategoryById($id)
    {
        //知道主键的话可以直接用destroy($id)方法，而不需要先find($id)，然后delete()
        return self::$category::destroy($id);
    }
    public function deleteCategoryByFid($id)
    {
        return self::$category::where('fid', '=', $id) -> delete();
    }

    public function batchDeleteCategory(array $ids)
    {
        return self::$category::destroy($ids);
    }

    public function updateCategory($category_id, array $data){

        return self::$category::where('id', '=', $category_id) -> update($data);
    }
}

