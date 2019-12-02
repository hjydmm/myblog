<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Services\StoreServiceInterface;
use App\Traits\Response;

class StoreController extends BaseController
{
    //
    use Response;

    protected $request;
    protected $storeService;


    public function __construct
    (
        Request $request,
        StoreServiceInterface $storeService
    )
    {
        $this->request = $request;
        $this->storeService = $storeService;
    }


    public function clickStore()
    {
        $aid = $this->request->get('aid');
        $isStoreData = $this->request->only('aid', 'user_id');
        $storeData = $this->request->only('aid', 'user_id', 'created_at');
        $result = $this->storeService->changeStoreAndUpdateNumber($aid, $isStoreData, $storeData);
        return ($result['status']==true) ? $this->ajaxSuccess('', $result) : $this->ajaxError('发生未知错误');
    }

}
