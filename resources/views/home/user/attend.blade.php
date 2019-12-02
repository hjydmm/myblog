@extends('layouts.user')
@section('title','フォロー中')
@section('homePage','ホーム')
@section('userPage',"「 " . $user->user_name . " 」" . "の個人ページ")
@section('attendPage','フォロー中')

@section('navList')

	<header id="user-header" class="nav-list">
		<div class="container">
			<div id="nav_list_item">
				<a id="returnHome" href="http://myblog.com">
					@yield('homePage')
				</a>
				&nbsp;
				<i class="fa fa-angle-right"></i>
				&nbsp;
				<a id="userPage" href="{{ url('user', ['id' => $user->id ]) }}">
					@yield('userPage')
				</a>
				&nbsp;
				<i class="fa fa-angle-right"></i>
				&nbsp;
				<span>
                    @yield('attendPage')
                </span>
			</div>
		</div>
	</header>

@endsection

@section('content')

<div class="user-widget full-frame_attend">

	@if(count($attendData) != 0)

	@foreach ($attendData as $attend)
		<li class="attend_item clearfix" style="">
			<div class="col-md-1 col-sm-12 left-avatar">
				<div>
					<div style="background:url('{{ $attend->users->avatar }}') no-repeat center / cover" class="thumbnail"></div>
				</div>
			</div>
			<div class="col-md-11 col-sm-12 right-name">
				-- <a href="{{ route('user.share',[ $attend->attend_user_id ]) }}">{{ $attend->users->user_name }}</a>
			</div>
		</li>
	@endforeach

	@else
		<div style="padding: 30px 2px;font-size: 20px;">
			何もありません
		</div>
	@endif
</div>

@endsection

