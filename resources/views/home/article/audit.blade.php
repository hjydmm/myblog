@extends('layouts.user')
@section('title','記事リスト')
@section('homePage','ホーム')
@section('userPage',"「 " . $user->user_name . " 」" . "の個人ページ")
@section('sharePage','記事リスト')
@section('auditPage','審査中')
@section('articlePage', $article_info->title)

@section('detailStyle')

    <style>

        .clearfix {
            overflow: auto;
            zoom: 1;
        }

        @if($article_info->id == 169)
        #mainText pre {
            background-color: rgba(255, 210, 152, 0.2);
            color: #000;
            border: 0px dotted #ff7cc1;
            font-size: 16px;
        }
        @endif

        @if($article_info->css_style == "style-1")
        #mainText h1,
        #mainText h2,
        #mainText h3{
            border-left: 6px solid #f67d00;
            padding: 10px 0 10px 8px;
            color: #000;
            background-color: #fff;
            /*background-color: rgba(246, 119, 119, 0.1);*/
            margin-bottom: 10px;
            margin-top: 16px;
            font-weight: bold;
        }
        #mainText h4{
            background-color: #f67d00;
            padding: 10px;
            color: #fff;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #mainText h5{
            background-color: #f67d00;
            padding: 10px;
            color: #fff;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #mainText blockquote{
            background-color: rgba(246, 125, 0, 0.2);
            border-left: 5px solid rgba(246, 125, 0, 0.2);
            /*border-left: 5px solid #f67d00;*/

        }

        #mainText p{
            margin-top: 12px;
            margin-bottom: 12px;
            color: #000;
        }
        #mainText pre {
            /*background-color: #323130;*/
            /*background-color: rgba(255, 198, 114, 0.08);*/
            background-color: #fff;
            font-family: "Comic Sans MS";
            color: #000;
            border: 0 solid #f67d00;
            /*border-top: 4px dotted #f67d00;*/
            /*border-bottom: 4px dotted #f67d00;*/
            /*border-left: 0;*/
            /*border-right: 0;*/
            /*font-size: 16px;*/
            font-size: 16px;
        }
        #mainText p a {
            color: #ff1a89;
        }
        @elseif($article_info->css_style == "style-2")
        #mainText h1,
        #mainText h2{
            border-left: 6px solid #d2f64f;
            padding: 10px 0 10px 8px;
            color: #000;
            /*background-color: rgba(246, 119, 119, 0.1);*/
            margin-bottom: 10px;
            margin-top: 16px;
            font-weight: bold;
        }
        #mainText h3,
        #mainText h4{
            background-color: #087f6e;
            padding: 10px;
            color: #fff;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #mainText h5{
            /*border-bottom: 3px solid #087f6e;*/
            background-color: rgba(8, 127, 110, 0.2);
            padding: 10px;
            color: #000;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #mainText blockquote{
            background-color: rgba(100, 98, 98, 0.2);
            border-left: 0 solid #e6f60a;
        }
        #mainText p{
            margin-top: 12px;
            margin-bottom: 12px;
            color: #000;
        }
        #mainText pre {
            /*background-color: #323130;*/
            /*background-color: rgba(255, 198, 114, 0.08);*/
            /*background-color: rgba(100, 98, 98, 0.01);*/
            background-color: #fff;
            /*font-family: "Comic Sans MS";*/
            color: #000;
            /*border: 2px solid rgba(100, 98, 98, 0.1);*/
            border: 0 solid #e6f60a;
            /*border-left: 2px solid #e6f60a;*/
            border-radius: 0;
            /*font-size: 16px;*/
            font-size: 16px;
        }
        #mainText p a {
            color: #ff1a89;
        }
        @elseif($article_info->css_style == "style-3")
        #mainText h1,
        #mainText h2{
            border-left: 6px solid #3474f6;
            padding: 10px 0 10px 8px;
            color: #000;
            /*background-color: rgba(246, 119, 119, 0.1);*/
            margin-bottom: 10px;
            margin-top: 16px;
            font-weight: bold;
        }
        #mainText h3,
        #mainText h4{
            background-color: #fff;
            /*border-bottom: 4px dotted #0a00ff;*/
            padding: 10px;
            color: #000;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #mainText h5{
            background-color: #0a00ff;
            padding: 10px;
            color: #fff;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #mainText blockquote{
            background-color: rgba(100, 98, 98, 0.2);
            border-left: 0 solid #0a00ff;
        }
        #mainText p{
            margin-top: 12px;
            margin-bottom: 12px;
            color: #000;
        }
        #mainText pre {
            background-color: rgba(100, 98, 98, 0.04);
            color: #000;
            border: 0 solid #0a00ff;
            /*border-top: 4px dotted #0a00ff;*/
            /*border-bottom: 4px dotted #0a00ff;*/
            border-radius: 0;
            font-size: 16px;
        }
        #mainText p a {
            color: #000;
        }
        @elseif($article_info->css_style == "style-4")
        #mainText h1,
        #mainText h2{
            border-left: 6px solid #7b47f6;
            padding: 10px 0 10px 8px;
            color: #000;
            /*background-color: rgba(246, 119, 119, 0.1);*/
            margin-bottom: 10px;
            margin-top: 16px;
            font-weight: bold;
        }
        #mainText h3,
        #mainText h4{
            background-color: #420099;
            /*border-bottom: 6px solid #420099;*/
            padding: 10px;
            color: #fff;
            /*color: #000;*/
            /*color: #323232;*/
            font-weight: bold;
            margin-bottom: 10px;
        }

        #mainText h5{
            background-color: #420099;
            padding: 10px;
            color: #fff;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #mainText blockquote{
            background-color: rgba(100, 98, 98, 0.2);
            border-left: 0 solid #420099;
        }
        #mainText p{
            margin-top: 12px;
            margin-bottom: 12px;
            color: #000;
        }
        #mainText pre {
            /*background-color: rgba(218, 215, 255, 0.2);*/
            background-color: #fff;
            /*background-color: rgba(100, 98, 98, 0.02);*/
            color: #000;
            border: 0 solid #420099;
            border-radius: 0;
            border-bottom: 4px dotted rgba(66, 0, 153, 0.6);
            border-top: 4px dotted rgba(66, 0, 153, 0.6);
            font-size: 16px;
        }
        #mainText p a {
            color: #000;
        }
        @endif

