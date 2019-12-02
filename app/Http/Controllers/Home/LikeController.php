<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Services\LikeServiceInterface;
use App\Traits\Response;

class LikeController extends BaseController
{
    use Response;

    protected $request;
    protected $likeService;


    public function __construct
    (
        Request $request,
        LikeServiceInterface $likeService
    )
    {
        $this->request = $request;
        $this->likeService = $likeService;
    }

    public function clickLike()
    {
        $aid = $this->request->get('aid');
        $isLikeData = $this->request->only('aid', 'user_id');
        $likeData = $this->request->only('aid', 'user_id', 'created_at');
        $result = $this->likeService->changeLikeAndUpdateNumber($aid, $isLikeData, $likeData);
        return ($result['like_status']==true) ? $this->ajaxSuccess('', $result) : $this->ajaxError('发生未知错误', [ 'like_status'=>false, 'judge'=>'error' ]);
    }
}
