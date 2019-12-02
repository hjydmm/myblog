@extends('layouts.main')
@section('keywords', config('home.site.keywords'))
@section('description', config('home.site.description'))

@section('mainStyle')
    @yield('detailStyle')
@endsection


@section('navList')
    @yield('navList')
@endsection

@section('main')
<section id="content">
    <div class="container">
        <div class="row">

            <div class="left-content col-md-3">
                <div class="user-page">

                    <!-- 会员个人信息部分 -->
                    <div class="user-widget user-description">
                    <span class="description">
                        @if (Auth::guard('home')->user() && Auth::guard('home')->user()->id == $id)
                        私のページ
                        @else
                        投稿者情報
                        @endif
                    </span>
                    </div>

                    <div class="user-widget user-avatar-name">
                        <div class="member-info">
                            <div class="left-avatar">
                                <div style="background:url('{{ $user->avatar }}') no-repeat center / cover" class="thumbnail"></div>
                            </div>
                            <div class="right-username">
                                <div>
                                    {{ $user->user_name }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="user-widget user-info-items">


                        {{--@if (Auth::guard('home')->user() && Auth::guard('home')->user()->id == $id)--}}
                        {{--@else--}}
                            {{--<span id="attend">--}}
                            {{--@inject('attendService', 'App\Services\AttendServiceInterface')--}}
                            {{--@if(Auth::guard('home')->user() && $attendService->isAttendUser(Auth::guard('home')->user()->id, $user->id) == true)--}}
                                {{--<a href="javascript:void(0);" class="Follow">--}}
                                    {{--フォロー中--}}
                                {{--</a>--}}
                            {{--@else--}}
                                {{--<a href="javascript:void(0);" class="notFollow">--}}
                                    {{--フォローする--}}
                                {{--</a>--}}
                            {{--@endif--}}
                            {{--</span>--}}
                        {{--@endif--}}

                        <div class="self-introduction">
                            {{ $user->introduction ? : 'おはようございます!' }}
                        </div>

                        <div class="user_info">
                            <div id="article_number">
                                <span>
                                    記事
                                    &nbsp;
                                    {{ $pageElement['countPassArticle'] }}
                                </span>
                            </div>
                            <div id="stored">
                                <span>
                                    ブックマーク
                                    &nbsp;
                                    {{ $pageElement['countArticleStored'] }}
                                </span>
                            </div>
                            <div id="attended">
                                <span>
                                    フォロワー
                                    &nbsp;
                                    {{ $pageElement['countAttended'] }}
                                </span>
                            </div>
                            <div id="liked">
                                <span>
                                    いいね
                                    &nbsp;
                                    {{ $pageElement['countArticleLiked'] }}
                                </span>
                            </div>
                        </div>

                    </div>


                    <div class="user-widget user-info-items">

                        @if (Auth::guard('home')->user() && Auth::guard('home')->user()->id == $id)
                        <a id="write-article" href="{{ url('/writeArticle') }}">
                            記事を書く
                        </a>
                        @else
                        <span id="attend">
                        @inject('attendService', 'App\Services\AttendServiceInterface')
                        @if(Auth::guard('home')->user() && $attendService->isAttendUser(Auth::guard('home')->user()->id, $user->id) == true)
                        <a href="javascript:void(0);" class="Follow">
                        フォロー中
                        </a>
                        @else
                        <a href="javascript:void(0);" class="notFollow">
                        フォローする
                        </a>
                        @endif
                        </span>
                        @endif

                    </div>

                    <!-- 会员行为部分  -->
                    <div class="user-widget user-info-items">
                        <div class="action-content">
                            <div class="action">
                                <a href="{{ route('user.share',[ $id ]) }}">
                                    <span class=""><i class="fa fa-book"></i>&nbsp;&nbsp;記事リスト</span>
                                </a>
                            </div>
                            <div class="action">
                                <a href="{{ route('user.comment',[ $id ]) }}">
                                    <span class=""><i class="fa fa-comment-o"></i>&nbsp;&nbsp;コメント</span>
                                </a>
                            </div>
                            <div class="action">
                                <a href="{{ route('user.attend',[ $id ]) }}">
                                    <span class=""><i class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;フォロー中</span>
                                </a>
                            </div>
                            <div class="action">
                                <a href="{{ route('user.like',[ $id ]) }}">
                                    <span class=""><i class="fa fa-heart-o"></i>&nbsp;&nbsp;いいね！</span>
                                </a>
                            </div>
                            <div class="action">
                                <a href="{{ route('user.stores',[ $id ]) }}">
                                    <span class=""><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;ブックマーク</span>
                                </a>
                            </div>
                        </div>
                    </div>


                    @if (Auth::guard('home')->check())
                        <input type="hidden" name="visitor_id" id="visitor_id" value="{{ Auth::guard('home')->user()->id }}">
                    @else
                        <input type="hidden" name="visitor_id" id="visitor_id" value="visitor">
                    @endif

                </div>

                <div class="user-page">
                    <div id="myScrollspy" class="scroll_spy">
                        <ul id="affix_ui" class="nav nav-tabs nav-stacked" data-spy="affix" data-offset-top="750" style="border: 0 solid #000;">
                            {{--<li>--}}
                                {{--<a id="guide_index" href="javascript:void(0);">目次</a>--}}
                            {{--</li>--}}
                            {{--<li class="active">--}}
                            {{--<a href="#section-1">第一部分 </a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#section-2">第二部分</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#section-3">第三部分</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#section-4">第四部分</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#section-4">第五部分</a>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </div>

            </div><!-- left-content -->

            <div class="right-content col-md-9">
                @yield('content')
                @yield('commentList')
                @yield('comment')
            </div><!-- right-content -->

            <a style="display:none" href="javascript:void(0);"  id="backToTop"  title="トップへ"></a>
            {{--<div id="backToTop"><a href="#user-header">トップへ</a></div>--}}

        </div><!-- row -->
    </div><!-- container -->
</section>
@endsection

@section('script')

    @yield('script')
    @yield('shareScript')
    @yield('commentScript')
    @yield('likeScript')
    @yield('storeScript')
@endsection

@section('userScript')
    <script>
        // 关注功能
        $("#attend").click(function () {
            if("{{ !Auth::guard('home')->user()}}") {
                swal({
                    title: "ようこそゲストさん",
                    text: "アカウントを持っていますか?",
                    buttons: {
                        cancel: "キャンセル",
                        register: "新規登録",
                        login: "ログイン",
                    }
                })
                    .then((wilDo) => {
                        switch (wilDo) {
                            case "cancel":
                                break;
                            case "login":
                                window.location.href = "{{ url('/login') }}";
                                break;
                            case "register":
                                window.location.href = "{{ url('/register') }}";
                                break;
                        }
                    });
                return;
            }
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "post",
                url: "{{ url('/clickToAttend') }}",
                data: {'user_id': $("#visitor_id").val(),
                    'attend_user_id': '{{ $user->id }}',
                    'created_at': '{{ date('Y-m-d H:i:s') }}',
                },
                success: function (response) {
                    if (response.data.status == true) {
                        if(response.data.judge == 'down'){
                            $(".Follow").text('フォローする');
                            $(".Follow").css("background-color", "rgba(246, 119, 119, 0.9)");
                            $(".Follow").addClass("notFollow");
                            $(".Follow").removeClass("Follow");

                        }else{
                            $(".notFollow").text('フォロー中');
                            $(".notFollow").css("background-color", "rgba(246, 119, 119, 0.6)");
                            $(".notFollow").addClass("Follow");
                            $(".notFollow").removeClass("notFollow");
                        }
                        $("#attend").show();
                    }else {
                        swal("提示", response.msg, "error");
                    }
                },
                error: function () {
                    swal("提示", "发生未知错误", "error");
                },
            });
        });
    </script>
@endsection