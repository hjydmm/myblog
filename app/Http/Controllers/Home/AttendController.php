<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Services\AttendServiceInterface;
use App\Traits\Response;

class AttendController extends BaseController
{

    use Response;

    protected $request;
    protected $attendService;


    public function __construct
    (
        Request $request,
        AttendServiceInterface $attendService
    )
    {
        $this->request = $request;
        $this->attendService = $attendService;
    }

    public function clickAttend()
    {
        $isAttendData = $this->request->only('user_id', 'attend_user_id');
        $attendData = $this->request->all();
        $result = $this->attendService->changeAttend($isAttendData, $attendData);
        return ($result['status']==true) ? $this->ajaxSuccess('', $result) : $this->ajaxError('发生未知错误');
    }
}
