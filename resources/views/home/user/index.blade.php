@extends('layouts.user')
@section('title','分享')
@section('homePage','ホーム')
@section('userPage',"「 " . $user->user_name . " 」" . "の個人ページ")

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
				<span>
					@yield('userPage')
				</span>
			</div>
		</div>
	</header>

@endsection

@section('content')

<div class="user-widget up-frame">
	<div class="recent-release">
		<h3>最新の記事</h3>
		@if(count($latestPassArticle) != 0)
			<ul>
				@foreach($latestPassArticle as $article)
					<li class="passArticle_item">
                    <span class="sub_title" style="background-color: {{ $article->categories->color_categories }};">
                    	{{ substr($article->categories->str_categories, strripos($article->categories->str_categories, ',')+1 ) }}
                    </span>
						&nbsp;&nbsp;
						<a href="{{ route('user.articleDetail', [ 'id'=>$article->id ] ) }}">{{ $article->title }}</a>&nbsp;&nbsp;
						<span class="passArticle_info" style="float: right;">

                        <span class="like_number"><i class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;{{$article -> article_relate -> like_number}}</span>
                        <span class="store_number"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;{{$article -> article_relate -> store_number}}</span>
                        <span class="comment_number"><i class="fa fa-comments-o"></i>&nbsp;&nbsp;{{$article -> article_relate -> comment_number}}</span>
                        <span class="created_at"><i class="fa fa-calendar"></i>&nbsp;&nbsp;{{$article -> created_at -> diffForHumans()}}</span>

					</span>
					</li>
				@endforeach
			</ul>
			<a class="seeMore" href="{{ route('user.share',[ $id ]) }}">もっと見る</a>
		@else
			<div style="padding: 30px 2px;font-size: 20px;">
				何もありません
			</div>
		@endif
	</div>
</div>

<div class="user-widget down-frame">
	<div class="recent-comment">
		<h3>最新のコメント</h3>
		@if(count($latestCommentData) != 0)
			<ul>
				@foreach ($latestCommentData as $key=>$comment)
					<li class="comment_item">
				<span>コメント＠記事「 <a href="{{ route('user.articleDetail', [ 'id'=>$comment->aid ] ) }}">{{ $comment->articles->title }} </a>」
					<span>： {{$comment -> created_at -> diffForHumans()}}</span>

				</span>
						<div id="reply_part">
							@if($comment->to_user_name != null)
								<span>返信→ <a class="reply_to" href="{{ url('user', ['id' => $user->id ]) }}">{{ $comment->to_user_name }}</a></span>
							@endif
							<div class="comment_main_content" id="comment_content{{ $key }}"></div>
							<input type="hidden" name="commentHidden" class="commentHidden" id="commentHidden{{ $key }}" value="{{ $comment->markdown_content }}">
						</div>
					</li>
				@endforeach
			</ul>
			<a class="seeMore" href="{{ route('user.comment',[ $id ]) }}">もっと見る</a>
		@else
			<div style="padding: 30px 2px;font-size: 20px;">
				何もありません
			</div>
		@endif

	</div>
</div>

@endsection

@section('commentScript')
	<script>
		// 展示markdown形式的comment内容
		$(".commentHidden").each(function () {
			var key =$(this).attr('id').substring(13);
			var value = $(this).val();
			$("#comment_content" + key).html(value);
		});
	</script>
@endsection