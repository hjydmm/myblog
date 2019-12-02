@extends('layouts.user')
@section('title','記事リスト')
@section('homePage','ホーム')
@section('userPage',"「 " . $user->user_name . " 」" . "の個人ページ")
@section('sharePage','記事リスト')
@section('passPage', '最新記事')
@section('articlePage', $article_info->title)
@section('seriesListPage','シリーズ一覧')
@section('rankingsListPage','ランキング一覧')

@section('detailStyle')

<style>
    .CodeMirror, .CodeMirror-scroll {
        min-height: 100px;!important;
        height: 40px;
        border-radius: 0 0 5px 5px;
    }

    .clearfix {
        overflow: auto;
        zoom: 1;
    }

    @if($article_info->id == 169)
    #mainText pre {
        background-color: rgba(255, 210, 152, 0.2);
        color: #000;
        border: 0 dotted #ff7cc1;
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
        border: 0 solid rgba(100, 98, 98, 0.5);
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

    @if($before_page == "normal")
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
                        @yield('passPage')
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
    @elseif($before_page == "series")
        <header id="user-header" class="nav-list">
            <div class="container">
                <div id="nav_list_item">
                    <a id="returnHome" href="/">
                        @yield('homePage')
                    </a>
                    &nbsp;
                    <i class="fa fa-angle-right"></i>
                    &nbsp;
                    <a id="seriesListPage" href="{{ url('series', ['series' => 'C言語学習ノート' ]) }}">
                        @yield('seriesListPage')
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
    @elseif($before_page == "rankings")
        <header id="user-header" class="nav-list">
            <div class="container">
                <div id="nav_list_item">
                    <a id="returnHome" href="/">
                        @yield('homePage')
                    </a>
                    &nbsp;
                    <i class="fa fa-angle-right"></i>
                    &nbsp;
                    <a id="rankingsListPage" href="{{ url('rankings', ['rankings' => 'いいね！' ]) }}">
                        @yield('rankingsListPage')
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
    @endif

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
            <div>{{ $article_info->title }}</div>
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
</div>


<div class="user-widget last-info" id="last-info">
    <div class="detail-info-part">
        <span id="last-info-description">この記事はいかがですか?</span>
        <span id="isLiked_isStored_toComment">
        @if (Auth::guard('home')->user() && Auth::guard('home')->user()->id == $id)
        @inject('likeService', 'App\Services\LikeServiceInterface')
        @if($likeService->isLiked(['user_id'=> Auth::guard('home')->user()->id, 'aid'=> $article_info->id]))
        <a href="javascript:void(0);" id="like_item" class="like_number click-tag item-clicked"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="click-like"> いいね済 </span></a>
        @else
        <a href="javascript:void(0);" id="like_item" class="like_number click-tag"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="click-like"> いいね ! </span></a>
        @endif
        &nbsp;&nbsp;&nbsp;
        @inject('storeService', 'App\Services\StoreServiceInterface')
        @if($storeService->isStored(['user_id'=> Auth::guard('home')->user()->id, 'aid'=> $article_info->id]))
        <a href="javascript:void(0);" id="store_item" class="store_number click-tag item-clicked"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="click-bookmark"> ブックマーク済 </span></a>
        @else
        <a href="javascript:void(0);" id="store_item" class="store_number click-tag"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="click-bookmark"> ブックマーク </span></a>
        @endif
        @else
        <a href="javascript:void(0);" id="like_item" class="like_number click-tag"><i class="fa fa-heart-o"></i>&nbsp;&nbsp;<span id="click-like"> いいね ! </span></a>
        <a href="javascript:void(0);" id="store_item" class="store_number click-tag"><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;<span id="click-bookmark"> ブックマーク </span></a>
        @endif
        <a href="#comment_target" class="comment-tag click-tag">&nbsp;&nbsp;<span id="comment">コメントする</span></a>
        </span>
    </div>
</div>


<div class="user-widget detail-comment" id="comment_begin" >
    <div id="comment_title">
        <span>コメント (</span >
        <span id="comment_bar">{{$article_info -> article_relate -> comment_number}}</span>
        <span>)</span>
    </div>
</div>

@endsection

@section('commentList')
{{--评论list部分--}}
<div id="comment_show"></div>
@endsection

@section('comment')

