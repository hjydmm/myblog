<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AdvanceRequest extends Request
{

    /**
     * author: カ シュンヨウ
     * description: admin数据的验证规则
     * @return array
     */
    public function rules()
    {
        return [
            'username'            => 'required|min:5|max:15',
            'password'            => 'required|alpha_num|min:6|max:10',
            'mobile'              => 'nullable|numeric',
            'register_email'      => 'required|email|unique:admin,email',
            'email'               => 'required|email',
        ];
    }

    /**
     * author: カ シュンヨウ
     * description: 验证不通过时的提示信息
     * @return array
     */
    public function messages()
    {
        return [
            'username.required'   => 'ユーザー名を入力してください',
            'username.min'        => 'ユーザー名は少なくとも5文字が必要です',
            'username.max'        => 'ユーザー名は15文字以上含めることはできません',
            'email.required'      => 'メールアドレスを入力してください',
            'email.unique'        => 'このメールアドレスはすでに存在します',
            'email.email'         => 'メールアドレスのフォーマットが正しくありません',
            'password.required'   => 'パスワードを入力してください',
            'password.alpha_num'  => 'パスワードはアルファベットと数字のみ許可します',
            'password.min'   => 'パスワードは少なくとも6文字が必要です',
            'password.max'   => 'パスワードは10文字以上含めることはできません',
            'mobile.numeric'   => '電話番号は数字のみ許可します',
        ];
    }
}
