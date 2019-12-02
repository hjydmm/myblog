@extends('layouts.user')
@section('title','コメント')
@section('homePage','ホーム')
@section('userPage',"「 " . $user->user_name . " 」" . "の個人ページ")
@section('commentPage','コメント')

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
					@yield('commentPage')
                </span>
			</div>
		</div>
	</header>

@endsection

@section('content')

<div class="user-widget full-frame_comment">

	@if(count($commentData) != 0)

		<div id="front-items" class="comment_list" style="min-height: 600px;">
		@foreach ($commentData as $key=>$comment)
			<li class="comment_item" style="display: none;">
				<span>
					<span>@ {{$comment -> created_at -> diffForHumans()}}</span>
					&nbsp;&nbsp;&nbsp;
					「<a href="{{ route('user.articleDetail', [ 'id'=>$comment->aid ] ) }}">{{ $comment->articles->title }} </a>」
					<span>にコメントしました：</span>
				</span>
				<div class="reply_and_content">
					@if($comment->to_user_name != null)
						<span>reply &nbsp; to  &nbsp;&nbsp;<a href="#">{{ $comment->to_user_name }}</a></span>
						<div class="comment_main_content" id="comment_reply_content{{ $key }}"></div>
						<input type="hidden" name="commentReplyHidden" class="commentReplyHidden" id="commentReplyHidden{{ $key }}" value="{{ $comment->markdown_content }}">
					@else
						<div class="comment_main_content" id="comment_content{{ $key }}"></div>
						<input type="hidden" name="commentHidden" class="commentHidden" id="commentHidden{{ $key }}" value="{{ $comment->markdown_content }}">
					@endif
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

@section('commentScript')
	<script>
		//展示markdown形式的comment内容
		$(".commentHidden").each(function () {
			var key =$(this).attr('id').substring(13);
			var value = $(this).val();
			$("#comment_content" + key).html(value);
		});
		//展示markdown形式的reply_comment内容
		$(".commentReplyHidden").each(function () {
			var key =$(this).attr('id').substring(18);
			var value = $(this).val();
			$("#comment_reply_content" + key).html(value);
		});


		frontPage(5);

	</script>
@endsection