</style>

@endsection

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
                <a id="sharePage" href="{{ route('user.share',[ $user->id ]) }}">
                    @yield('sharePage')
                </a>
                &nbsp;
                <i class="fa fa-angle-right"></i>
                &nbsp;
                <a id="statePage" href="{{ route('user.share',[ $user->id ]) }}">
                    @yield('auditPage')
                </a>
                &nbsp;
                <i class="fa fa-angle-right"></i>
                &nbsp;
                <span>
                    @yield('articlePage')
                </span>
            </div>
        </div>
    </header>

@endsection


@section('content')
{{--文章正文部分--}}
<div class="user-widget detail-page">

    <div class="detail-info-title">
        <div class="detail-info clearfix">
            <span class="created_at calendar-item"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<span>{{$article_info -> created_at -> diffForHumans()}}</span></span>
            <span class="info-group">
            <a href="javascript:void(0);" class="detail-item"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="like">{{$article_info -> article_relate -> like_number}}</span></a>
            <a href="javascript:void(0);" class="detail-item"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="store">{{$article_info -> article_relate -> store_number}}</span></a>
            <a href="#comment_begin" class="comment_number detail-item"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<span id="comment">{{$article_info -> article_relate -> comment_number}}</span></a>
            </span>
        </div>
        <div class="detail-title">
            <span>{{ $article_info->title }}</span>
        </div>
    </div>

    <div class="detail-categories-tags">
        @foreach($categoriesArray as $category)
            <a href="{{ route('category.articles',[ $category ]) }}" id="category_item" class="detail-tag"><i class="fa fa-folder"></i>&nbsp;{{ $category }}</a>
        @endforeach
        &nbsp;&nbsp;&nbsp;
        @foreach($tagsArray as $tag)
            <a href="{{ route('tag.articles',[ $tag ]) }}" id="tag_item" class="detail-tag"><i class="fa fa-tag"></i>&nbsp;{{ $tag }}</a>
        @endforeach
    </div>


    <div class="mainText" id="mainText">

    </div>

    <input type="hidden" name="simpleMDE" id="simpleMDE" value="{{ $article_info->markdown_content }}">
    <div class="mainText2" id="mainText2" style="display: none;">

    </div>
</div>

@endsection

@section('script')

