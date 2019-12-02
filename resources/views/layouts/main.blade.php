<!DOCTYPE html>
<html lang="ja">
<head>
    <!------------------------------------------------------------------------------------------------------>
    <!------------------------------------------------meta-------------------------------------------------->
    <!------------------------------------------------------------------------------------------------------>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="カシュンヨウのブログ">
    <meta name="author" content="カシュンヨウ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 开发阶段不需要页面缓存 -->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">

    <title>カシュンヨウのブログ</title>

    <!------------------------------------------------------------------------------------------------------>
    <!----------------------------------------------CSS link------------------------------------------------>
    <!------------------------------------------------------------------------------------------------------>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('/assets/common/bootstrap-3.1.1/css/bootstrap.min.css')}}">
    <!-- Custom Fonts 各种图标-->
    <link rel="stylesheet" href="{{asset('/assets/common/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('/assets/frontend/owl-carousel-v1.3.3/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/frontend/owl-carousel-v1.3.3/owl.theme.css')}}">
    <!-- simplemde -->
    <link rel="stylesheet" href="https://simplemde.com/stylesheets/stylesheet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <!-- owl-carousel-v1.3.3 -->
    <link rel="stylesheet" href="{{asset('/assets/frontend/owl-carousel-v1.3.3/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/frontend/owl-carousel-v1.3.3/owl.theme.css')}}">
    <!-- Custom CSS 自定义的css内容 -->
    <link rel="stylesheet" href="{{asset('/assets/frontend/custom/style.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">

    <!------------------------------------------------------------------------------------------------------>
    <!----------------------------------------------JS script----------------------------------------------->
    <!------------------------------------------------------------------------------------------------------>
    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('/assets/common/jquery-1.11.2/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script type="text/javascript" src="{{ asset('/assets/common/bootstrap-3.1.1/js/bootstrap.js')}}"></script>
    <!-- simplemde -->
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <!-- sweetalert -->
    <script type="text/javascript" src="{{ asset('/assets/common/sweetalert/dist/sweetalert.min.js')}}"></script>
    <!-- owl-carousel-v1.3.3 -->
    <script type="text/javascript" src="{{ asset('/assets/frontend/owl-carousel-v1.3.3/owl.carousel.js')}}"></script>

    {{--<script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>--}}
</head>


<!------------------------------------------------------------------------------------------------------>
<!---------------------------------------------CSS style------------------------------------------------>
<!------------------------------------------------------------------------------------------------------>
<style>
    .swal-title {
        margin: 0;
        font-size: 20px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.21);
        margin-bottom: 28px;
    }
    .swal-button--login,
    .swal-button--register,
    .swal-button--confirm
    {
        background-color: rgba(246, 119, 119, 1);
    }
    .swal-button--login:hover,
    .swal-button--register:hover,
    .swal-button--confirm:hover
    {
        background-color: rgba(246, 119, 119, 0.9)!important;
    }

    .CodeMirror .cm-spell-error:not(.cm-url):not(.cm-comment):not(.cm-tag):not(.cm-word) {
        background: inherit;
    }

    .CodeMirror-fullscreen {
        position: fixed;
        top: 142px; left: 0; right: 0; bottom: 0;
        height: auto;
        z-index: 9;
    }
    .editor-toolbar.fullscreen {
        top: 94px; left: 0; right: 0; bottom: 0;
    }
    .editor-preview-side.editor-preview-active-side {
        top: 142px;
    }


    /*高亮部分*/
    /*#mainText h3{*/
    /*border-left: 6px solid #ffc672;*/
    /*padding: 10px 0 10px 8px;*/
    /*color: #000;*/
    /*background-color: rgba(255, 198, 114, 0.2);*/
    /*!*background-color: rgba(100, 100, 100, 0.1);*!*/
    /*!*padding: 10px 5px;*!*/
    /*!*border-top: 1px solid rgba(100, 100, 100, 0.3);*!*/
    /*!*border-bottom: 1px solid rgba(100, 100, 100, 0.2);*!*/
    /*!*color: #000;*!*/
    /*}*/
    /*#mainText h3{*/
        /*!*border-left: 6px solid rgba(246, 119, 119, 1);*!*/
        /*padding: 10px 0 10px 8px;*/
        /*color: #000;*/
        /*background-color: rgba(246, 119, 119, 0.1);*/
        /*margin-bottom: 10px;*/
        /*margin-top: 16px;*/
        /*font-weight: bold;*/
    /*}*/
    /*#mainText h4{*/
        /*!*border-bottom: 3px solid rgba(246, 119, 119, 1);*!*/
        /*padding: 20px 0 10px 8px;*/
        /*color: #7f3f7a;*/
        /*font-weight: bold;*/
        /*!*background-color: rgba(246, 119, 119, 0.1);*!*/
    /*}*/
    /*#mainText p{*/
        /*margin-top: 12px;*/
        /*margin-bottom: 12px;*/
        /*color: #000;*/
    /*}*/
    #commentAdd p{
        margin-top: 4px;
        margin-bottom: 8px;
    }
    #replyComment p{
        margin-top: 4px;
        margin-bottom: 8px;
    }
    /*#mainText pre {*/
        /*!*background-color: #323130;*!*/
        /*background-color: rgba(255, 198, 114, 0.08);*/
        /*color: #000;*/
        /*border-top: 5px dotted #ffc672;*/
        /*border-bottom: 5px dotted #ffc672;*/
        /*border-left: 0;*/
        /*border-right: 0;*/
        /*font-size: 16px;*/
    /*}*/
    /*#mainText pre > code {*/
        /*padding-bottom: 10px;*/
    /*}*/
    #commentAdd pre {
        background-color: rgba(255, 198, 114, 0.02);
        color: #000;
        border: 5px dotted #ffc672;
        font-size: 16px;
    }
    #replyComment pre {
        background-color: rgba(255, 198, 114, 0.02);
        color: #000;
        border: 5px dotted #ffc672;
        font-size: 16px;
    }
    .comment_main_content pre {
        background-color: rgba(255, 198, 114, 0.08);
        color: #000;
        border: 5px dotted #ffc672;
        font-size: 16px;
    }
    /*img*/
    /*#mainText img {*/
    /*padding: 10px;*/
    /*}*/
    /*#mainText p a {*/
    /*color: #ff1a89;*/
    /*}*/

    /*table部分*/
    table
    {
        border-collapse: collapse;
        /*margin: 0 auto;*/
        text-align: center;
    }
    table td,
    table th
    {
        border: 1px solid #cad9ea;
        color: #666;
        height: 30px;
    }
    table thead th
    {
        background-color: #CCE8EB;
        /*width: 200px;*/
        text-align: center;
    }
    table tbody td
    {
        min-width: 100px;
    }
    table tr:nth-child(odd)
    {
        background: #fff;
    }
    table tr:nth-child(even)
    {
        background: #F5FAFA;
    }


    /* Custom Styles */
    /*#myScrollspy ul.nav-tabs{*/
        /*!*text-align: center;*!*/
        /*!*width: 100%;*!*/
        /*margin-top: 20px;*/
        /*margin-bottom: 20px;*/
        /*background: #fff;*/
        /*!*border-radius: 4px;*!*/
        /*!*border: 1px solid #ddd;*!*/
        /*!*box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);*!*/
    /*}*/
    .scroll_spy ul.nav-tabs #guide_index{
        font-size: 18px;
    }
    .scroll_spy ul.nav-tabs li{
        margin: 0;
        border-top: 1px solid #ddd;
        background: #fff;
    }
    .scroll_spy ul.nav-tabs li:first-child{
        border-top: none;
    }
    .scroll_spy ul.nav-tabs li a{
        margin: 0;
        padding: 8px 16px;
        border-radius: 0;
    }

    /*.scroll_spy ul.nav-tabs li a,*/
    /*.scroll_spy ul.nav-tabs li.active a:link,*/
    /*.scroll_spy ul.nav-tabs li a:link{*/
        /*color: #000;*/
        /*background: #fff;!important;*/
        /*border: 0 solid #F67777;!important;*/
        /*box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);!important;*/
    /*}*/


    /*.scroll_spy ul.nav-tabs li.active a:visited,*/
    /*.scroll_spy ul.nav-tabs li a:visited{*/
        /*color: #000;*/
        /*background: #fff;!important;*/
        /*border: 0 solid #F67777;!important;*/
        /*box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);!important;*/
    /*}*/

    /*.scroll_spy ul.nav-tabs li.active a,*/
    /*.scroll_spy ul.nav-tabs li.active a:hover{*/
        /*color: #fff;*/
        /*background: #F67777;!important;*/
        /*border: 0 solid #F67777;!important;*/
        /*box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);!important;*/
    /*}*/

    .scroll_spy ul.nav-tabs li.active a,
    .scroll_spy ul.nav-tabs li.active a:hover{
        color: #000;
        background: #fff;!important;
        border: 0 solid #F67777;!important;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);!important;
    }

    .scroll_spy ul.nav-tabs li a,
    .scroll_spy ul.nav-tabs li a:hover{
        color: #000;
        background: #fff;!important;
        border: 0 solid #F67777;!important;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);!important;
    }

    .scroll_spy ul.nav-tabs li.my_active a,
    .scroll_spy ul.nav-tabs li.my_active a:hover{
        color: #fff;
        background: #F67777;!important;
        border: 1px solid #F67777;!important;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.067);!important;
    }

    /*#myScrollspy ul.nav-tabs li.active a, #affix_ui ul.nav-tabs li a.active {*/
        /*color: #000;*/
        /*background: #fff;*/
        /*border: 0 solid #F67777;*/
    /*}*/
    /*#affix_ui ul.nav-tabs li.my_active,*/
    /*#affix_ui ul.nav-tabs li.my_active a,*/
    /*#affix_ui ul.nav-tabs li.my_active a:hover {*/
    /*color: #fff;*/
    /*background: #F67777;!important;*/
    /*border: 0 solid #F67777;!important;*/
    /*}*/


    #myScrollspy ul.nav-tabs.affix {
        background-color: #fff;
        top: 116px; /* Set the top position of pinned element */
    }
    #myScrollspy div.affix {
        /*background-color: #fff;*/
        top: 116px; /* Set the top position of pinned element */
    }

    /*div#backToTop{*/
        /*position:fixed;*/
        /*display:none;*/
        /*bottom:20px;*/
        /*right:20px;*/
    /*}*/

    #backToTop {
        z-index:3000;
        width:48px;
        height: 48px;
        position:fixed;
        right:35px;
        bottom:30px;
        background:url(/assets/images/userAvatars/go_to_top.jpeg)  center / cover ;
    }
    /*#backToTop:hover {*/
        /*background:url(/assets/images/userAvatars/avatar_01.jpg)  no-repeat  -48px top;*/
    /*}*/

