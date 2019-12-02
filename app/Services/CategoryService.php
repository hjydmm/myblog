<?php


namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;


class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepository;
    protected $categoryList;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryList = $this->categoryRepository->getCategoryList();
    }

    /**
     * author: カ シュンヨウ
     * description: 展示不同层级的树形分类列表
     * @param int $fid
     * @param int $level
     * @param array $tree_menu
     * @return array
     */
    public function treeTypeCategoryList($fid = 0, $level = 0, &$tree_menu = [])
    {
        foreach ($this->categoryList as $key => $menu) {
            if ($menu->fid == $fid) {
                $menu->level = $level;
                $tree_menu[] = $menu;
                $tree_menu = array_merge($tree_menu, $this->treeTypeCategoryList($menu->id, $level+1));
                unset($this->categoryList[$key]);
            }
        }
        return $tree_menu;
    }

    public function getFirstLevelCategory()
    {
        return $this->categoryRepository->getCategoryList('fid', '0');
    }


    public function getCategoryById($id){
        return $this->categoryRepository->getCategoryById($id);
    }

    public function getCategoryByFid($id){
        return $this->categoryRepository->getCategoryByFid($id);
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepository->createCategoryGetId($data);
    }

    public function deleteCategoryById($id)
    {
        if($this->getCategoryByFid($id)){
            $fid_data = $this->categoryRepository->deleteCategoryByFid($id);
        }
        $id_data = $this->categoryRepository->deleteCategoryById($id);
        return $id_data;
    }

    public function updateCategory($category_id, array $data){

        return $this->categoryRepository->updateCategory($category_id, $data);
    }

    public function batchDeleteCategory(array $ids)
    {
        return $this->categoryRepository->batchDeleteCategory($ids);
    }
}