{{--评论输入框部分--}}
<div class="user-widget clearfix input_area" id="comment_target">
    <div class="panel-body">
        <div class="alert alert-danger">
            気軽にコメントしてね ( MarkDown文法可 )
        </div>
    </div>
    <div id="input_area_for_comment">
        <textarea id="comment_area_1"></textarea>
    </div>
    <div>
        <a href="javascript:void(0);" class="btn-warning btn-lg comment-btn" onclick="commentSubmit(this)">送信</a>
    </div>
</div>

<input type="hidden" name="commentAddHidden" id="commentAddHidden" value="">
<input type="hidden" name="commentAddReplyHidden" id="commentAddReplyHidden" value="">
<input type="hidden" name="commentListHidden" id="commentListHidden" value="{{ $article_info -> comment_list }}">

@if (Auth::guard('home')->check())
    <input type="hidden" name="visitor_id" id="visitor_id" value="{{ Auth::guard('home')->user()->id }}">
    <input type="hidden" name="visitor_user_name" id="visitor_user_name" value="{{ Auth::guard('home')->user()->user_name }}">
    <input type="hidden" name="visitor_avatar" id="visitor_avatar" value="{{ Auth::guard('home')->user()->avatar }}">
@else
    <input type="hidden" name="visitor_id" id="visitor_id" value="visitor">
    <input type="hidden" name="visitor_user_name" id="visitor_user_name" value="visitor">
    <input type="hidden" name="visitor_avatar" id="visitor_avatar" value="visitor">
@endif

@endsection


@section('script')

<script>
    ////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////正文渲染部分/////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////

    //正文部分的高亮渲染
    var article_content = $("#simpleMDE").val();
    //个别修改("<a href=", '&lt;, '&gt;', '&quot;')
    article_content = replace_element(article_content);
    $("#mainText").html(article_content);

    //code区域滑动条
    code_overflow();
    //scroll_spy and affix
    myScrollspy();

</script>