<script>

    ////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////正文渲染部分/////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////

    //正文部分的高亮渲染
    var article_content = $("#simpleMDE").val();
    article_content = replace_element(article_content);
    $("#mainText").html(article_content);
    // $("#mainText p a").attr("target", "_blank");

    //code区域滑动条
    code_overflow();
    //scroll_spy and affix
    myScrollspy();


    // var myScrollspy_str = '';
    // myScrollspy_str += '<li>\n' +
    //     '<a id="guide_index" href="javascript:void(0);">目次</a>\n' +
    //     '</li>';
    //
    // $("#mainText h2").each(function (key, value) {
    //     $(this).attr("id", "nav" + key);
    //     myScrollspy_str += '<li>\n' +
    //         '<a class="click" href="#' + $(this).attr("id") + '">' +
    //         ($(this).attr("id").substr(3) - 0 + 1) + ". " + "&nbsp;" +
    //         $(this).text() + '</a>\n' +
    //         '</li>';
    // });
    //
    // $("#myScrollspy > ul").append(myScrollspy_str);
    //
    // var data_top = [];
    // var data_length = 0;
    // $(".click").each(function (key, value) {
    //     //$(this.hash)存储了#锚点后面的页面值
    //     data_top[key] = $(this.hash).offset().top - 100;
    //     ++data_length;
    //     //console.log(data_top[key]);
    // });
    // var data_item = $(".click").parent(); // <li></li>
    // //var scroll_height = (document.body.scrollHeight == 0) ? document.documentElement.scrollHeight : document.body.scrollHeight;
    // var scroll_height = document.documentElement.scrollHeight;
    // var visible_workplace_height = document.documentElement.clientHeight;
    //
    //
    // //滚动事件
    // $(document).scroll(function () {
    //
    //     //回到顶部功能(回到顶部按钮的出现和消失)
    //     if ($(window).scrollTop() > visible_workplace_height){
    //         $("#backToTop").fadeIn(500);
    //     }
    //     else
    //     {
    //         $("#backToTop").fadeOut(500);
    //     }
    //
    //     //affix附加导航栏
    //     //実際にスクロールしたtop値、瞬時値
    //     var scroll_top = document.documentElement.scrollTop;
    //     //var scroll_top = (document.body.scrollTop == 0) ? document.documentElement.scrollTop : document.body.scrollTop;
    //     //1.要素が一つもない場合
    //     if(data_length == 0) {
    //         return;
    //     }
    //     //2.要素の数>=1かつdata_top[0]より小さい場合
    //     if(scroll_top < data_top[0]) {
    //         return;
    //     }
    //     //3.要素の数>=1かつかつdata_top[0]より大きい場合
    //     if(scroll_top > data_top[0]) {
    //         //要素の数=1の場合
    //         if(data_length == 1) {
    //             data_item.eq(0).addClass("my_active");
    //             //要素の数>1かつかつdata_top[1]より小さい場合
    //         }else if(scroll_top < data_top[1]) {
    //             data_item.eq(0).addClass("my_active");
    //             data_item.eq(1).removeClass("my_active");
    //         }
    //     }
    //
    //     //4.要素の数>=3
    //     for (var i = 1; i < data_length-1; ++i) {
    //         if ( (data_top[i+1] > scroll_top) && (scroll_top > data_top[i]) && (parseInt(scroll_height - scroll_top) != parseInt(visible_workplace_height))) {
    //             data_item.eq(i).addClass("my_active");
    //             data_item.eq(i-1).removeClass("my_active");
    //             data_item.eq(i+1).removeClass("my_active");
    //             break;
    //         }
    //     }
    //
    //     //5.最後の要素以上スクロールする場合
    //     if(scroll_top > data_top[data_length-1]) {
    //         data_item.eq(data_length-2).removeClass("my_active");
    //         data_item.eq(data_length-1).addClass("my_active");
    //         return;
    //     }
    //
    //     //6.スクロールをスクロールできるまで
    //     if(parseInt(scroll_height - scroll_top) <= parseInt(visible_workplace_height)) {
    //         //最後の要素以上スクロールできない場合
    //         if(scroll_height - data_top[data_length-1] < (visible_workplace_height)) {
    //             data_item.eq(data_length-1).addClass("my_active");
    //             data_item.eq(data_length-2).removeClass("my_active");
    //         }
    //     }
    // });


</script>

@endsection


