<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
use App\Services\CategoryServiceInterface;
use App\Traits\Response;

class CategoryController
{
    use Response;

    protected $request;
    protected $categoryService;

    public function __construct(Request $request, CategoryServiceInterface $categoryService)
    {
        $this->request = $request;
        $this->categoryService = $categoryService;
    }

    /**
     * author: カ シュンヨウ
     * description: 获取树形分类列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->categoryService->treeTypeCategoryList();
        return view('admin.articles.category.index', compact('data'));
    }

    public function getCategoryById(){

        $id = $this->request->get('id');
        $data = $this->categoryService->getCategoryById($id)->toArray();
        return $data ? $this->ajaxSuccess('', $data) : $this->ajaxError('', $data);
    }

    public function deleteCategoryById(){

        $id = $this->request->get('id');
        $data = $this->categoryService->deleteCategoryById($id);
        return $data ? $this->ajaxSuccess('削除は成功しました') : $this->ajaxError('削除は失敗しました');
    }

    public function updateCategory(){

        $id = $this->request->get('id');
        $data = $this->request->only('fid', 'ffid', 'name', 'weight', 'code', 'color_code');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->categoryService->updateCategory($id, $data);
        $data['id'] = $id;
        return $result ? $this->ajaxSuccess('編集は成功しました', $data) : $this->ajaxError('編集は失敗しました');
    }

    public function createCategory(){
        $data = $this->request->all();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $id = $this->categoryService->createCategory($data);
        $data['id'] = $id;
        return $id ? $this->ajaxSuccess('新規カテゴリーの作成は成功しました', $data) : $this->ajaxError('新規カテゴリーの作成は失敗しました');
    }

    public function optionCategory(){
        $up_id = $this->request->get('id');
        $data = $this->categoryService->getCategoryByFid($up_id)->toArray();
        return $data ? $this->ajaxSuccess('', $data) : $this->ajaxError('', $data);
    }
}