@extends('layouts.userEdit')
@section('title','パスワードの変更')

@section('setPasswordStyle')
    <style>
    @if ($errors->has('old_password'))
    input.old_password::-webkit-input-placeholder {
            /* placeholder颜色  */
            color: rgba(246, 119, 119, 0.7)!important;
            font-weight: bold;
            /*!* placeholder字体大小  *!*/
            font-size: 18px;
            /*!* placeholder位置  *!*/
            /*text-align: right;*/
    }
    @endif
    @if ($errors->has('new_password'))
    input.new_password::-webkit-input-placeholder {
        /* placeholder颜色  */
        color: rgba(246, 119, 119, 0.7)!important;
        font-weight: bold;
        /*!* placeholder字体大小  *!*/
        font-size: 18px;
        /*!* placeholder位置  *!*/
        /*text-align: right;*/
    }
    @endif
    @if ($errors->has('confirm_new_password'))
    input.confirm_new_password::-webkit-input-placeholder {
            /* placeholder颜色  */
            color: rgba(246, 119, 119, 0.7)!important;
            font-weight: bold;
            /*!* placeholder字体大小  *!*/
            font-size: 18px;
            /*!* placeholder位置  *!*/
            /*text-align: right;*/
    }
    @endif
    </style>
@endsection


@section('content')
<div class="user-widget profile-item">
    <div class="inner-frame">
        <h3>パスワードの変更</h3><hr/>
        <form role="form" method="post" action="{{ route('user.confirmPassword',[ $id ]) }}">
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" class="form-control input-lg" id="email" value="{{ $user->email }}" name="email" disabled="disabled">
            </div>
           <div class="form-group">
                <label for="old_password">パスワード(旧)</label>
                <input type="password" class="form-control input-lg old_password" id="old_password" value="" name="old_password" placeholder="古いパスワードを入力してください" autocomplete="off">
            </div>           
            <div class="form-group">
                <label for="new_password">パスワード(新)</label>
                <input type="password" class="form-control input-lg new_password" id="new_password" value="" name="new_password" placeholder="新いパスワードを入力してください" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="email">パスワード(新)再確認</label>
                <input type="password" class="form-control input-lg confirm_new_password" id="confirm_new_password" value="" name="confirm_new_password" placeholder="新いパスワードをもう一回入力してください" autocomplete="off">
            </div>
            {{ csrf_field() }}
            <button class="profileEdit-button" type="submit">更新する</button>
        </form>
    </div>
</div>
@endsection

@section('setPasswordScript')

    <script>
        @if ($errors->has('old_password'))
        $(".old_password").attr("placeholder", "{{ $errors->first('old_password') }}");
        @endif
        @if ($errors->has('new_password'))
        $(".new_password").attr("placeholder", "{{ $errors->first('new_password') }}");
        @endif
        @if ($errors->has('confirm_new_password'))
        $(".confirm_new_password").attr("placeholder", "{{ $errors->first('confirm_new_password') }}");
        @endif
        @if ($errors->has('setPasswordError'))
        swal("パスワードエラー", "{{ $errors->first('setPasswordError') }}", "error");
        @endif
    </script>

@endsection