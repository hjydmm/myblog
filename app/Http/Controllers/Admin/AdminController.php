<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
use App\Services\AdminServiceInterface;
use App\Traits\Response;
use Hash;

class AdminController extends BaseController
{
    use Response;
    //
    protected $request;
    protected $adminRequest;
    protected $adminService;

    public function __construct(Request $request, AdminServiceInterface $adminService)
    {
        $this->request = $request;
        $this->adminService = $adminService;
    }

    /**
     * author: カ シュンヨウ
     * description: 展示管理员列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $data = $this->adminService->getAdminList();
        return view('admin.admin.index',compact('data'));
    }

    public function index2(){

        $data = $this->adminService->getAdminList();
        return $data->toJson();
    }

    /**
     * author: カ シュンヨウ
     * description: 根据id查找管理员信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAdminById(){

        $id = $this->request->get('id');
        $data = $this->adminService->getAdminById($id)->toArray();
        return $data ? $this->ajaxSuccess('', $data) : $this->ajaxError('', $data);
    }

    public function deleteAdminById(){

        $id = $this->request->get('id');
        $data = $this->adminService->deleteAdminById($id);
        return $data ? $this->ajaxSuccess('削除は成功しました') : $this->ajaxError('削除は失敗しました');
    }

    public function updateAdmin(){

        $id = $this->request->get('id');
        $data = $this->request->only('username', 'mobile', 'email', 'position_id', 'status', 'gender');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $result = $this->adminService->updateAdmin($id, $data);
        $data['id'] = $id;
        return $result ? $this->ajaxSuccess('修正は成功しました', $data) : $this->ajaxError('修正は失敗しました');
    }

    public function createAdmin(){
        $data = $this->request->all();
        $data['password'] = bcrypt($data['password']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $id = $this->adminService->createAdmin($data);
        $data['id'] = $id;
        return $id ? $this->ajaxSuccess('新規アカウント作成は成功しました', $data) : $this->ajaxError('新規アカウント作成は失敗しました');
    }

    public function status_start(){

        $id = $this->request->get('id');
        $data = array('status' => '1');
        $result = $this->adminService->updateAdmin($id, $data);
        return $result ? $this->ajaxSuccess('ステータスはオンしました', ['id'=> $id]) : $this->ajaxError('オンは失敗しました');
    }

    public function status_stop(){

        $id = $this->request->get('id');
        $data = array('status' => '2');
        $result = $this->adminService->updateAdmin($id, $data);
        return $result ? $this->ajaxSuccess('ステータスはオフしました', ['id'=> $id]) : $this->ajaxError('オフは失敗しました');
    }


    public function changeAdminPassword()
    {

        $id = $this->request->get('id');

        $admin = $this->adminService->getAdminById($id);
        $password = $admin[0]->password;
        $passwordData = $this->request -> only('old_password', 'new_password', 'confirm_new_password');
        $old_password = $passwordData['old_password'];
        $new_password = $passwordData['new_password'];
        $confirm_new_password = $passwordData['confirm_new_password'];
        if (!Hash::check($old_password, $password)) {
            $data = [];
            $data["password"] = $password;
            return $this->ajaxError('入力した古いパスワードは現在のパスワードと一致しません', $data);

        }
        if (!($new_password === $confirm_new_password)) {
            return $this->ajaxError('入力した新しいパスワードは再入力のパスワードと一致しません');
        }
        $re_coded_password = bcrypt($new_password);
        $result = $this->adminService->updateAdmin($id, ['password' => $re_coded_password]);
        if($result){
            return $this->ajaxSuccess('パスワードを更新しました');
        }else{
            return $this->ajaxError('パスワードの更新はエラーが発生しました');
        }
    }
}
