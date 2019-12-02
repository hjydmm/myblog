<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
use App\Services\UsersServiceInterface;
use App\Traits\Response;

class UsersController extends BaseController
{
    use Response;
    //
    protected $request;
    protected $usersRequest;
    protected $usersService;

    public function __construct(Request $request, UsersServiceInterface $usersService)
    {
        $this->request = $request;
        $this->usersService = $usersService;
    }

    /**
     * author: カ シュンヨウ
     * description: 展示用户列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $data = $this->usersService->getUsersList();
        return view('admin.users.index',compact('data'));
    }

    /**
     * author: カ シュンヨウ
     * description: 根据id查找用户信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserById(){

        $id = $this->request->get('id');
        $data = $this->usersService->getUserById($id)->toArray();
        return $data ? $this->ajaxSuccess('', $data) : $this->ajaxError('', $data);
    }

    public function deleteUserById(){

        $id = $this->request->get('id');
        $data = $this->usersService->deleteUserById($id);
        return $data ? $this->ajaxSuccess('删除成功') : $this->ajaxError('删除失败');
    }

    public function updateUser(){

        $id = $this->request->get('id');
        $data = $this->request->only('username', 'mobile', 'email', 'position_id', 'status', 'gender');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->adminService->updateAdmin($id, $data);
        return $result ? $this->ajaxSuccess('编辑成功', $data) : $this->ajaxError('编辑失败');
    }

    public function status_start(){

        $id = $this->request->get('id');
        $data = array('status' => '1');
        $result = $this->usersService->updateUser($id, $data);
        return $result ? $this->ajaxSuccess('开启用户成功', ['id'=> $id]) : $this->ajaxError('开启用户失败');
    }

    public function status_stop(){

        $id = $this->request->get('id');
        $data = array('status' => '2');
        $result = $this->usersService->updateUser($id, $data);
        return $result ? $this->ajaxSuccess('禁用用户成功', ['id'=> $id]) : $this->ajaxError('禁用用户失败');
    }

    public function createUser(){
        $data = $this->request->all();
        $data['password'] = bcrypt($data['password']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['avatar'] = "/assets/images/avatars/avatar_0" . rand(1, 6) .".jpg";
        $result = $this->usersService->createUser($data);
        $data['id'] = $id;
        return $result ? $this->ajaxSuccess('添加用户成功', $data) : $this->ajaxError('添加用户失败');
    }



}

