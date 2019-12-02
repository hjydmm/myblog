<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Request;
//use App\Http\Requests\AdvanceRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MemoController;
use Auth;

class IndexController extends Controller
{
    protected $memoController;

    public function __construct
    (
        MemoController $memoController
    )
    {
        $this->memoController = $memoController;
    }

    //后台首页
    public function index(){
        $admin_id =  Auth::guard('admin')->user()->id;
        $result =  $this->memoController->getMemosByAid($admin_id);
        return view('admin.index.index', compact('result'));
    }

    //登录页面
    public function login(){
        return view('admin.index.login');
    }

    //验证数据
    public function doLogin(Request $request){
        //规则
        $rule = [
            'username'   => 'required|min:5|max:15',
            'password'   => 'required|alpha_num|min:6|max:10',
        ];
        // 自定义消息
        $messages = [
            'username.required'   => 'ユーザー名を入力してください',
            'username.min'        => 'ユーザー名は少なくとも5文字が必要です',
            'username.max'        => 'ユーザー名は15文字以上含めることはできません',
            'password.required'   => 'パスワードを入力してください',
            'password.alpha_num'  => 'パスワードはアルファベットと数字のみ許可します',
            'password.min'        => 'パスワードは少なくとも6文字が必要です',
            'password.max'        => 'パスワードは10文字以上含めることはできません',
        ];
        //开始自动验证
        $this -> validate($request, $rule, $messages);
        //使用laravel的用户认证框架
        //guard需要在config/auth.php里面定义规则
        $data = $request -> only(['username','password']);
        //$data['status'] = '2'; //要求状态为启动的用户
        $result = Auth::guard('admin') -> attempt($data,$request -> has('remember'));
        //$result = Auth::guard('admin') -> attempt($data,$request -> get('remember'));
        // $result = Auth::guard('admin') -> attempt($data,false);
        //attempt的第二个参数如果传递个false的话记住我功能就不会触发。
        //auth认证成功就返回true,并且返回token给客户端
        //Auth把获取到的信息保存好在session中，所以可以用于页面回显。此时这个guard的auth对象admin就保存了这次登录的这个用户的所有信息，后面的中间件的middleware('auth:admin')就可以实现验证这个用户是否是登录过的用户了。
        //dd($result);
        if($result){
            //跳转到后台首页
            return redirect('/admin/index');
        }else{
            //跳转到登录页面
            //这里/admin/login是路由选择里面定义的路径
            return redirect('/admin/login') -> withErrors([
                'loginError'    =>	 'ユーザー名またはパスワードに間違いがあります'
            ]);
            //return view('admin.index.login');
        }
    }

    //退出页面
    public function logout(){
        //退出，这方法会清除用户session中的认证信息
        Auth::guard('admin') -> logout();

        //展示视图
        return redirect('/admin/login');
    }

}