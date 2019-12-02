<?php


namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
use App\Services\MemoServiceInterface;
use App\Traits\Response;
use Auth;

class MemoController
{
    use Response;

    protected $request;
    protected $memoService;

    public function __construct(Request $request, MemoServiceInterface $memoService)
    {
        $this->request = $request;
        $this->memoService = $memoService;
    }

    public function getMemosByAid($admin_id)
    {
        $result = $this->memoService->getMemosByAid($admin_id);
        if(!$result) {
            $data = ['admin_id' => $admin_id, 'content' => '', 'content_future' => ''];
            $this->createMemo($data);
        }else {
            return $result;
        }
    }

    public function createMemo(array $data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->memoService->createMemo($data);
        return $result;
    }

    public function updateMemo(){

        $admin_id = $this->request->get('admin_id');
        $data = $this->request->only('content', 'content_future');
        $result = $this->memoService->updateMemo($admin_id, $data);
        return $result;
    }
}