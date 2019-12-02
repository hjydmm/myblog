<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
use App\Services\LinksServiceInterface;
use App\Traits\Response;

class LinksController extends BaseController
{
    use Response;

    protected $request;
    protected $linksService;

    public function __construct(Request $request, LinksServiceInterface $linksService)
    {
        $this->request = $request;
        $this->linksService = $linksService;
    }

    public function index()
    {
        $data = $this->linksService->getAllLinks();
        return view('admin.links.index', compact('data'));
    }

    public function getLinkById(){

        $id = $this->request->get('id');
        $data = $this->linksService->getLinkById($id)->toArray();
        return $data ? $this->ajaxSuccess('', $data) : $this->ajaxError('', $data);
    }

    public function deleteLinkById(){

        $id = $this->request->get('id');
        $data = $this->linksService->deleteLinkById($id);
        return $data ? $this->ajaxSuccess('削除は成功しました') : $this->ajaxError('削除は失敗しました');
    }

    public function updateLink(){

        $id = $this->request->get('id');
        $data = $this->request->only('title', 'url', 'weight', 'show');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->linksService->updateLink($id, $data);
        $data['id'] = $id;
        return $result ? $this->ajaxSuccess('編集は成功しました', $data) : $this->ajaxError('編集は失敗しました');
    }

    public function createLink(){
        $data = $this->request->all();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $id = $this->linksService->createLink($data);
        $data['id'] = $id;
        return $id ? $this->ajaxSuccess('新規リンクの作成は成功しました', $data) : $this->ajaxError('新規リンクの作成は失敗しました');
    }


}
