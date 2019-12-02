@extends('layouts.userEdit')
@section('title','个人信息编辑')

@section('content')
<div class="user-widget profile-item">
    <div class="inner-frame">
        <h3>個人情報の編集</h3><hr/>
        <form role="form" method="post" action="{{ route('user.updateUserInfo',[ $id ]) }}">
           <div class="form-group">
                <label for="uname">ニックネーム</label>
                <input type="text" class="form-control input-lg" id="uname" value="{{ $user->user_name }}" required name="user_name">
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" class="form-control input-lg" id="email" value="{{ $user->email }}" name="email">
            </div>
            <div class="form-group">
                <label for="gender">性別:&nbsp;</label>
                  <select name="gender" class="form-control input-lg">
                    <option value="1" @if($user->gender == 1) selected @endif>男</option>
                    <option value="2" @if($user->gender == 2) selected @endif>女</option>
                    <option value="3" @if($user->gender == 3) selected @endif>秘密</option>
                  </select>
            </div>
            <div class="form-group">
                <label for="city">都道府県</label>
                <input type="text" class="form-control input-lg" id="city" name="city" value="{{ $user->city }}">
            </div>
            <div class="form-group">
                <label for="github_name">Github ネーム</label>
                <input type="text" class="form-control input-lg" id="github_name" name="github_name" value="{{ $user->github_name }}">
            </div>
            <div class="form-group">
                <label for="github_home">Github ホームページ</label>
                <input type="text" class="form-control input-lg" id="github_home" name="github_homepage" value="{{ $user->github_homepage }}">
            </div>
            <div class="form-group">
                <label for="sign">アピール</label>
                <input type="text" class="form-control input-lg" id="sign" name="introduction" value="{{ $user->introduction }}">
            </div>
            {{ csrf_field() }}
            <button class="profileEdit-button" type="submit">送信</button>
        </form>
    </div>
</div>
@endsection