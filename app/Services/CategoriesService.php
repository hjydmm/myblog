<?php


namespace App\Services;

use App\Repositories\CategoriesRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ArticleRepositoryInterface;
use App\Services\ArticleServiceInterface;


class CategoriesService implements CategoriesServiceInterface
{
    protected $categoriesRepository;
    protected $categoryRepository;
    protected $articleRepository;
    protected $articleService;

    public function __construct
    (
        CategoriesRepositoryInterface $categoriesRepository,
        CategoryRepositoryInterface $categoryRepository,
        ArticleRepositoryInterface $articleRepository,
        ArticleServiceInterface $articleService
    )
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->categoryRepository = $categoryRepository;
        $this->articleRepository = $articleRepository;
        $this->articleService = $articleService;
    }

    public function createCategories(array $data)
    {
        // 由于限制只能选一个分类，所以要添加父分类，父父分类
        $category = $this->categoryRepository->getCategoryById($data['ids_categories']);
        $data['color_categories'] = $category->color_code;
        $f_category = $this->categoryRepository->getCategoryById($category->fid);
        if($category->ffid){
            $ff_category = $this->categoryRepository->getCategoryById($category->ffid);

            $data['str_categories'] = $ff_category->name . ',' . $f_category->name . ',' . $category->name;
            $data['ids_categories'] = $category->ffid . ',' . $category->fid . ',' . $category->id;
        }else{
            $data['str_categories'] = $f_category->name . ',' . $category->name;
            $data['ids_categories'] = $category->fid . ',' . $category->id;
        }
        return $this->categoriesRepository->createCategories($data);
    }

    public function updateCategories($aid, array $data)
    {
        $category = $this->categoryRepository->getCategoryById($data['ids_categories']);
        //$category = $this->categoryRepository->getCategoryById($data['ids_categories']);
        $data['color_categories'] = $category->color_code;
        $f_category = $this->categoryRepository->getCategoryById($category->fid);
        if($category->ffid){
            $ff_category = $this->categoryRepository->getCategoryById($category->ffid);

            $data['str_categories'] = $ff_category->name . ',' . $f_category->name . ',' . $category->name;
            $data['ids_categories'] = $category->ffid . ',' . $category->fid . ',' . $category->id;
        }else{
            $data['str_categories'] = $f_category->name . ',' . $category->name;
            $data['ids_categories'] = $category->fid . ',' . $category->id;
        }
        return $this->categoriesRepository->updateCategories($aid, $data);
    }

    /**
     * author: カ シュンヨウ
     * description: 数组转换成字符串
     * @param array $array
     * @return string
     */
    public function arrayToString($glue, array $array)
    {
        $str = implode($glue, $array);
        return $str;
    }

    /**
     * author: カ シュンヨウ
     * description: 字符串转换成数组
     * @param $str
     * @return array
     */
    public function stringToArray($delimiter, $str)
    {
        $array = explode($delimiter, $str);
        return $array;
    }

    /**
     * author: カ シュンヨウ
     * description: 通过分类名获取所有有该分类名的文章
     * @param $category_name
     * @return array
     */
    public function getContainCategoryList($category_name)
    {
        $categoriesList = $this->categoriesRepository->getAllCategories();
        $containAids = array();
        foreach ($categoriesList as $categories) {
//            strpos($categories->str_categories, "/(?<,|)".$category_name. "(?=,|)/") !== false
            if(preg_match('/(?<![a-zA-Z0-9])'.$category_name.'(?![a-zA-Z0-9])/', $categories->str_categories)){
                $containAids[] = $categories->aid;
            }
        }
        return $this->articleRepository->getArticlesPageByIds(ArticleService::PASS_STATUS, $containAids);
    }

    public function deleteCategoriesById($aid)
    {
        return $this->categoriesRepository->deleteCategoriesById($aid);
    }

//    public function checkContainCategory($str_category, $category_name)
//    {
//        $contain_full = ',' . $category_name . ',';
//        $contain_left = ',' . $category_name;
//        $contain_right = $category_name . ',';
//
//        if((strpos($str_category, $contain_left)||strpos($str_category, $contain_right)||strpos($str_category, $contain_full)) !== false){
//            return true;
//        }else{
//            return false;
//        }
//    }


}