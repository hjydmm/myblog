@extends('layouts.userEdit')
@section('title','アカウント')

@section('content')
    <div class="user-widget profile-item">
        <div class="inner-frame">
            <h3>プロフィール</h3><hr/>

            <div class="profile-info">
                <div class="info-part">
                    <div class="alert alert-success">
                        <label for="user_name">ユーザーネーム</label>
                        <span id="user_name">{{ $user->user_name }}</span>
                    </div>
                </div>
                <div class="info-part">
                    <div class="alert alert-warning">
                        <label for="email">メールアドレス</label>
                        <span id="email">{{ $user->email }}</span>
                    </div>
                </div>
                <div class="info-part">
                    <div class="alert alert-info">
                        <label for="gender">性別</label>
                        @if($user->gender == '1')
                        <span id="gender">男</span>
                        @elseif($user->gender == '2')
                        <span id="gender">女</span>
                        @else
                        <span id="gender">秘密</span>
                        @endif
                    </div>
                </div>
                <div class="info-part">
                    <div class="alert alert-danger">
                        <label for="city">都道府県</label>
                        <span id="city">{{ $user->city }}</span>
                    </div>
                </div>
                <div class="info-part">
                    <div class="alert alert-success">
                        <label style="font-size: 20px;">Github</label><hr/>
                        <label for="github_name">ネーム</label>
                        <span id="github_name">{{ $user->github_name }}</span><hr/>
                        <label for="github_homepage">個人ページ</label>
                        <span id="github_homepage"><a href="{{ $user->github_homepage }}" target="_blank">{{ $user->github_homepage != "javascript:void(0);" ? $user->github_homepage : "未記入" }}</a></span>
                    </div>
                </div>
                <div class="info-part">
                    <div class="alert alert-warning">
                        <label style="font-size: 20px;">アピール</label><hr/>
                        <span id="github_name">{{ $user->introduction }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
