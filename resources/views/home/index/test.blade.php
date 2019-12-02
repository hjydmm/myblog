@extends('layouts.main')

@section('main')
    <section id="content">
        <div class="container">
            <div class="row">

                <div class="left-content col-md-3">
                    <!-- 会员个人信息部分 -->

                    <div class="user-widget user-avatar-name">
                        <div class="member-info">
                            <div class="left-avatar">
                                <div style="background:url('http://myblog.com/assets/images/userAvatars/6070cff5a230152966e7f75c6f859a1fd8326646.png') no-repeat center / cover" class="thumbnail"></div>
                            </div>
                            <div class="right-username">
                                <div>
                                    双葉
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="user-widget user-info-items">

                        <div class="self-introduction">
                            おはようございます!
                        </div>

                        <div class="user_info">
                            <div id="article_number" style="display: inline-block;">
                            <span>
                                記事
                                &nbsp;
                                12
                            </span>
                            </div>
                            <div id="stored" style="display: inline-block;">
                            <span>
                                ブックマーク
                                &nbsp;
                                35
                            </span>
                            </div>
                            <div id="attended" style="display: inline-block;">
                            <span>
                                フォロワー
                                &nbsp;
                                7
                            </span>
                            </div>
                            <div id="liked" style="display: inline-block;">
                            <span>
                                いいね
                                &nbsp;
                                52
                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="user-widget user-info-items">
                        <a id="write-article" href="{{ url('/writeArticle') }}">
                            記事を書く
                        </a>
                    </div>

                    {{--<div class="user-widget user-info-items">--}}

                        {{--<div class="homePage-nav-title" style="border-bottom: 3px solid #d32e27;margin-bottom: 15px;">--}}
                            {{--<div style="margin-bottom: 3px;" class="clearfix">--}}
                                {{--<span style="font-size: 18px;color: #000;float: left;">人気タグ</span>--}}
                                {{--<span style="font-size: 14px;color: #000;float: right;">もっと見る</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="homePage-tags-area" style="margin-bottom: 15px;">--}}
                            {{--@foreach ($pageElement['tagData'] as $val)--}}
                                {{--<a href="{{ route('tag.articles',[ $val->name ]) }}" style="display: inline-block;border: 1px solid rgba(100, 100, 100, 0.3);border-radius:4px;margin-bottom: 6px;margin-right: 2px;padding: 4px 6px;">{{$val->name}}</a>--}}
                                {{--<button type="button" style="margin: 3px;border-radius: 3px;" class="{{$button_rand[rand(0,2)]}} tag-btn" value="{{$val->id}}" onclick="window.location='{{ route('tag.articles',[ $val->name ]) }}'">{{$val->name}}</button>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}

                    {{--</div>--}}

                    {{--<div class="user-widget user-info-items">--}}

                        {{--<div class="homePage-nav-title" style="border-bottom: 3px solid #d32e27;margin-bottom: 15px;">--}}
                            {{--<div style="margin-bottom: 3px;" class="clearfix">--}}
                                {{--<span style="font-size: 18px;color: #000;float: left;">人気記事ランキング</span>--}}
                                {{--<span style="font-size: 14px;color: #000;float: right;">もっと見る</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="panel-body" style="padding: 0;">--}}
                            {{--<!-- Nav tabs -->--}}
                            {{--<ul class="nav nav-pills" style="font-size: 14px;margin-bottom: 10px;">--}}
                                {{--<li><a href="#most_Like" data-toggle="tab" style="padding: 5px 9px;margin-right: 6px;border-radius: 0;border-bottom: 1px solid rgba(100, 100, 100, 0.5);">いいね!</a></li>--}}
                                {{--<li><a href="#most_store" data-toggle="tab" style="padding: 5px 6px;margin-right: 6px;border-radius: 0;border-bottom: 1px solid rgba(100, 100, 100, 0.5);">コレクション</a></li>--}}
                                {{--<li><a href="#most_comment" data-toggle="tab" style="padding: 5px 6px;margin-right: 6px;border-radius: 0;border-bottom: 1px solid rgba(100, 100, 100, 0.5);">コメント</a></li>--}}
                            {{--</ul>--}}

                            {{--<div class="tab-content">--}}
                                {{--<div class="tab-pane fade in active" id="most_Like">--}}

                                    {{--@foreach($pageElement['mostLikeArticles'] as $likeArticle)--}}
                                    {{--<div class="homePage-article-list clearfix" style="margin-bottom: 10px;background-color: #efedf6;">--}}
                                        {{--<span style="float: left;display: inline-block;width: 50px;height: 50px;padding: 0;margin-bottom: 0;background:url('{{ $likeArticle->users->avatar }}') no-repeat center / cover" class="thumbnail"></span>--}}
                                        {{--<span style="display: inline-block;">--}}
                                            {{--<a href="{{ route('user.articleDetail', [ 'id'=>$likeArticle->articles->id ] ) }}">--}}
                                               {{--{{ $likeArticle->articles->title }}--}}
                                            {{--</a>--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                    {{--@endforeach--}}

                                    {{--@foreach($pageElement['mostLikeArticles'] as $likeArticle)--}}
                                        {{--<div class="content-part clearfix">--}}
                                            {{--<div class="col-md-2 col-sm-12 left-picture">--}}
                                                {{--<div>--}}
                                                    {{--<div id="user_pic" style="background:url('{{ $likeArticle->users->avatar }}') no-repeat center / cover" class="thumbnail"></div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-10 col-sm-12 right-content">--}}
                                                {{--<h4>--}}
                                                    {{--<a href="{{ route('user.articleDetail', [ 'id'=>$likeArticle->articles->id ] ) }}">--}}
                                                        {{--{{ $likeArticle->articles->title }}--}}
                                                    {{--</a>--}}
                                                {{--</h4>--}}
                                                {{--<span><i class="fa fa-user"></i> {{ $likeArticle->users->user_name }}</span>--}}
                                                {{--<span><i class="fa fa-thumbs-o-up"></i> {{ $likeArticle->like_number }}</span>--}}
                                                {{--<span><i class="fa fa-bookmark-o"></i> {{ $likeArticle->store_number }}</span>--}}
                                                {{--<span><i class="fa fa-comments-o"></i> {{ $likeArticle->comment_number }}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane fade" id="most_store">--}}
                                    {{--@foreach($pageElement['mostStoreArticles'] as $storeArticle)--}}
                                        {{--<div class="content-part clearfix">--}}
                                            {{--<div class="col-md-2 col-sm-12 left-picture">--}}
                                                {{--<div>--}}
                                                    {{--<div id="user_pic" style="background:url('{{ $storeArticle->users->avatar }}') no-repeat center / cover" class="thumbnail"></div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-10 col-sm-12 right-content">--}}
                                                {{--<h4>--}}
                                                    {{--<a href="{{ route('user.articleDetail', [ 'id'=>$storeArticle->articles->id ] ) }}">--}}
                                                        {{--{{ $storeArticle->articles->title }}--}}
                                                    {{--</a>--}}
                                                {{--</h4>--}}
                                                {{--<span><i class="fa fa-user"></i> {{ $storeArticle->users->user_name }}</span>--}}
                                                {{--<span><i class="fa fa-thumbs-o-up"></i> {{ $storeArticle->like_number }}</span>--}}
                                                {{--<span><i class="fa fa-bookmark-o"></i> {{ $storeArticle->store_number }}</span>--}}
                                                {{--<span><i class="fa fa-comments-o"></i> {{ $storeArticle->comment_number }}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                                {{--<div class="tab-pane fade" id="most_comment">--}}
                                    {{--@foreach($pageElement['mostCommentArticles'] as $commentArticle)--}}
                                        {{--<div class="content-part clearfix">--}}
                                            {{--<div class="col-md-2 col-sm-12 left-picture">--}}
                                                {{--<div>--}}
                                                    {{--<div id="user_pic" style="background:url('{{ $commentArticle->users->avatar }}') no-repeat center / cover" class="thumbnail"></div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-10 col-sm-12 right-content">--}}
                                                {{--<h4>--}}
                                                    {{--<a href="{{ route('user.articleDetail', [ 'id'=>$commentArticle->articles->id ] ) }}">--}}
                                                        {{--{{ $commentArticle->articles->title }}--}}
                                                    {{--</a>--}}
                                                {{--</h4>--}}
                                                {{--<span><i class="fa fa-user"></i> {{ $commentArticle->users->user_name }}</span>--}}
                                                {{--<span><i class="fa fa-thumbs-o-up"></i> {{ $commentArticle->like_number }}</span>--}}
                                                {{--<span><i class="fa fa-bookmark-o"></i> {{ $commentArticle->store_number }}</span>--}}
                                                {{--<span><i class="fa fa-comments-o"></i> {{ $commentArticle->comment_number }}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}




                    <!-- 会员行为部分  -->
                    <div class="user-widget user-info-items">
                        <div class="action-content">
                            <div class="action">
                                <a href="javascript:void(0);">
                                    <span class=""><i class="fa fa-home"></i>&nbsp;&nbsp;Quick Look</span>
                                </a>
                            </div>
                            <div class="action">
                                <a href="javascript:void(0);">
                                    <span class=""><i class="fa fa-book"></i>&nbsp;&nbsp;カテゴリー</span>
                                </a>
                            </div>
                            <div class="action">
                                <a href="javascript:void(0);">
                                    <span class=""><i class="fa fa-tag"></i>&nbsp;&nbsp;タグ一覧</span>
                                </a>
                            </div>
                            <div class="action">
                                <a href="javascript:void(0);">
                                    <span class=""><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;最新記事</span>
                                </a>
                            </div>
                            <div class="action">
                                <a href="javascript:void(0);">
                                    <span class=""><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;記事ランキング</span>
                                </a>
                            </div>
                            <div class="action">
                                <a href="javascript:void(0);">
                                    <span class=""><i class="fa fa-link"></i>&nbsp;&nbsp;リンク一覧</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    @if (Auth::guard('home')->check())
                        <input type="hidden" name="visitor_id" id="visitor_id" value="{{ Auth::guard('home')->user()->id }}">
                    @else
                        <input type="hidden" name="visitor_id" id="visitor_id" value="visitor">
                    @endif

                </div><!-- left-content -->

                <div class="right-content col-md-9">

                    <!-- 长方形区域 -->
                    <div id="homePage-categories-area" style="margin-bottom: 20px;" class="clearfix">

                        <div class="homePage-nav-title" style="border-bottom: 3px solid #d32e27;margin-bottom: 5px;">
                            <div style="margin-bottom: 3px;" class="clearfix">
                                <span style="font-size: 18px;color: #000;float: left;">人気カテゴリー</span>
                                <span style="font-size: 14px;color: #000;float: right;">もっと見る</span>
                            </div>
                        </div>

                        <div class="square-left col-md-4" style="padding: 0 4px;">
                            <div style="padding:5px;">
                                <div id="pic" style="border: 2px solid rgba(66, 66, 66, 0.08);padding: 5px 3px 5px 3px;">
                                    <div style="width:254px; height:254px; background:url('http://myblog.com/assets/images/articles/1@1200_1200_300.png') no-repeat center / cover" class="thumbnail">
                                    </div>
                                    <div id="intro-content">
                                        <a href="javascript:void(0);" class="my_tag"> Laravel</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="square-right col-md-4" style="padding: 0 4px;">
                            <div style="padding:5px;">
                                <div id="pic" style="border: 2px solid rgba(66, 66, 66, 0.08);padding: 5px 3px 30px 3px;">
                                    <div style="width:254px; height:254px; background:url('http://myblog.com/assets/images/articles/2@1200_1200_300.png') no-repeat center / cover" class="thumbnail">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="square-right col-md-4" style="padding: 0 4px;">
                            <div style="padding:5px;">
                                <div id="pic" style="border: 2px solid rgba(66, 66, 66, 0.08);padding: 5px 3px 30px 3px;">
                                    <div style="width:254px; height:254px; background:url('http://myblog.com/assets/images/articles/3@1200_1200_300.png') no-repeat center / cover" class="thumbnail">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div id="homePage-articles-area" style="margin-bottom: 20px;">
                        <div class="homePage-nav-title" style="border-bottom: 3px solid #d32e27;">
                            <div style="margin-bottom: 3px;" class="clearfix">
                                <span style="font-size: 18px;color: #000;float: left;">最新記事</span>
                                <span style="font-size: 14px;color: #000;float: right;">もっと見る</span>
                            </div>
                        </div>

                        <div class="homePage-new_articles clearfix" style="margin-top: 10px;margin-bottom: 20px;">

                            <div class="user-widget detail-page col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 10px;margin-bottom: 10px;">

                                <div class="detail-categories-tags" style="margin-bottom: 0;padding: 0">

                                    <div style="display: inline-block;height: 50px;background-color: #fbc7c7;text-align: center;line-height: 50px;">
                                        {{--<div style="font-size: 20px;color: #000;display: inline-block;padding: 5px 0 3px 10px;">Laravelシーリズ: バリデーション</div>--}}
                                        <a style="font-size: 20px;color: #000;display: inline-block;padding: 0 10px 0 10px;">Laravelシーリズ: バリデーション</a>
                                    </div>

                                    <div style="display: inline-block;height: 50px;text-align: center;line-height: 50px;float: right;color: #000;">
                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>
                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>
                                        <a href="#comment_begin" class="comment_number detail-item" style="margin-right: 15px;"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>
                                        <span class="created_at calendar-item" style="margin-right: 15px;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>
                                    </div>

                                </div>
                            </div>

                            <div class="user-widget detail-page col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 10px;margin-bottom: 10px;">

                                <div class="detail-categories-tags" style="margin-bottom: 0;padding: 0">

                                    <div style="display: inline-block;height: 50px;background-color: #c4e1fb;text-align: center;line-height: 50px;">
                                        {{--<div style="font-size: 20px;color: #000;display: inline-block;padding: 5px 0 3px 10px;">Laravelシーリズ: バリデーション</div>--}}
                                        <a style="font-size: 20px;color: #000;display: inline-block;padding: 0 10px 0 10px;">リクエスト処理（コントローラ）のまとめ</a>
                                    </div>

                                    <div style="display: inline-block;height: 50px;text-align: center;line-height: 50px;float: right;color: #000;">
                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>
                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>
                                        <a href="#comment_begin" class="comment_number detail-item" style="margin-right: 15px;"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>
                                        <span class="created_at calendar-item" style="margin-right: 15px;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>
                                    </div>

                                </div>
                            </div>

                            <div class="user-widget detail-page col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 10px;margin-bottom: 10px;">

                                <div class="detail-categories-tags" style="margin-bottom: 0;padding: 0">

                                    <div style="display: inline-block;height: 50px;background-color: #ddfbef;text-align: center;line-height: 50px;">
                                        {{--<div style="font-size: 20px;color: #000;display: inline-block;padding: 5px 0 3px 10px;">Laravelシーリズ: バリデーション</div>--}}
                                        <a style="font-size: 20px;color: #000;display: inline-block;padding: 0 10px 0 10px;">migrationの操作(データ型の変更)</a>
                                    </div>

                                    <div style="display: inline-block;height: 50px;text-align: center;line-height: 50px;float: right;color: #000;">
                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>
                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>
                                        <a href="#comment_begin" class="comment_number detail-item" style="margin-right: 15px;"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>
                                        <span class="created_at calendar-item" style="margin-right: 15px;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>
                                    </div>

                                </div>
                            </div>

                            <div class="user-widget detail-page col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 10px;margin-bottom: 10px;">

                                <div class="detail-categories-tags" style="margin-bottom: 0;padding: 0">

                                    <div style="display: inline-block;height: 50px;background-color: #fbe6f9;text-align: center;line-height: 50px;">
                                        {{--<div style="font-size: 20px;color: #000;display: inline-block;padding: 5px 0 3px 10px;">Laravelシーリズ: バリデーション</div>--}}
                                        <a style="font-size: 20px;color: #000;display: inline-block;padding: 0 10px 0 10px;">Eloquentリレーション（多対多）</a>
                                    </div>

                                    <div style="display: inline-block;height: 50px;text-align: center;line-height: 50px;float: right;color: #000;">
                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>
                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>
                                        <a href="#comment_begin" class="comment_number detail-item" style="margin-right: 15px;"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>
                                        <span class="created_at calendar-item" style="margin-right: 15px;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>
                                    </div>

                                </div>
                            </div>

                            <div class="user-widget detail-page col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 10px;margin-bottom: 10px;">
                                <div class="detail-categories-tags" style="margin-bottom: 0;padding: 0">
                                    <div style="display: inline-block;height: 50px;background-color: #d3d6fb;text-align: center;line-height: 50px;">
                                        <a style="font-size: 20px;color: #000;display: inline-block;padding: 0 10px 0 10px;">Authミドルウェアを使ってみる</a>
                                    </div>
                                    <div style="display: inline-block;height: 50px;text-align: center;line-height: 50px;float: right;color: #000;">
                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>
                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>
                                        <a href="#comment_begin" class="comment_number detail-item" style="margin-right: 15px;"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>
                                        <span class="created_at calendar-item" style="margin-right: 15px;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>
                                    </div>
                                </div>
                            </div>

                        </div>




                        <div id="homePage-articles-area" style="margin-bottom: 20px;">
                            <div class="homePage-nav-title" style="border-bottom: 3px solid #d32e27;">
                                <div style="margin-bottom: 3px;" class="clearfix">
                                    <span style="font-size: 18px;color: #000;float: left;">人気記事ランキング</span>
                                    {{--<span style="font-size: 14px;color: #000;float: right;">もっと見る</span>--}}
                                </div>
                            </div>

                            <div class="homePage-ranking" style="margin-top: 10px;margin-bottom: 10px;">

                                <div id="ranking-left" class="col-md-3" style="padding: 0;">
                                    <ul class="nav nav-pills" style="margin-top: 8px;">

                                        <li class="active"><a href="#home-pills" data-toggle="tab">いいね !</a></li>

                                        <li><a href="#profile-pills" data-toggle="tab">ブックマーク</a></li>

                                        <li><a href="#messages-pills" data-toggle="tab">コメント</a></li>

                                    </ul>
                                </div>

                                <div id="articles-right" class="col-md-9" style="padding: 0;">

                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="home-pills">
                                            <div class="user-widget detail-page col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 8px;margin-bottom: 8px;">
                                                <div class="detail-categories-tags" style="margin-bottom: 0;padding: 0">
                                                    <div style="display: inline-block;height: 40px;background-color: #ddfbef;text-align: center;line-height: 40px;">
                                                        <a style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">Authミドルウェアを使ってみる</a>
                                                    </div>
                                                    <div style="display: inline-block;height: 40px;text-align: center;line-height: 40px;float: right;color: #000;">
                                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>
                                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>
                                                        <a href="#comment_begin" class="comment_number detail-item" style="margin-right: 15px;"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>
                                                        <span class="created_at calendar-item" style="margin-right: 15px;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-widget detail-page col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 8px;margin-bottom: 8px;">
                                                <div class="detail-categories-tags" style="margin-bottom: 0;padding: 0">
                                                    <div style="display: inline-block;height: 40px;background-color: #d3d6fb;text-align: center;line-height: 40px;">
                                                        <a style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">Authミドルウェアを使ってみる</a>
                                                    </div>
                                                    <div style="display: inline-block;height: 40px;text-align: center;line-height: 40px;float: right;color: #000;">
                                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>
                                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>
                                                        <a href="#comment_begin" class="comment_number detail-item" style="margin-right: 15px;"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>
                                                        <span class="created_at calendar-item" style="margin-right: 15px;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-widget detail-page col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 8px;margin-bottom: 8px;">
                                                <div class="detail-categories-tags" style="margin-bottom: 0;padding: 0">
                                                    <div style="display: inline-block;height: 40px;background-color: #fbe6f9;text-align: center;line-height: 40px;">
                                                        <a style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">Authミドルウェアを使ってみる</a>
                                                    </div>
                                                    <div style="display: inline-block;height: 40px;text-align: center;line-height: 40px;float: right;color: #000;">
                                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>
                                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>
                                                        <a href="#comment_begin" class="comment_number detail-item" style="margin-right: 15px;"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>
                                                        <span class="created_at calendar-item" style="margin-right: 15px;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="user-widget detail-page col-md-12 col-sm-12 col-xs-12" style="padding: 0;margin-top: 8px;margin-bottom: 8px;">
                                                <div class="detail-categories-tags" style="margin-bottom: 0;padding: 0">
                                                    <div style="display: inline-block;height: 40px;background-color: #d3d6fb;text-align: center;line-height: 40px;">
                                                        <a style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">Authミドルウェアを使ってみる</a>
                                                    </div>
                                                    <div style="display: inline-block;height: 40px;text-align: center;line-height: 40px;float: right;color: #000;">
                                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>
                                                        <a href="javascript:void(0);" class="detail-item" style="margin-right: 15px;"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>
                                                        <a href="#comment_begin" class="comment_number detail-item" style="margin-right: 15px;"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>
                                                        <span class="created_at calendar-item" style="margin-right: 15px;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile-pills">
                                            <h4>Profile Tab</h4>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                        <div class="tab-pane fade" id="messages-pills">
                                            <h4>Messages Tab</h4>
                                            <p>Lorem ipsum dolor sit amet</p>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>

                    </div>

                    <div id="homePage-tags-area" style="margin-bottom: 20px;">
                        <div class="homePage-nav-title" style="border-bottom: 3px solid #d32e27;margin-bottom: 16px;">
                            <div style="margin-bottom: 3px;" class="clearfix">
                                <span style="font-size: 18px;color: #000;float: left;">HOT TAGS</span>
                                <span style="font-size: 14px;color: #000;float: right;">もっと見る</span>
                            </div>
                        </div>

                        <div class="homePage-tags-area" style="margin-bottom: 15px;">
                        @foreach ($pageElement['tagData'] as $val)
                            <a href="{{ route('tag.articles',[ $val->name ]) }}" style="display: inline-block;border: 1px solid rgba(100, 100, 100, 0.6);border-radius:4px;margin-bottom: 8px;margin-right: 6px;padding: 4px 6px;font-size: 18px;">{{$val->name}}</a>
                        @endforeach
                        </div>

                    </div>




                        {{--<div id="list-area">--}}
                            {{--<div class="homePage-nav-title" style="border-bottom: 3px solid #d32e27;">--}}
                                {{--<div style="margin-bottom: 3px;" class="clearfix">--}}
                                    {{--<span style="font-size: 18px;color: #000;float: left;">最新記事</span>--}}
                                    {{--<span style="font-size: 14px;color: #000;float: right;">もっと見る</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="user-widget detail-page" style="padding-bottom: 0;margin-bottom: 10px;">--}}
                                {{--<div class="detail-info clearfix" style="border-bottom: 0 solid rgba(100, 100, 100, 1);margin-bottom: 0;padding-bottom: 0;">--}}
                                    {{--<div class="detail-title" style="display:inline-block;float: left;padding-bottom: 0;margin-bottom: 0;">--}}
                                        {{--<span style="font-size: 20px;">Laravelシーリズ: バリデーション</span>--}}
                                    {{--</div>--}}
                                    {{--<div style="float: right;">--}}
                                        {{--<a href="javascript:void(0);" class="detail-item"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>--}}
                                        {{--<a href="javascript:void(0);" class="detail-item"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>--}}
                                        {{--<a href="#comment_begin" class="comment_number detail-item"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>--}}
                                        {{--<span class="created_at calendar-item" style="margin-right: 0;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="detail-categories-tags" style="margin-bottom: 2px;padding: 6px 0">--}}

                                    {{--<span id="categories">カテゴリー</span>--}}
                                    {{--<a href="" id="category_item" class="detail-tag">フロントエンド</a>--}}
                                    {{--<a href="" id="category_item" class="detail-tag">JavaScript</a>--}}
                                    {{--&nbsp;&nbsp;&nbsp;--}}
                                    {{--<span id="tags">タグ</span>--}}
                                    {{--<a href="" id="tag_item" class="detail-tag">JavaScript</a>--}}
                                    {{--<a href="" id="tag_item" class="detail-tag">JQuery</a>--}}
                                    {{--<a href="" id="tag_item" class="detail-tag">Bootstrap</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--<div class="user-widget detail-page" style="padding-bottom: 0;margin-bottom: 10px;">--}}
                            {{--<div class="detail-info clearfix" style="border-bottom: 0 solid rgba(100, 100, 100, 1);margin-bottom: 0;padding-bottom: 0;">--}}
                                {{--<div class="detail-title" style="display:inline-block;float: left;padding-bottom: 0;margin-bottom: 0;">--}}
                                {{--<span style="font-size: 20px;">Laravelシーリズ: バリデーション</span>--}}
                                {{--</div>--}}
                                {{--<div style="float: right;">--}}
                                    {{--<a href="javascript:void(0);" class="detail-item"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">32</span></a>--}}
                                    {{--<a href="javascript:void(0);" class="detail-item"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">21</span></a>--}}
                                    {{--<a href="#comment_begin" class="comment_number detail-item"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">12</span></a>--}}
                                    {{--<span class="created_at calendar-item" style="margin-right: 0;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>3週間前</span></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="detail-categories-tags" style="margin-bottom: 0;padding: 0">--}}

                                {{--<div style="display: inline-block;height: 30px;background-color: rgba(251,173,59, 1);text-align: center;line-height: 30px;">--}}
                                    {{--<div style="font-size: 16px;color: #000;display: inline-block;padding: 5px 0 3px 10px;">Laravelシーリズ: バリデーション</div>--}}
                                    {{--<a style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">カテゴリー</a>--}}
                                {{--</div>--}}
                                {{--<div style="display: inline-block;height: 30px;background-color: rgba(251, 87, 116, 1);text-align: center;line-height: 30px;">--}}
                                    {{--<div style="font-size: 16px;color: #000;display: inline-block;padding: 5px 0 3px 10px;">Laravelシーリズ: バリデーション</div>--}}
                                    {{--<a style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">フロントエンド</a>--}}
                                {{--</div>--}}
                                {{--<div style="display: inline-block;height: 30px;background-color: rgba(251, 87, 116, 0.7);text-align: center;line-height: 30px;">--}}
                                    {{--<div style="font-size: 16px;color: #000;display: inline-block;padding: 5px 0 3px 10px;">Laravelシーリズ: バリデーション</div>--}}
                                    {{--<a style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">JavaScript</a>--}}
                                {{--</div>--}}

                                {{--<div style="display: inline-block;height: 30px;background-color: rgba(251, 173, 59, 1);text-align: center;line-height: 30px;">--}}
                                    {{--<div style="font-size: 16px;color: #000;display: inline-block;padding: 5px 0 3px 10px;">Laravelシーリズ: バリデーション</div>--}}
                                    {{--<a style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">タグ</a>--}}
                                {{--</div>--}}
                                {{--<div style="display: inline-block;height: 30px;background-color: rgba(99, 217, 251, 1);text-align: center;line-height: 30px;">--}}
                                    {{--<div style="font-size: 16px;color: #000;display: inline-block;padding: 5px 0 3px 10px;">Laravelシーリズ: バリデーション</div>--}}
                                    {{--<a style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">JQuery</a>--}}
                                {{--</div>--}}
                                {{--<div style="display: inline-block;height: 30px;background-color: rgba(99, 217, 251, 0.7);text-align: center;line-height: 30px;">--}}
                                    {{--<div style="font-size: 16px;color: #000;display: inline-block;padding: 5px 0 3px 10px;">Laravelシーリズ: バリデーション</div>--}}
                                    {{--<a style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">Bootstrap</a>--}}
                                {{--</div>--}}



                                {{--<span id="categories">カテゴリー</span>--}}
                                {{--<a href="" id="category_item" class="detail-tag">フロントエンド</a>--}}
                                {{--<a href="" id="category_item" class="detail-tag">JavaScript</a>--}}
                                {{--&nbsp;&nbsp;&nbsp;--}}
                                {{--<span id="tags">タグ</span>--}}
                                {{--<a href="" id="tag_item" class="detail-tag">JavaScript</a>--}}
                                {{--<a href="" id="tag_item" class="detail-tag">JQuery</a>--}}
                                {{--<a href="" id="tag_item" class="detail-tag">Bootstrap</a>--}}

                            {{--</div>--}}
                        {{--</div>--}}


                        {{--@foreach($latestArticles as $latestArticle)--}}
                            {{--style="border-bottom: 1px solid rgba(100, 100, 100, 0.5);"--}}
                            {{--<div class="user-widget detail-page" style="padding-bottom: 0;margin-bottom: 10px;">--}}
                                {{--<div class="detail-info clearfix" style="border-bottom: 0 solid rgba(100, 100, 100, 1);margin-bottom: 0;padding-bottom: 0;">--}}
                                    {{--<div class="detail-title" style="display:inline-block;float: left;padding-bottom: 0;margin-bottom: 0;">--}}
                                        {{--<span style="font-size: 20px;">{{ $latestArticle->title }}</span>--}}
                                    {{--</div>--}}
                                    {{--<div style="float: right;">--}}
                                        {{--<a href="javascript:void(0);" class="detail-item"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">{{ $latestArticle->article_relate->like_number }}</span></a>--}}
                                        {{--<a href="javascript:void(0);" class="detail-item"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">{{$latestArticle -> article_relate -> store_number}}</span></a>--}}
                                        {{--<a href="#comment_begin" class="comment_number detail-item"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">{{$latestArticle -> article_relate -> comment_number}}</span></a>--}}
                                        {{--<span class="created_at calendar-item" style="margin-right: 0;border-radius: 0;border: 0 solid #fff;"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<span>{{ $latestArticle->created_at->diffForHumans() }}</span></span>--}}
                                        {{--<span id="isLiked_isStored" style="float: right;">--}}
                                        {{--<a href="javascript:void(0);" id="like_item" class="like_number click-tag"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="click-like"> いいね ! </span></a>--}}
                                        {{--<a href="javascript:void(0);" id="store_item" class="store_number click-tag"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="click-bookmark"> ブックマーク </span></a>--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="detail-categories-tags" style="margin-bottom: 2px;padding: 6px 0">--}}

                                    {{--<span id="categories">カテゴリー</span>--}}
                                    {{--@inject('categoriesService', 'App\Services\TagsServiceInterface')--}}
                                    {{--@foreach($categoriesService->stringToArray(',', $latestArticle->categories->str_categories) as $category)--}}
                                        {{--<a href="{{ route('category.articles',[ $category ]) }}" id="category_item" class="detail-tag">{{ $category }}</a>--}}
                                    {{--@endforeach--}}
                                    {{--&nbsp;&nbsp;&nbsp;--}}
                                    {{--<span id="tags">タグ</span>--}}
                                    {{--@inject('tagsService', 'App\Services\TagsServiceInterface')--}}
                                    {{--@foreach($tagsService->stringToArray(',', $latestArticle->tags->str_tags) as $tag)--}}
                                        {{--<a href="{{ route('tag.articles',[ $tag ]) }}" id="tag_item" class="detail-tag">{{ $tag }}</a>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}






                    @yield('content')
                    @yield('commentList')
                    @yield('comment')
                </div><!-- right-content -->

            </div><!-- row -->
        </div><!-- container -->

        <div style="height: 80px;">

        </div>

        <div class="container-fluid" style="height: 30px;text-align: center;">
            <div>
                Copyright &nbsp; © &nbsp; 2019 &nbsp; 双葉のブログ &nbsp; by &nbsp; カ シュンヨウ
            </div>
            <div style="font-size: 18px;">
                All &nbsp; Rights &nbsp; Reserved
            </div>

        </div>

    </section>
@endsection