<script>

    ////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////评论部分///////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////

    //展示commentList的内容
    var commentList = $("#commentListHidden").val();
    $("#comment_show").html(commentList);

    //如果个人信息有修改的话,要让保存的commentList有所修改
    //这功能暂时不改

    //comment的simpleMDE
    var simplemde = new SimpleMDE({
        status: false,
        toolbar: false,
        element: document.getElementById("comment_area_1"),
        styleSelectedText: false,
        placeholder: "何でもいいから、とりあえず入力しましょう(>_<)",
    });

    //提交comment数据
    function commentSubmit(obj){
        //如果没有登录,就提示先登录
        if("{{ !Auth::guard('home')->check() }}") {
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
        //如果没有内容,就提示没内容不能发送
        if(!simplemde.value()){
            swal({
                text: "何でもいいから、とりあえず入力しましょう(>_<)",
                icon: "error",
                buttons: {
                    cancel: "キャンセル",
                    confirm: "はい",
                }
            });
            //swal("コメント内容はありません", "", "error");
            return;
        }
        var comment_submit = $(obj);

        //处理评论内容,转成markdown
        //new_str = '';
        var new_simplemde_markdown = render_markdown_content_first_step(simplemde.value());
        var out_put = simplemde.markdown(new_simplemde_markdown);

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "post",
            url: "{{ url('/submitComment') }}",
            data: {'user_id': $("#visitor_id").val(),
                'user_name': $("#visitor_user_name").val(),
                'avatar': $("#visitor_avatar").val(),
                'content': simplemde.value(),
                // 'markdown_content': simplemde.markdown(simplemde.value()),
                // 'content': new_simplemde_markdown,
                'markdown_content': out_put,
                'aid': "{{ $article_info->id }}",
                'created_at': '{{ date('Y-m-d H:i:s') }}',
            },
            success: function (response) {
                if (response.status == 10000) {
                    //生成comment
                    var title = "{{ $article_info -> title }}";
                    var appendComment = '<div id="reply_comment" class="clearfix reply_comment" style="width: 100%;">\n' +
                        '<div id="' + response.data.comment.aid + '" class="comment_flag">\n' +
                        '<div class="col-md-1" style="padding: 0 5px 0 5px;">\n' +
                        '<div style="margin:0px auto;width:50px; height:50px; background:url(' + response.data.comment.avatar + ') no-repeat center / cover" class="thumbnail"></div>\n' +
                        '<div style="text-align: center;" id="user_name">' + response.data.comment.user_name + '</div>\n' +
                        '</div>\n' +
                        '<div class="panel panel-default col-md-11" style="padding: 0;">\n' +
                        '<div class="panel-heading clearfix">\n' +
                        '<div class="left_items" style="float:left;">\n' +
                        'コメント＠記事「' + title + '」 : ' + response.data.comment.created_at + '\n' +
                        '</div>\n' +
                        '<div class="right_items" style="float:right;">\n' +
                        '<a href="javascript:;" onclick="commentFeedBack(this)" id="btn_feedback" class="tag-in" style="margin: 5px 5px 5px 0px;padding:6px 8px 6px 8px;"><i class="fa fa-reply"></i>&nbsp;&nbsp;&nbsp;返信</a>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '<div class="panel-body commentAdd" id="commentAdd"></div>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>';

                    $("#comment_show").append(appendComment);

                    var Mcontent = response.data.comment.markdown_content;
                    //var element = $("#commentAddHidden").val(Mcontent);

                    var element = $("#commentAddHidden").val(out_put);
                    var new_markdownContent = $("#commentAddHidden").val();

                    //拿到markdown内容并进行<和>的替换处理
                    new_markdownContent = replace_element(new_markdownContent);


                    //alert(markdownContent);
                    //评论部分高亮渲染
                    //由于new_str是全局变量,所以需要重置
                    //new_str = '';
                    //var new_markdownContent = render_markdown_content2(markdownContent);

                    var comment_show = comment_submit.parents(".input_area").prev("#comment_show");
                    comment_show.find("#reply_comment:last-child").find("#commentAdd").html(new_markdownContent);
                    comment_show.find("#reply_comment") .fadeIn(2000);
                    // 评论的增和减
                    $("#comment").text($("#comment").text()- 0 + 1 );
                    $("#comment_bar").text($("#comment_bar").text() - 0 + 1 );
                    $("#article_info_content").show();
                    $("#comment_bar_item").show();

                    //清空输入框的内容
                    var new_input_area = '<div class="user-widget clearfix input_area">\n' +
                        '<div class="panel-body">\n' +
                        '<div class="alert alert-danger">\n' +
                        '気軽にコメントしてね ( MarkDown文法可 )\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '<div id="input_area_for_comment">\n' +
                        '<textarea id="comment_area_1"></textarea>\n' +
                        '</div>\n' +
                        '<div>\n' +
                        '<a href="javascript:void(0);" class="btn-warning btn-lg comment-btn" onclick="commentSubmit(this)">送信</a>\n' +
                        '</div>\n' +
                        '</div>';
                    $(".input_area").remove();
                    $("#comment_show").after(new_input_area);
                    simplemde = new SimpleMDE({
                        status: false,
                        toolbar: false,
                        element: document.getElementById("comment_area_1"),
                        styleSelectedText: false,
                        placeholder: "何でもいいから、とりあえず入力しましょう(>_<)",
                    });
                    //保存comment的list到articles表的comment_list字段中,用于页面显示
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "post",
                        url: "{{ url('/saveCommentList') }}",
                        data: {'id': "{{ $article_info->id }}",
                            'comment_list': $("#comment_show").html(),
                            {{--'updated_at': '{{ date('Y-m-d H:i:s') }}',--}}
                        },
                    });
                }else {
                    swal("コメント", response.msg, "error");
                }
            },
            error: function () {
                swal("コメント", "エラが発生しました", "error");
            },
        })

    }

    //回复的simpleMDE
    var simplemde_2;
    //点击回复出现回复输入框
    function commentFeedBack(obj) {
        var replyMarkdown = $(obj);

        var user_name = replyMarkdown.parents(".comment_flag").find("#user_name").text();

        var width = (replyMarkdown.parents(".comment_flag").css("width").slice(0,-2)) * 0.99;

        var replyHtml = '<div id="reply" class="clearfix">\n' +
            '<div class="panel panel-default" id="reply_width" style="padding: 0;width:' + width + 'px;float:right;">\n' +
            '<div class="panel-body">\n' +
            '<div class="left_items" style="float:left;">\n' +
            '<label>「<span id="comment_user_name">' + user_name + '</span>」に返信する</label>\n' +
            '</div>\n' +
            '<div class="right_items" style="float:right;">\n' +
            '<a href="javascript:;" onclick="replySubmit(this)" id="feedback_to" class="tag-in" style="margin: 5px 5px 5px 0px;padding:6px 8px 6px 8px;">返信</a>\n' +
            '<a href="javascript:;" onclick="replyCancel(this)" id="feedback_to" class="tag-in" style="margin: 5px 5px 5px 0px;padding:6px 8px 6px 8px;">キャンセル</a>\n' +
            '</div>\n' +
            '\n' +
            '</div>\n' +
            '<div class="panel-body" style="padding-top:0px;">\n' +
            '<textarea id="comment_area_2"></textarea>\n' +
            '</div>\n' +
            '</div>\n' +
            '</div>';

        replyMarkdown.parents(".comment_flag").parent().after(replyHtml);
        //初始化回复评论的simpleMDE
        simplemde_2 = new SimpleMDE({
            status: false,
            toolbar: false,
            element: document.getElementById("comment_area_2"),
        });
        replyMarkdown.attr("onclick", "return false");
        $("#reply").show();
    }

    //回复评论
    function replySubmit(obj) {
        if("{{ !Auth::guard('home')->check() }}") {
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
        //如果没有内容,就提示没内容不能发送
        if(!simplemde_2.value()){
            swal({
                text: "何でもいいから、とりあえず入力しましょう(>_<)",
                icon: "error",
                buttons: {
                    cancel: "キャンセル",
                    confirm: "はい",
                }
            });
            //swal("コメント内容はありません", "", "error");
            return;
        }
        var replyObj = $(obj);
        swal({
            text: "返信しますか?",
            buttons: {
                cancel: "キャンセル",
                confirm: "はい",
            }
        })
        .then(willToSubmit => {
            //处理评论内容,转成markdown
            //new_str = '';
            var new_simplemde_markdown = render_markdown_content_first_step(simplemde_2.value());
            var out_put = simplemde.markdown(new_simplemde_markdown);

            if (willToSubmit) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "post",
                    url: "{{ url('/submitReplyComment') }}",
                    data: {'user_id': $("#visitor_id").val(),
                        'user_name': $("#visitor_user_name").val(),
                        'avatar': $("#visitor_avatar").val(),
                        'content': simplemde_2.value(),
                        // 'markdown_content': simplemde_2.markdown(simplemde_2.value()),
                        // 'content': new_simplemde_markdown,
                        'markdown_content': out_put,
                        'aid': "{{ $article_info->id }}",
                        'to_user_name': $("#comment_user_name").text(),
                        'created_at': '{{ date('Y-m-d H:i:s') }}',
                    },

                    success: function (response) {
                        if (response.status == 10000) {

                            var width = (replyObj.parents("#reply").find("#reply_width").css("width").slice(0,-2)) * 0.99;

                            var appendReplyComment = '<div id="reply_comment" class="clearfix reply_comment">\n' +
                                '<div id="reply_width" class="comment_flag" style="width:' + width + 'px;float:right;">\n' +
                                '<div id="' + response.data.replyComment.aid + '">\n' +
                                '<div class="col-md-1" style="padding: 0 5px 0 5px;">\n' +
                                '<div style="margin:0px auto;width:50px; height:50px; background:url(' + response.data.replyComment.avatar + ') no-repeat center / cover" class="thumbnail"></div>\n' +
                                '<div style="text-align: center;" id="user_name">' + response.data.replyComment.user_name + '</div>\n' +
                                '</div>\n' +
                                '<div class="panel panel-default col-md-11" style="padding: 0;">\n' +
                                '<div class="panel-heading clearfix">\n' +
                                '<div class="left_items" style="float:left;">\n' +
                                '返信→' + response.data.replyComment.to_user_name + ' : ' + response.data.replyComment.created_at + '\n' +
                                '</div>\n' +
                                '<div class="right_items" style="float:right;">\n' +
                                '<a href="javascript:;" onclick="commentFeedBack(this)" id="btn_feedback" class="tag-in" style="margin: 5px 5px 5px 0px;padding:6px 8px 6px 8px;"><i class="fa fa-reply"></i>&nbsp;&nbsp;&nbsp;返信</a>\n' +
                                '</div>\n' +
                                '</div>\n' +
                                '<div class="panel-body replyComment" id="replyComment"></div>\n' +
                                '</div>\n' +
                                '</div>\n' +
                                '</div>\n' +
                                '</div>';

                            replyObj.parents("#reply").after(appendReplyComment);
                            var content = response.data.replyComment.markdown_content;
                            var element = $("#commentAddReplyHidden").val(content);
                            var reply_content = $("#commentAddReplyHidden").val();

                            //拿到markdown内容并进行<和>的替换处理
                            reply_content = replace_element(reply_content);

                            content = replyObj.parents("#reply").next(".reply_comment").find("#replyComment");
                            content.html(reply_content);
                            $(".reply_comment").show();
                            replyObj.parents("#reply").prev(".reply_comment").find("#btn_feedback").attr("onclick", "commentFeedBack(this)");
                            replyObj.parents("#reply").remove();
                            // 评论的增和减
                            $("#comment").text($("#comment").text() - 0 + 1 );
                            $("#comment_bar").text($("#comment_bar").text() - 0 + 1 );
                            $("#article_info_content").show();
                            $("#comment_bar_item").show();
                            // 保存comment的list到articles表的comment_list字段中,用于页面显示
                            $.ajax({
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                type: "post",
                                url: "{{ url('/saveCommentList') }}",
                                data: {'id': "{{ $article_info->id }}",
                                    'comment_list': $("#comment_show").html(),
                                    {{--'updated_at': '{{ date('Y-m-d H:i:s') }}',--}}
                                },
                            });
                        }else {
                            swal("コメント", response.msg, "error");
                        }
                    },
                    error: function () {
                        swal("コメント", "エラが発生しました", "error");
                    },
                })
            }
        });
    }

    //收起回复
    function replyCancel(obj) {
        var replyObj = $(obj);
        if(simplemde_2.value()){
            swal({
                text: "入力した内容も削除しますが、よろしいでしょうか？",
                buttons: {
                    cancel: "キャンセル",
                    confirm: "はい",
                }
            })
                .then(willToCancel => {
                    //按下confirm表示为true
                    if (willToCancel) {
                        replyObj.parents("#reply").prev(".reply_comment").find("#btn_feedback").attr("onclick", "commentFeedBack(this)");
                        replyObj.parents("#reply").remove();
                    }
                });
        }else{
            replyObj.parents("#reply").prev(".reply_comment").find("#btn_feedback").attr("onclick", "commentFeedBack(this)");
            replyObj.parents("#reply").remove();
        }

    }

    //按enter键提交评论
    // $("textarea").keydown(function (event) {
    //     if(event.keyCode == 13) {
    //         var click = $("a[onclick='commentSubmit(this)']");
    //         commentSubmit(click);
    //     }
    // });


    ////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////点赞和收藏部分/////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////

    // 点赞功能
    $(".like_number").click(function () {
        if("{{ !Auth::guard('home')->check() }}") {
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
            url: "{{ url('/clickForLike') }}",
            data: {'aid': "{{ $article_info->id }}",
                'user_id': $("#visitor_id").val(),
                'created_at': '{{ date('Y-m-d H:i:s') }}',
            },
            success: function (response) {
                if (response.data.like_status == true) {
                    if(response.data.judge == 'down'){
                        $("#like").text($("#like").text() - 1);
                        $("#click-like").text(" いいね ! ");
                        $(".like_number").removeClass("item-clicked");
                    }else{
                        $("#like").text($("#like").text() - 0 + 1);
                        $("#click-like").text(" いいね済 ");
                        $(".like_number").addClass("item-clicked");
                    }
                    $("#right").show();
                }else {
                    swal("いいね", response.msg, "error");
                }
            },
            error: function () {
                swal("いいね", "エラが発生しました", "error");
            },
        });
    });

    // 收藏功能
    $(".store_number").click(function () {
        if("{{ !Auth::guard('home')->check() }}") {
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
            url: "{{ url('/clickForStore') }}",
            data: {'aid': "{{ $article_info->id }}",
                'user_id': $("#visitor_id").val(),
                'created_at': '{{ date('Y-m-d H:i:s') }}',
            },
            success: function (response) {
                if (response.data.status == true) {
                    if(response.data.judge == 'down'){
                        $("#store").text($("#store").text() - 1);
                        $("#click-bookmark").text(" ブックマーク ");
                        $(".store_number").removeClass("item-clicked");
                    }else{
                        $("#store").text($("#store").text() - 0 + 1);
                        $("#click-bookmark").text(" ブックマーク済 ");
                        $(".store_number").addClass("item-clicked");
                    }
                    $("#right").show();
                }else {
                    swal("ブックマーク", response.msg, "error");
                }
            },
            error: function () {
                swal("ブックマーク", "エラが発生しました", "error");
            },
        });
    })


</script>

@endsection

