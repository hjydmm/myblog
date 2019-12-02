<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
use App\Services\TagServiceInterface;
use App\Traits\Response;

class TagController
{
    use Response;

    protected $request;
    protected $tagService;

    public function __construct(Request $request, TagServiceInterface $tagService)
    {
        $this->request = $request;
        $this->tagService = $tagService;
    }


    public function index()
    {
        $data = $this->tagService->getAllTag();
        return view('admin.articles.tag.index', compact('data'));
    }

    public function index_test()
    {
        $data = $this->tagService->getAllTag();
        return view('admin.articles.tag.index_test', compact('data'));
    }

    public function getTagById(){

        $id = $this->request->get('id');
        $data = $this->tagService->getTagById($id)->toArray();
        return $data ? $this->ajaxSuccess('', $data) : $this->ajaxError('', $data);
    }

    public function deleteTagById(){

        $id = $this->request->get('id');
        $data = $this->tagService->deleteTagById($id);
        return $data ? $this->ajaxSuccess('削除は成功しました') : $this->ajaxError('削除は失敗しました');
    }

    public function updateTag(){

        $id = $this->request->get('id');
        $data = $this->request->only('name', 'index', 'weight');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->tagService->updateTag($id, $data);
        $data['id'] = $id;
        return $result ? $this->ajaxSuccess('編集は成功しました', $data) : $this->ajaxError('編集は失敗しました');
    }

    public function createTag(){
        $data = $this->request->all();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $id = $this->tagService->createTag($data);
        $data['id'] = $id;
        return $id ? $this->ajaxSuccess('新規タグの作成は成功しました', $data) : $this->ajaxError('新規タグの作成は失敗しました');
    }
}