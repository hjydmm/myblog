@extends('layouts.series')
@section('title','シリーズリスト')
@section('homePage','ホーム')
@section('seriesListPage','シリーズ一覧')
@section('seriesPage',"「 " . $series_name . " 」")

@section('navList')

    <header id="user-header" class="nav-list">
        <div class="container">
            <div id="nav_list_item">
                <a id="returnHome" href="/">
                    @yield('homePage')
                </a>
                &nbsp;
                <i class="fa fa-angle-right"></i>
                &nbsp;
                <a id="seriesPage" href="{{ url('series', ['series' => $series_name ]) }}">
                    @yield('seriesListPage')
                    @yield('seriesPage')
                </a>
            </div>
        </div>
    </header>

@endsection

@section('content')

    <div class="user-widget full-frame">
        <div class="recent-release">
            {{--<h3>{{ $series_name }}</h3>--}}
            <ul id="front-items" class="tab_part" style="min-height: 600px;">
                @foreach($articles as $article)
                    <li class="passArticle_item clearfix" style="display: none;">
                        <span class="sub_title" style="background-color: {{ $article->categories->color_categories }};">
                            {{ substr($article->categories->str_categories, strripos($article->categories->str_categories, ',')+1 ) }}
                        </span>
                        &nbsp;&nbsp;
                        <a class="article_title" href="{{ route('user.articleDetail', [ 'id'=>$article->id ] ) }}">{{ $article->title }}</a>&nbsp;&nbsp;
                        <div class="article_info">
                            <span class="like_number"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;{{$article -> article_relate -> like_number}}</span>
                            <span class="store_number"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;{{$article -> article_relate -> store_number}}</span>
                            <span class="comment_number"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;{{$article -> article_relate -> comment_number}}</span>
                            <span class="created_at"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{$article -> created_at -> diffForHumans()}}</span>
                        </div>
                    </li>
                @endforeach
            </ul>

            <ul class="pager">
                <li><button id="front_prev" onclick="front_previous_page(this)" disabled="disabled">前のページ</button></li>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li><button id="front_next" onclick="front_next_page(this)">次のページ</button></li>
            </ul>

        </div>
    </div>

@endsection

@section('script')
    <script>

        frontPage(10);

    </script>
@endsection