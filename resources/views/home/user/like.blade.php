@extends('layouts.user')
@section('title','いいね!')
@section('homePage','ホーム')
@section('userPage',"「 " . $user->user_name . " 」" . "の個人ページ")
@section('likePage','いいね!')

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
					@yield('likePage')
                </span>
			</div>
		</div>
	</header>

@endsection

@section('content')

	<div class="user-widget full-frame_like">

		@if(count($likeData) != 0)

		<div id="front-items" class="like_list" style="min-height: 600px;">
		@foreach ($likeData as $like)
			<li class="like_item" style="display: none;">
				<div style="margin-top: 10px;">
                    <span class="sub_title" style="background-color: {{ $like->articles->categories->color_categories }};">
                        {{ substr($like->articles->categories->str_categories, strripos($like->articles->categories->str_categories, ',')+1 ) }}
                    </span>
                    &nbsp;&nbsp;
                    <span>
                        <a href="{{ route('user.articleDetail', [ 'id'=>$like->aid ] ) }}">{{ $like->articles->title }} </a>
                    </span>
                    <span id="author_name">
                         &nbsp;&nbsp; -- {{ $like->articles->author }}
                    </span>
				</div>
			</li>
		@endforeach
		</div>

		<div class="pager">
			<span><button id="front_prev" onclick="front_previous_page(this)" disabled="disabled">前のページ</button></span>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span><button id="front_next" onclick="front_next_page(this)">次のページ</button></span>
		</div>

		@else
			<div style="padding: 30px 2px;font-size: 20px;">
				何もありません
			</div>
		@endif

	</div>

@endsection

@section('likeScript')
	<script>

		frontPage(10);

	</script>
@endsection
