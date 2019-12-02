@extends('layouts.main')

@section('style')
    @yield('setPasswordStyle')
@endsection

@section('main')
<section id="content">
    <div class="container">


        <div class="left-content col-md-3">
            <div class="user-widget user-account">
                <div class="edit-content">
                    <div class="info-edit">
                        <a href="{{ route('user.account',[ $id ]) }}">
                            <span class="">
                                <i class="fa fa-user"></i>
                                プロフィール
                            </span>
                        </a>
                    </div>
                    <div class="info-edit">
                        <a href="{{ route('user.edit',[ $id ]) }}">
                            <span class="">
                                <i class="fa fa-pencil-square-o"></i>
                                個人情報の編集
                            </span>
                        </a>
                    </div>
                    <div class="info-edit">
                        <a href="{{ route('user.setAvatar',[ $id ]) }}">
                            <span class="">
                                <i class="fa fa-github-alt"></i>
                                アバター写真
                            </span>
                        </a>
                    </div>
                    <div class="info-edit">
                        <a href="{{ route('user.setPassword',[ $id ]) }}">
                            <span class="">
                                <i class="fa fa-key fa-fw"></i>
                                パスワード変更
                            </span>
                        </a>
                    </div>
                    {{--@if (Auth::guard('home')->user()->type == 1)--}}
                    {{--<div class="info-edit">--}}
                        {{--<a href="{{ url('user/activation') }}">--}}
                            {{--<span class="">--}}
                                {{--<i class="fa fa-envelope-o fa-fw"></i>--}}
                                {{--邮箱激活--}}
                            {{--</span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--@endif--}}
                </div><!-- edit-content -->
            </div><!-- user-widget -->
        </div><!-- left-content -->

        <div class="right-content col-lg-9 col-md-9">
            @yield('content')
        </div><!-- right-content -->

    </div><!-- container -->
</section>
@endsection

@section('script')

    @yield('setPasswordScript')
    @yield('editScript')

@endsection

