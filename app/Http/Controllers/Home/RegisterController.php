<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\Request;
use App\Http\Controllers\Controller;
use App\Model\Users;
use Auth;
use Session;

class RegisterController extends Controller
{
    //登录页面
    public function register(){
        if(isset($_SERVER['HTTP_REFERER'])) {
            $before_register_page = $_SERVER['HTTP_REFERER'];
        }else {
            $before_register_page = $this->get_host();
        }
        //展示视图
        return view('home.index.register', compact("before_register_page"));
    }

    function get_host(){
        $scheme = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $url = $scheme.$_SERVER['HTTP_HOST'];
        return $url;
    }

    //验证数据
    public function doRegister(Request $request){
        try{
            //规则
            $rule = [
                'user_name' => 'required|min:2|max:15',
                'email' => 'required|email|max:30|unique:users',
                'password' => 'required|min:6|max:10|alpha_num'
            ];
            // 自定义消息
            $messages = [
                'user_name.required' => 'ユーザー名を入力してください',
                'user_name.min'      => 'ユーザー名は少なくとも2文字が必要です',
                'user_name.max'      => 'ユーザー名は15文字以上含めることはできません',
                'email.required'=> 'メールアドレスを入力してください',
                'email.email'   => 'メールアドレスのフォーマットが正しくありません',
                'email.max'     => 'メールは30文字以上含めることはできません',
                'email.unique'  => 'このメールアドレスはすでに存在します',
                'password.required' => 'パスワードを入力してください',
                'password.min'  => 'パスワードは少なくとも6文字が必要です',
                'password.max'  => 'パスワードは10文字以上含めることはできません',
                'password.alpha_num'  => 'パスワードはアルファベットと数字のみ許可します',
            ];
            //开始自动验证
            $this -> validate($request, $rule, $messages);

            $user_name = $request->input('user_name');
            $email = $request->input('email');
            $password = $request->input('password');

            $user = new Users();
            $user->user_name = $user_name;
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->created_at = date('Y-m-d H:i:s');
            $user->avatar = "/assets/images/avatars/avatar_0" . rand(1, 8) . ".jpg";
            $user->save();


            //获取注册前页面地址
            $before_register_page = $request -> get("before_register_page");

            if($before_register_page) {

                $request->session()->put('before_register_page',$before_register_page);
                $request->session()->save();
            }

            //Auth::login($user); // 注册的用户让其进行登陆状态

            $result = Auth::guard('home') -> attempt(['email'=>$email, 'password'=>$password]);

            if($result) {
                //dd(Session::get("before_register_page"));
                //跳转到登录之前的页面
                header("location:" . Session::get("before_register_page"));
                //return redirect('/');
                //return redirect()->route('user.page',['id' => Auth::guard('home')->user()->id]);
            }

        }catch (ValidationException $validationException){
            $message = $validationException->validator->getMessageBag()->first();
            return $message;
        }
    }
}
