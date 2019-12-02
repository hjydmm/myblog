<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class LoginController extends Controller
{
    //登录页面
    public function login(){
        if(isset($_SERVER['HTTP_REFERER'])) {
            $before_login_page = $_SERVER['HTTP_REFERER'];
        }else {
            $before_login_page = $this->get_host();
        }
        //展示视图
        return view('home.index.login', compact("before_login_page"));
    }

    function get_host(){
        $scheme = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $url = $scheme.$_SERVER['HTTP_HOST'];
        return $url;
    }

    //验证数据
    public function doLogin(Request $request){
        //规则
        $rule = [
            'email'      => 'required|email',
            'password'   => 'required|alpha_num|min:6|max:10',
        ];
        // 自定义消息
        $messages = [
            'email.required'      => 'メールアドレスを入力してください',
            'email.email'         => 'メールアドレスのフォーマットが正しくありません',
            'password.required'   => 'パスワードを入力してください',
            'password.alpha_num'  => 'パスワードはアルファベットと数字のみ許可します',
            'password.min'        => 'パスワードは少なくとも6文字が必要です',
            'password.max'        => 'パスワードは10文字以上含めることはできません',
        ];
        //开始自动验证
        $this -> validate($request, $rule, $messages);
        $data = $request -> only(['email','password']);
        //获取登录前页面地址
        $before_login_page = $request -> get("before_login_page");
        if($before_login_page) {

            $request->session()->put('before_login_page',$before_login_page);
            $request->session()->save();
        }
        //$data['status'] = '1'; //要求状态为启动的用户
        $result = Auth::guard('home') -> attempt($data,$request -> has('remember'));
        if($result){
            //跳转到登录之前的页面
            //dd($request->session()->get("before_login_page"));
            header("location:" . Session::get("before_login_page"));
            //跳转到个人首页
            //return redirect()->route('user.page',['id' => Auth::guard('home')->user()->id]);

        }else{
            return redirect('/login') -> withErrors([
                'loginError'    =>	 'メールまたはパスワードに間違いがあります'
            ]);
        }
    }

    //退出页面
    public function logout(){
        //退出，这方法会清除用户session中的认证信息
        Auth::guard('home') -> logout();

        //展示视图
        return redirect('/');
    }
}