</style>

@yield('style')
@yield('mainStyle')
@yield('draft-style')


<body data-spy="scroll" data-target="#myScrollspy" style="opacity: 0;background-color: #fff7e1;!important;">

<header id="header" style="min-height: 70px;">

    <div class="header-line"></div>

    <nav class="navbar navbar-fixed-top">

        <div id="up_nav" class="container-fluid" style="background-color: #f67777;padding-left: 0;padding-right: 0;">
            <div class="container" style="padding-left: 30px;margin-bottom: 10px;margin-top: 10px;min-width: 720px;">
                @if (Auth::guard('home')->check())
                    <span>
                            <span style="font-size: 16px;color: #fff;">
                                こんにちは!&nbsp;&nbsp;{{ Auth::guard('home')->user()->user_name }}
                            </span>
                            &nbsp;&nbsp;&nbsp;
                            <a href="{{ route('user.account', ['id' => Auth::guard('home')->user()->id ]) }}" class="my_tag_2">
                                アカウント
                            </a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="{{ route('user.page', ['id' => Auth::guard('home')->user()->id ]) }}" class="my_tag_2">
                                マイページ
                            </a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="{{ url('/writeArticle') }}" class="my_tag_2">
                                記事を書く
                            </a>
                            {{--&nbsp;&nbsp;&nbsp;--}}
                            {{--<a href="{{ url('/user/notice') }}" class="my_tag_2">--}}
                                {{--メッセージ--}}
                            {{--</a>--}}
                            &nbsp;&nbsp;&nbsp;
                            <a href="{{ url('/logout') }}" class="my_tag_2">
                                ログアウト
                            </a>
                        </span>
                @else
                    <span>
                        <span style="font-size: 18px;color: #fff;">ようこそ「HJYのブログ」へ</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{url('/login')}}" class="my_tag_2">ログイン</a>
                        &nbsp;&nbsp; <span style="font-size: 14px;color: #fff;">or</span> &nbsp;&nbsp;
                        <a href="{{url('/register')}}" class="my_tag_2">新規登録</a>
                        </span>
                @endif
            </div>

        </div>

        <div id="down_nav" class="container-fluid" style="background-color: #fff;padding-left: 0;padding-right: 0;">
            <div class="container">

                <div class="navbar-header">
                    <button type="button" style="background-color: #F67777!important;padding-right: 10px;" class="navbar-toggle collaplsed" data-toggle="collapse" data-target="#navigation" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar" style="background-color: #fff;"></span>
                        <span class="icon-bar" style="background-color: #fff;"></span>
                        <span class="icon-bar" style="background-color: #fff;"></span>
                    </button>
                </div>


                {{--<div class="col-md-9 col-sm-9 col-xs-9">--}}

                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="nav navbar-nav my_nav">
                        <li><a href="/">ホーム</a></li>
                        <li class="dropdown mega-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">アプリ開発<span class="caret"></span></a>
                            <div class="dropdown-menu" style="min-width: 400px;">
                                <div class="menu-top" style="width: 100%;">
                                    <div class="col1" style="width: 50%;">
                                        <div class="h_nav">
                                            <h4>フロントエンド</h4>
                                            <ul>
                                                @foreach ($pageElement['categoryData'] as $category)
                                                    @if($category['code'] == 1)
                                                        @if($category['level'] == 0)
                                                        @elseif($category['level'] == 1)
                                                            <li><a class="sub_category" href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}"><span>{{$category['name']}}</span></a></li>
                                                        @elseif($category['level'] > 1)
                                                            <li><a href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}">→&nbsp;&nbsp;&nbsp;{{$category['name']}}</a></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col2" style="width: 50%;">
                                        <div class="h_nav">
                                            <h4>バックエンド</h4>
                                            <ul>
                                                @foreach ($pageElement['categoryData'] as $category)
                                                    @if($category['code'] == 2)
                                                        @if($category['level'] == 0)
                                                        @elseif($category['level'] == 1)
                                                            <li><a class="sub_category" href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}"><span>{{$category['name']}}</span></a></li>
                                                        @elseif($category['level'] > 1)
                                                            <li><a href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}">→&nbsp;&nbsp;&nbsp;{{$category['name']}}</a></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    {{--<div class="col3">--}}
                                        {{--<div class="h_nav">--}}
                                            {{--<h4>クライアント系</h4>--}}
                                            {{--<ul>--}}
                                                {{--@foreach ($pageElement['categoryData'] as $category)--}}
                                                    {{--@if($category['code'] == 3)--}}
                                                        {{--@if($category['level'] == 0)--}}
                                                        {{--@elseif($category['level'] == 1)--}}
                                                            {{--<li><a class="sub_category" href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}"><span>{{$category['name']}}</span></a></li>--}}
                                                        {{--@elseif($category['level'] > 1)--}}
                                                            {{--<li><a href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}">→&nbsp;&nbsp;&nbsp;{{$category['name']}}</a></li>--}}
                                                        {{--@endif--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown mega-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">データベース<span class="caret"></span></a>
                            <div class="dropdown-menu" style="min-width: 160px;">
                                <div class="menu-top" style="width: 100%;">
                                    <div class="col1" style="width: 100%;">
                                        <div class="h_nav">
                                            <ul>
                                                @foreach ($pageElement['categoryData'] as $category)
                                                    @if($category['code'] == 4)
                                                        @if($category['level'] == 0)
                                                        @elseif($category['level'] == 1)
                                                            <li><a class="sub_category" href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}"><span>{{$category['name']}}</span></a></li>
                                                        @elseif($category['level'] > 1)
                                                            <li><a href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}">→&nbsp;&nbsp;&nbsp;{{$category['name']}}</a></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown mega-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">サーバー<span class="caret"></span></a>
                            <div class="dropdown-menu" style="min-width: 160px;">
                                <div class="menu-top" style="width: 100%;">
                                    <div class="col1" style="width: 100%;">
                                        <div class="h_nav">
                                            <ul>
                                                @foreach ($pageElement['categoryData'] as $category)
                                                    @if($category['code'] == 5)
                                                        @if($category['level'] == 0)
                                                        @elseif($category['level'] == 1)
                                                            <li><a class="sub_category" href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}"><span>{{$category['name']}}</span></a></li>
                                                        @elseif($category['level'] > 1)
                                                            <li><a href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}">→&nbsp;&nbsp;&nbsp;{{$category['name']}}</a></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown mega-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">基礎知識<span class="caret"></span></a>
                            <div class="dropdown-menu" style="min-width: 240px;">
                                <div class="menu-top" style="width: 100%;">
                                    <div class="col1" style="width: 100%;">
                                        <div class="h_nav">
                                            <ul>
                                                @foreach ($pageElement['categoryData'] as $category)
                                                    @if($category['code'] == 6)
                                                        @if($category['level'] == 0)
                                                        @elseif($category['level'] == 1)
                                                            <li><a class="sub_category" href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}"><span>{{$category['name']}}</span></a></li>
                                                        @elseif($category['level'] > 1)
                                                            <li><a href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}">→&nbsp;&nbsp;&nbsp;{{$category['name']}}</a></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </li>

                        <li class="dropdown mega-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">その他<span class="caret"></span></a>
                            <div class="dropdown-menu" style="min-width: 340px;">
                                <div class="menu-top" style="width: 100%;">
                                    <div class="col1" style="width: 50%;">
                                        <div class="h_nav">
                                            <h4>ソフトウェア</h4>
                                            <ul>
                                                @foreach ($pageElement['categoryData'] as $category)
                                                    @if($category['code'] == 7)
                                                        @if($category['level'] == 0)
                                                        @elseif($category['level'] == 1)
                                                            <li><a class="sub_category" href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}"><span>{{$category['name']}}</span></a></li>
                                                        @elseif($category['level'] > 1)
                                                            <li><a href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}">→&nbsp;&nbsp;&nbsp;{{$category['name']}}</a></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    {{--<div class="col1" style="width: 30%;">--}}
                                        {{--<div class="h_nav">--}}
                                            {{--<h4>写真</h4>--}}
                                            {{--<ul>--}}
                                                {{--@foreach ($pageElement['categoryData'] as $category)--}}
                                                    {{--@if($category['code'] == 34)--}}
                                                        {{--@if($category['level'] == 0)--}}
                                                        {{--@elseif($category['level'] == 1)--}}
                                                            {{--<li><a class="sub_category" href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}"><span>{{$category['name']}}</span></a></li>--}}
                                                        {{--@elseif($category['level'] > 1)--}}
                                                            {{--<li><a href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}">→&nbsp;&nbsp;&nbsp;{{$category['name']}}</a></li>--}}
                                                        {{--@endif--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                        {{--<div class="clearfix"></div>--}}
                                    {{--</div>--}}
                                    <div class="col1" style="width: 50%;">
                                        <div class="h_nav">
                                            <h4>語学</h4>
                                            <ul>
                                                @foreach ($pageElement['categoryData'] as $category)
                                                    @if($category['code'] == 37)
                                                        @if($category['level'] == 0)
                                                        @elseif($category['level'] == 1)
                                                            <li><a class="sub_category" href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}"><span>{{$category['name']}}</span></a></li>
                                                        @elseif($category['level'] > 1)
                                                            <li><a href="{{ route('category.articles',[ $category['name'] ]) }}" id="{{$category['id']}}">→&nbsp;&nbsp;&nbsp;{{$category['name']}}</a></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                {{--</div>--}}

                {{--<div class="col-md-3 col-sm-3 col-xs-12">--}}

                {{--</div>--}}


            </div>
            <div class="header-line"></div>
        </div>
    </nav>
</header>

<div style="min-height: 40px;visibility: hidden"></div>

@yield('navList')
{{--首页主体内容(左右内容)--}}
@yield('main')

<div style="height: 80px;">

</div>

<div class="footer container-fluid" style="bottom: 50px;text-align: center;">
    <div>
        Copyright &nbsp; © &nbsp; 2019 &nbsp; HJYのブログ &nbsp; by &nbsp; カ シュンヨウ
    </div>
    <div style="font-size: 18px;">
        All &nbsp; Rights &nbsp; Reserved
    </div>

</div>


</body>

<script>
    ////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////文章高亮渲染///////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////


    var color_array = ['#009900', '#2a00ff', '#f67d00', '#ff1a89', '#7f0055', '#087f6e', '#400999', '#646161', '#000'];
    var replace_code = ['<', '>'];
    // var replace_code_11 = ['php', '/title(?=(8>8))', 'title(?=(8>8))'];
    var stl_container = ['(?<=(8<8))[0-9a-z]+[,{1}][\\s?][0-9a-z]+(?=(8>8))'];
    //html
    var html_label = ['(?<=(8<8))/[0-9a-z]+(?=(8>8))', '(?<=(8<8))[0-9a-z]+(?=(8>8)|[\\s{1}])', '!DOCTYPE html', '(?<=8[\<]8)[?]php'];
    //var html_label = ['(?<=(8<8))/[0-9a-z]+(?=(8>8)| )', '(?<=(8<8))[0-9a-z]+(?=(8>8)| )', '!DOCTYPE html'];
    //str
    var html_str = ['(?<!(font color=)|(font color="#[0-9a-zA-Z]+))"\\S*?"'];
    //style
    var html_style_number = ['[0-9]+(?=px;)'];
    var html_style_px = ['px(?=[;]|[\\s{1}])'];
    var html_symbol = [';', '[\$](?=[(])', '(?<=[&])nbsp(?=[;])'];
    //program languages
    var program_languages_function = ['[\.][0-9a-zA-Z_]+(?=[(])', '[\\s{1}][0-9a-zA-Z_]+(?=[(])',
        '(?<=[)]|[:{2}]|[\[])[0-9a-zA-Z_]+(?=[(])'];
    //var program_languages_function = ['[\.][0-9a-zA-Z_]+(?=[(]|[;]|[\\s{1}])', '[\\s{1}][0-9a-zA-Z_]+(?=[(])'];
    var program_languages_keyword = ['function(?=[\\s{1}])', 'var(?=[\\s{1}])', '(?<=[\\s{1}])if', 'else', 'return ',
        'break', '(?<=[\\s{1}])for', '(?<![_])foreach(?=[\\s{1}])', '(?<![_])class(?=[\\s{1}])', 'extends', 'implements', 'interface',
        '(?<=[\\s{1}])public(?=[\\s{1}]|[:{1}])', '(?<=[\\s{1}])protected(?=[\\s{1}]|[:{1}])', '(?<=[\\s{1}])private(?=[\\s{1}]|[:{1}])',
        'const(?=[\\s{1}])', 'new(?=[\\s{1}])', 'this', 'void', 'using namespace', 'namespace', 'enum', 'template', 'virtual(?=[\\s{1}])',
        '(?<=[\\s{1}])struct(?=[\\s{1}])', 'typedef(?=[\\s{1}])', 'inline(?=[\\s{1}])', 'friend(?=[\\s{1}])', 'operator',
        'static(?=[\\s{1}])', 'static_cast', 'reinterpret_cast', 'dynamic_cast', 'const_cast', 'try', 'catch(?=[\\s{1}]|[(])',
        'throw', 'unsigned', 'long(?=[\\s{1}])', 'NULL', 'nil', 'let(?=[\\s{1}])', 'goto'];
    var program_languages_keyword_2 = ['stdio.h', 'stdlib.h', 'string.h', 'ctype.h(?=8)', '(?<=[\\s?]|[({1}]|[<])int(?![a-zA-Z0-9_]+)',
        'int(?=[\,])','string(?![\"]|[_])', 'double', 'char(?=[\\s{1}]|[\*]|[&]|[\[])', 'bool(?=[\\s{1}])'];
    var program_languages_keyword_3 = ['#include', '#define', '#undef', '#ifndef', '#endif', '8<88<8', '8>88>8'];

    var modify = '';
    var new_str = '';
    var middle_str = '';

    function render_markdown_content_first_step(modify) {
        middle_str = modify;
        //alert(middle_str);
        render_action();
        //alert(middle_str);
        new_str = middle_str;
        return new_str;
    }

    function render_action() {
        replace_code_html(replace_code);
        //alert(middle_str);
        render_code_html(stl_container, color_array[8]);
        render_code_html(html_label, color_array[4]);
        //alert(middle_str);
        render_code_html(html_str, color_array[1]);
        //alert(middle_str);
        render_code_html(html_style_number, color_array[1]);
        //alert(middle_str);
        render_code_html(html_style_px, color_array[0]);
        //console.log(middle_str);
        //alert(middle_str);
        render_code_html(program_languages_function, color_array[5]);
        //console.log(middle_str);
        //alert(middle_str);
        render_code_html(program_languages_keyword, color_array[3]);
        render_code_html(program_languages_keyword_2, color_array[6]);
        render_code_html(program_languages_keyword_3, color_array[2]);
        //console.log(middle_str);
        //alert(middle_str);
        render_code_html(html_symbol, color_array[3]);
        //console.log(middle_str);
        //alert(middle_str);
        remove_add_element();
    }
    function replace_code_html(replace_code) {

        replace_code.forEach(function (content, index) {
            var reg = new RegExp(content, 'g');
            middle_str = middle_str.replace(reg, function (replace_content) {
                return "8" + replace_content + "8";
            })
        });

    }
    function render_code_html(render,color) {
        render.forEach(function (content, index) {
            //console.log(content);
            var reg = new RegExp(content, 'g');
            middle_str = middle_str.replace(reg, function (replace_content) {
                //console.log(content + " " + replace_content);
                return replace_content.fontcolor(color);
            })
        });
    }
    function remove_add_element() {
        // if(middle_str.indexOf('8<8')){
        //     middle_str = middle_str.replace(/8<8/g,  '<code>' + '<' + '</code>');
        // }
        // if(modify.indexOf('8>8')){
        //     middle_str = middle_str.replace(/8>8/g,  '<code>' + '>' + '</code>');
        // }
        if(middle_str.indexOf('8<8')){
            middle_str = middle_str.replace(/8<8/g,  '<');
        }
        if(modify.indexOf('8>8')){
            middle_str = middle_str.replace(/8>8/g,  '>');
        }
    }
    function replace_element(markdown_content) {

        //给添加的link加上target="_blank"属性
        if(markdown_content.indexOf("<a href=")) {
            markdown_content = markdown_content.replace(/<a href=/g, "<a target=_blank href=");
        }
        if(markdown_content.indexOf('&lt;')){
            markdown_content = markdown_content.replace(/&lt;/g,  '<');
        }
        if(markdown_content.indexOf('&gt;')){
            markdown_content = markdown_content.replace(/&gt;/g,  '>');
        }
        if(markdown_content.indexOf('&quot;')){
            markdown_content = markdown_content.replace(/&quot;/g,  '"');
        }
        return markdown_content;
    }

</script>

<script>

    //code区域滑动条
    function code_overflow() {

        var code_height;
        var code_width;
        $("#mainText pre>code").each(function (key, value) {
            code_width = parseInt($(this).css("width").slice(0, -2)) * 1.6;
            $(this).parent().css("position", "relative");
            $(this).css("width", code_width).css("position", "absolute").css("overflow", "hidden");
            code_height = parseInt($(this).css("height").slice(0, -2)) + 26;
            $(this).parent().css("height", code_height);
        });
    }

    //scroll_spy and affix
    function myScrollspy() {

        var myScrollspy_str = '';
        myScrollspy_str += '<li>\n' +
            '<a id="guide_index" href="javascript:void(0);">目次</a>\n' +
            '</li>';

        $("#mainText h2").each(function (key, value) {
            $(this).attr("id", "nav" + key);
            myScrollspy_str += '<li>\n' +
                '<a class="click" href="#' + $(this).attr("id") + '">' +
                ($(this).attr("id").substr(3) - 0 + 1) + ". " + "&nbsp;" +
                $(this).text() + '</a>\n' +
                '</li>';
        });

        $("#myScrollspy > ul").append(myScrollspy_str);
        //$("#affix_ui").children().eq(1).addClass("active");

    }


    //当DOM（文档对象模型）已经加载，并且页面（包括图像）已经完全呈现时，会发生ready事件。
    $(document).ready(function() {

        $('body').css('opacity',1);

        //注册affix附加导航栏和回到顶部的滚动事件,以及affix附加导航栏和回到顶部的点击事件

        //确定h2标题的个数以及各个data_top的值
        var data_top = [];
        var data_length = 0;
        $(".click").each(function (key, value) {
            //$(this.hash)存储了#锚点后面的页面值
            data_top[key] = $(this.hash).offset().top - 100;
            ++data_length;
            //console.log(data_top[key]);
        });
        var data_item = $(".click").parent(); // <li></li>
        var scroll_height = (document.body.scrollHeight == 0) ? document.documentElement.scrollHeight : document.body.scrollHeight;
        var visible_workplace_height = document.documentElement.clientHeight;


        //滚动事件
        $(document).scroll(function () {

            //回到顶部功能(回到顶部按钮的出现和消失)
            if ($(window).scrollTop() > visible_workplace_height){
                $("#backToTop").fadeIn(500);
            }
            else
            {
                $("#backToTop").fadeOut(500);
            }

            //affix附加导航栏
            var scroll_top = (document.body.scrollTop == 0) ? document.documentElement.scrollTop : document.body.scrollTop;
            //1.如果没有元素
            if(data_length == 0) {
                //console.log("1");
                return;
            }
            //2.如果至少有一个元素且滑动位置还不到data_top[0]时
            if(scroll_top < data_top[0]) {
                //console.log("2");
                return;
            }
            //3.如果至少有一个元素且滑动位置到达data_top[0]时
            if(scroll_top > data_top[0]) {
                //如果只有一个元素
                if(data_length == 1) {
                    data_item.eq(0).addClass("my_active");
                    //console.log("3");
                    return;
                //如果有大于一个元素且还没到data_top[1]时
                }else if(scroll_top < data_top[1]) {
                    data_item.removeClass("my_active");
                    data_item.eq(0).addClass("my_active");
                    //data_item.eq(0).addClass("my_active");
                    //data_item.eq(1).removeClass("my_active");
                    //console.log("4");
                    // data_item.eq(2).removeClass("my_active");
                    // data_item.eq(3).removeClass("my_active");
                    return;
                }
            }


            //4.如果元素大于等于3个时
            for (var i = 1; i < data_length-1; ++i) {
                //if ( (data_top[i+1] > scroll_top) && (scroll_top > data_top[i]) && (parseInt(scroll_height - scroll_top) != parseInt(visible_workplace_height))) {
                if ( (data_top[i+1] > scroll_top) && (scroll_top > data_top[i]) ) {
                //     data_item.removeClass("my_active");
                //     data_item.eq(i).addClass("my_active");
                    data_item.eq(i).addClass("my_active");
                    data_item.eq(i-1).removeClass("my_active");
                    data_item.eq(i-2).removeClass("my_active");
                    data_item.eq(i+1).removeClass("my_active");
                    data_item.eq(i+2).removeClass("my_active");
                    //console.log("5");
                    break;
                }
            }

            //5.当能滑动到大于最后一个data_top时(对于有大于等于2个元素都适用)
            if(scroll_top > data_top[data_length-1]) {
                data_item.eq(data_length-2).removeClass("my_active");
                data_item.eq(data_length-1).addClass("my_active");
                data_item.eq(data_length).removeClass("my_active");
                //console.log("6");
                return;
            }

            //6.当滑动到最后时
            if(parseInt(scroll_height - scroll_top) <= parseInt(visible_workplace_height)) {
                //如果不能滑动到大于最后一个data_top时
                if(scroll_height - data_top[data_length-1] < (visible_workplace_height)) {
                    data_item.eq(data_length-1).addClass("my_active");
                    data_item.eq(data_length-2).removeClass("my_active");
                    data_item.eq(data_length-3).removeClass("my_active");
                    // data_item.eq(data_length-4).removeClass("my_active");
                    //console.log("7");
                    return;
                }
            }
        });


        //点击事件

        //回到顶部功能
        //当点击跳转链接后，回到页面顶部位置
        var topTimer = null;
        $("#backToTop").click(function(){
            topTimer = setInterval(function () {
                var backtop = (document.body.scrollTop == 0) ? document.documentElement.scrollTop : document.body.scrollTop; //速度操作  减速
                var speedtop = backtop/5;
                if(document.body.scrollTop == 0) {
                    document.documentElement.scrollTop = backtop - speedtop;  //高度不断减少
                }else {
                    document.body.scrollTop = backtop - speedtop;  //高度不断减少
                }
                if(backtop == 0){  //滑动到顶端
                    clearInterval(topTimer);  //清除计时器
                }
            }, 30);
            return false;
        });

        //affix附加导航栏
        $(".click").each(function () {
            $(this).click(function(){
                var $target = $(this.hash);
                var targetOffset = $target.offset().top;
                $('html,body').animate({scrollTop: targetOffset - 99 },800);
                return false;
            });
        });
        //浏览器大小改变时保持页面宽度一致的方法
        //初始化
        $(function(){
            scroll_fix(); //载入数据
        });
        //页面改变事件
        window.onresize = function(){
            scroll_fix();
        };
        //更新数据
        function scroll_fix() {
            $("#affix_ui").width($(".scroll_spy").width());
        }


        //nav的分类栏目的鼠标进入和离开
        $(".dropdown-toggle").hover(
            function(){
                $(this).parent().addClass("open");
                var open_number = $(".dropdown.open").length;
                if(open_number == 2) {
                    $(".dropdown.open").removeClass("open");
                    $(this).parent().addClass("open");
                }else {
                }
            },
            function(){
                if($(".dropdown-menu:hover").length == 0) {
                    $(".dropdown.open").removeClass("open");
                }
            }
        );
        $(".dropdown-menu").hover(
            function () {

            },
            function () {
                $(".dropdown.open").removeClass("open");
            }
        );

    });

    ////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////frontPage/////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////

    //frontPage
    var front_current_page = 1,  //当前页
        front_current_first_item = 0,  //当前页码的第一个条目的索引
        front_page_size = 10, //自定义分页大小----------1
        front_page_number = 1;  //分页数量
    var front_totalPage = $("#front-items li").length; //为了实时计算页数-----------2
    var front_prev_btn = $("#front_prev");
    var front_next_btn = $("#front_next");

    function frontPage(my_front_page_size) {
        front_page_size = my_front_page_size;

        //初始化页面,根据自定义分页大小显示数据
        $("#front-items li").each(function () {
            if(front_current_first_item < front_page_size){
                //$("#front-items li").eq(front_current_first_item).css('display','');
                $("#front-items li").eq(front_current_first_item).fadeIn(500);
                ++front_current_first_item;
            }
        });
        //为了美观
        //如果一开始条目数量少于front_page_size的话,改变min-height而让表格显示更好看
        // if(front_totalPage < front_page_size) {
        //     var front_original_height = $(".panel-body").css("min-height").slice(0, -2);
        //     var front_modify_height = front_original_height * front_totalPage/front_page_size;
        //     $("#front-items li").css("min-height", front_modify_height + "px");
        // }
        //一开始数量少于page_size时next_btn要disabled
        if(front_totalPage <= front_page_size){
            front_next_btn.attr("disabled",true);
        }
    }

    //定义按钮next方法
    function front_next_page(obj) {
        front_totalPage = $("#front-items li").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
        var click_item = $(obj);
        front_prev_btn.attr("disabled",false); //点击下一页后释放prev按钮
        $("#front-items li").css('display','none'); //要重新展示分页data,所以要先全部设置为none
        //计算分页数量
        front_page_number = Math.ceil(front_totalPage/front_page_size);

        //点击后当前页码+1
        front_current_page += 1;
        //定位到新的当前页码的第一个条目的索引
        front_current_first_item = (parseInt(front_current_page) - 1) * front_page_size;

        $("#front-items li").each(function () {

            //展示这一页的条目
            if(front_current_first_item <= (parseInt(front_current_page) * front_page_size - 1)) {
                //$("#front-items li").eq(front_current_first_item).css('display','');
                $("#front-items li").eq(front_current_first_item).fadeIn(500);
                ++front_current_first_item;
            }
        });
        //如果这一页是最后一页
        if(front_current_page == front_page_number) {
            //则禁止next按钮
            click_item.attr("disabled",true);
        }

    }

    function front_previous_page(obj) {
        front_totalPage = $("#front-items li").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
        var click_item = $(obj);
        front_next_btn.attr("disabled", false);  //点击上一页后释放next按钮
        $("#front-items li").css('display', 'none');  //要重新展示分页data,所以要先全部设置为none
        //计算分页数量
        front_page_number = Math.ceil(front_totalPage / front_page_size);

        //点击后当前页码-1
        front_current_page -= 1;
        //定位到新的当前页码的第一个条目的索引
        front_current_first_item = (parseInt(front_current_page) - 1) * front_page_size;

        $("#front-items li").each(function () {

            //展示这一页的条目
            if (front_current_first_item <= (parseInt(front_current_page) * front_page_size - 1)) {
                //$("#front-items li").eq(front_current_first_item).css('display', '');
                $("#front-items li").eq(front_current_first_item).fadeIn(500);
                ++front_current_first_item;
            }
        });
        //如果点击前的一页是最后一页
        if (front_current_page == (front_page_number - 1)) {
            //则释放next按钮
            front_next_btn.attr("disabled", false);
        }

        //如果这一页是第一页
        if (front_current_page == 1) {
            //则禁止prev按钮
            click_item.attr("disabled", true);
        }
    }

</script>

@yield('script')
@yield('userScript')
@yield('edit_css_style')

</html>

