<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use Config;
//use App\Repositories\UsersRepository;
use App\Services\UsersServiceInterface;
use App\Traits\Response;

use Storage;
use Auth;

class FileController extends BaseController
{
    use Response;
    //
    protected $request;
    protected $usersService;

    public function __construct(Request $request, UsersServiceInterface $usersService)
    {
        $this->request = $request;
        $this->usersService = $usersService;
    }

    public function uploadAvatar()
    {
        $id = Auth::guard('home')->user()->id;
        if($this->request -> hasFile('file') && $this->request -> file('file') -> isValid()){
            $filename = sha1(time() . $this->request -> file('file') -> getClientOriginalName()) . '.' . $this->request -> file('file') -> getClientOriginalExtension();
            Storage::disk('images') -> put($filename, file_get_contents($this->request->file('file')->path()));

            $path = Config::get('filesystems.disks.images.path') . '/' . $filename;

            if (!$this->usersService->updateUser($id, ['avatar' => $path])) {
                return $this->ajaxError('上传失败');
            }
            return $this->ajaxSuccess('上传成功', ['path'=>$path]);
        } else {
            return $this->ajaxError('请选择上传的头像');
        }



        // //dd('有问题');die;
        // if ($request->hasFile('file')) {
        //     //dd('有问题');die;
        //     $user = $request->user('home');
        //     $image = Config::get('home.image');
            
        //     if (!in_array($request->file('file')->extension(), $image['type'])) {
        //         $this->ajaxError('头像类型不符合, 只允许' . implode(',', $image['type']));
        //     }
            
        //     $path = $request->file('file')->store('avatar');
            
        //     $avatar = Config::get('filesystems.disks.images.path') . '/' . $path;
            
        //     if (!$user->update(['id' => $user->id, 'avatar' => $avatar])) {
        //         return $this->ajaxError('上传失败');
        //     }
           
        //     $user->avatar = $avatar;
        //     return $this->ajaxSuccess('上传成功');
        // } else {
        //     return $this->ajaxError('请选择上传的头像');
        // }
    }
}

