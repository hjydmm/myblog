@extends('layouts.main')

@section('main')
<!-- @yield('carousel') --> 
<section id="content">
	<div class="container">
		<div class="row">
			<!---- 主页左边的内容 ---->
			<div class="left-content col-md-8">
		        @yield('content')			
			</div><!-- left-content -->

			<!---- 主页右边的内容 ---->
			<div class="right-content col-md-4">

				<div class="widget">
					<!---- hot_category和search部分 ---->
					<div class="widget-categories widget-part">
						<div class="heading"><span>人気カテゴリー</span></div>
						<div class="">
							<div id="keyword">
							<a class="category_2" href="{{ route('category.articles',[ 'Laravel' ]) }}">Laravel</a>
							<a class="category_1" href="{{ route('category.articles',[ 'JQuery' ]) }}">JQuery</a>
							<a class="category_4" href="{{ route('category.articles',[ 'Mysql' ]) }}">Mysql</a>
							<a class="category_3" href="{{ route('category.articles',[ 'Swift' ]) }}">Swift</a>
							<a class="category_3" href="{{ route('category.articles',[ 'C++' ]) }}">C++</a>
							<a class="category_1" href="{{ route('category.articles',[ 'JavaScript' ]) }}">JavaScript</a>
							<a class="category_6" href="{{ route('category.articles',[ 'デザインパターン' ]) }}">デザインパターン</a>
							</div>
						</div>
					</div>
				</div>

				<div class="widget">
					<!---- hot_tags部分 ---->
					<div class="widget-tags widget-part">
						<div class="heading"><span>HOT TAGS</span></div>
						<div class="tags-area">
							@foreach ($pageElement['tagData'] as $val)
								<a class="tag-in" href="{{ route('tag.articles',[ $val->name ]) }}" style="">{{$val->name}}</a>
								{{--<button type="button" style="margin: 3px;border-radius: 3px;" class="{{$button_rand[rand(0,2)]}} tag-btn" value="{{$val->id}}" onclick="window.location='{{ route('tag.articles',[ $val->name ]) }}'">{{$val->name}}</button>--}}
							@endforeach
						</div>
					</div>
				</div>

				<div class="widget">
					<!---- hot_category和search部分 ---->
					<div class="widget-search widget-part">
						<div class="heading"><span>キーワード</span></div>
						<div class="search-area">
							<input type="text" class="form-control" id="keyword-search" placeholder="タイトル/カテゴリー/タグ→Enter" value="" name="keyword-search" autocomplete="off" spellcheck="false">
							{{--<form action="{{ url('/keyword') }}" method="post">--}}
								{{--{{ csrf_field() }}--}}
								{{--<input type="text" class="form-control" id="keyword-search" placeholder="タイトル/カテゴリー/タグ→Enter" value="" name="keyword-search" autocomplete="off" spellcheck="false">--}}
							{{--</form>--}}
						</div>
					</div>
				</div>

				<div class="widget">
					<!---- ranking部分 ---->
					<div class="widget-ranking widget-part">
						<div class="heading">
							<span>人気ランキング</span>
							<a href="{{ route('rankings.articles',[ 'いいね！' ]) }}">もっと見る</a>
						</div>
						<div class="panel-body" style="padding: 0;">
							<div class="tab-content">
								<div class="tab-pane fade in active" id="most_Like">
									@foreach($pageElement['mostLikeArticles'] as $likeArticle)
										<div class="content-part clearfix">
											<div class="left-picture">
												<div>
													<div id="user_pic" style="background:url('{{ $likeArticle->users->avatar }}') no-repeat center / cover" class="thumbnail"></div>
													{{--<img src="{{ $likeArticle->users->avatar }}" class="img-responsive user_avatar" style="width: 100%;position: absolute;">--}}
												</div>
											</div>
											<div class="right-content" style="margin: 0">
												<div class="article_item_info">
													<span><i class="fa fa-user-o"></i> {{ $likeArticle->users->user_name }}</span>
													<span><i class="fa fa-heart-o"></i> {{ $likeArticle->like_number }}</span>
												</div>

												<a href="{{ route('user.articleDetail', [ 'id'=>$likeArticle->articles->id ] ) }}">
													{{ $likeArticle->articles->title }}
												</a>

												{{--<span><i class="fa fa-bookmark-o"></i> {{ $likeArticle->store_number }}</span>--}}
												{{--<span><i class="fa fa-comment-o"></i> {{ $likeArticle->comment_number }}</span>--}}
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div><!-- widget-ranking -->

				<div class="widget">
					<!---- 单独的图片 ---->
					<div class="widget-banner widget-part">
						<div class="content">

							<!-- Carousel -->
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								<!-- Indicators 小圆点-->
								<ol class="carousel-indicators">
									<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
									<li data-target="#carousel-example-generic" data-slide-to="1"></li>
									<li data-target="#carousel-example-generic" data-slide-to="2"></li>
								</ol>
								<!-- Wrapper for slides -->
								<div class="carousel-inner">
									<div class="item active">
										<a href="{{ route('series.articles',[ 'BLOGシリーズ' ]) }}">
											<img src="{{ url('assets/images/articles/owl_5.png') }}" alt="First slide" class="img-responsive">
										</a>
									</div>
									<div class="item">
										<a href="{{ route('series.articles',[ 'C言語学習ノート' ]) }}">
											<img src="{{ url('assets/images/articles/owl_6.png') }}" alt="Second slide" class="img-responsive">
										</a>
									</div>
									<div class="item">
										<a href="{{ route('series.articles',[ 'デザインパターン' ]) }}">
											<img src="{{ url('assets/images/articles/owl_7.png') }}" alt="Third slide" class="img-responsive">
										</a>
									</div>
								</div>
								<!-- Controls 左右两边的箭头-->
								<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
									<span class="fa fa-chevron-left"></span>
								</a>
								<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
									<span class="fa fa-chevron-right"></span>
								</a>
							</div><!-- /carousel -->

							{{--<img src="{{ url('assets/layout/images/banner-2.jpg') }}" class="img-responsive"/>--}}
						</div>
					</div>
				</div>



				<div class="scroll_spy" id="myScrollspy">
					<div id="affix_ui" data-spy="affix" data-offset-top="1710">
						<div class="widget" style="margin-top: 10px;">
							<div class="widget-link widget-part">
								<div class="heading"><span>リンク</span></div>
								<div class="content friendly">
									@foreach($pageElement['links'] as $link)
										<div class="link-item">
											<a href="{{ $link->url }}" target="_blank">
												{{ $link->title }}
											</a>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>

			</div><!-- right-content -->

		</div>
	</div>

	<input type="hidden" id="search-path" value="">

	<a style="display:none" href="javascript:void(0);"  id="backToTop"  title="トップへ"></a>

</section>

@endsection

@section('script')
	@yield('index_script')
	<script>
		$(document).ready(function () {

			$(window).resize(function() {
				var widths = $(window).width();
				//alert(widths);
				if(parseInt(widths) > 1200) {
					//$("body").attr("data-spy", "scroll");
					//$("#affix_ui").attr("data-spy", "affix").attr("data-offset-top", "1710").attr("id", "affix_ui");
				}else {
					//$("#affix_ui").remove();
				}

			});


		// <div class="scroll_spy" id="myScrollspy">
		// 			<div id="affix_ui" data-spy="affix" data-offset-top="1710">

		// <div id="affix_ui" data-spy="affix" data-offset-top="1710">


			$("input").keydown(function (event) {
				if(event.keyCode == 13) {
					//$("form").submit();
					var keyword = $("input#keyword-search").val();
					var path = "/keyword/" + keyword;
					window.location.href = path;
				}
			});
		});
	</script>
@endsection

