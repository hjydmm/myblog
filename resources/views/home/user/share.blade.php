@extends('layouts.user')
@section('title','記事リスト')
@section('homePage','ホーム')
@section('userPage',"「 " . $user->user_name . " 」" . "の個人ページ")
@section('sharePage','記事リスト')

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
                <a id="userPage" href="{{ url('user', ['id' => $user->id ]) }}">
                    @yield('userPage')
                </a>
                &nbsp;
                <i class="fa fa-angle-right"></i>
                &nbsp;
                <span>
                    @yield('sharePage')
                </span>
            </div>
        </div>
    </header>

@endsection

@section('content')

<div class="user-widget full-frame">
    <div class="panel-body">

        <ul class="nav nav-tabs">
            <li class="active"><a href="#pass" data-toggle="tab">最新記事({{ $passCount }})</a></li>
            @if (Auth::guard('home')->user() && Auth::guard('home')->user()->id == $id)
            <li><a href="#audit" data-toggle="tab">審査中({{ $auditCount }})</a></li>
            <li><a href="#draft" data-toggle="tab">一時保存({{ $draftCount }})</a></li>
            @endif
        </ul>

        <div class="tab-content">

                <div class="tab-pane fade in active" id="pass">
                    @if(count($passArticle) != 0)
                    <ul id="pass-items" class="tab_part" style="min-height: 600px;">
                        @foreach ($passArticle as $article)
                            <li class="passArticle_item clearfix" style="display:none;">
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
                        <li><button id="pass_prev" onclick="pass_previous_page(this)" disabled="disabled">前のページ</button></li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li><button id="pass_next" onclick="pass_next_page(this)">次のページ</button></li>
                    </ul>
                    @else
                        <div style="padding: 30px 2px;font-size: 20px;">
                            何もありません
                        </div>
                    @endif
                </div>

            @if (Auth::guard('home')->user() && Auth::guard('home')->user()->id == $id)
                <div class="tab-pane fade" id="audit">
                    @if(count($auditArticle) != 0)
                    <ul id="audit-items" class="tab_part" style="min-height: 600px;">
                        @foreach ($auditArticle as $article)
                            <li class="auditArticle_item" style="display:none;">
                    <span class="sub_title" style="background-color: {{ $article->categories->color_categories }};">
                        {{ substr($article->categories->str_categories, strripos($article->categories->str_categories, ',')+1 ) }}
                    </span>
                                &nbsp;&nbsp;
                                <a href="{{ route('user.articleAudit', [ 'id'=>$article->id ] ) }}">{{ $article->title }}</a>&nbsp;&nbsp;
                                <div class="article_info">
                                    <span class="created_at"><i class="fa fa-calendar"></i>&nbsp;&nbsp;{{$article -> created_at -> diffForHumans()}}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="pager">
                        <li><button id="audit_prev" onclick="audit_previous_page(this)" disabled="disabled">前のページ</button></li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li><button id="audit_next" onclick="audit_next_page(this)">次のページ</button></li>
                    </ul>
                    @else
                        <div style="padding: 30px 2px;font-size: 20px;">
                            何もありません
                        </div>
                    @endif
                </div>
            @endif

            @if (Auth::guard('home')->user() && Auth::guard('home')->user()->id == $id)
                <div class="tab-pane fade" id="draft">
                    @if(count($draftArticle) != 0)
                    <ul id="draft-items" class="tab_part" style="min-height: 600px;">
                        @foreach ($draftArticle as $article)
                            <li class="draftArticle_item" style="display:none;">
                    <span class="sub_title" style="background-color: {{ $article->categories->color_categories }};">
                        {{ substr($article->categories->str_categories, strripos($article->categories->str_categories, ',')+1 ) }}
                    </span>
                                &nbsp;&nbsp;
                                <a href="{{ route('user.articleDraft', [ 'id'=>$article->id ] ) }}">{{ $article->title }}</a>&nbsp;&nbsp;
                                <div class="article_info">
                                    <span class="created_at"><i class="fa fa-calendar"></i>&nbsp;&nbsp;{{$article -> created_at -> diffForHumans()}}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="pager">
                        <li><button id="draft_prev" onclick="draft_previous_page(this)" disabled="disabled">前のページ</button></li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li><button id="draft_next" onclick="draft_next_page(this)">次のページ</button></li>
                    </ul>
                    @else
                        <div style="padding: 30px 2px;font-size: 20px;">
                            何もありません
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
</div>

@endsection

@section('shareScript')
    <script>

        ////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////passPage/////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////

        //passPage
        var pass_current_page = 1,  //当前页
            pass_current_first_item = 0,  //当前页码的第一个条目的索引
            pass_page_size = 10, //自定义分页大小----------1
            pass_page_number = 1;  //分页数量
        var pass_totalPage = $("#pass-items li").length; //为了实时计算页数-----------2
        var pass_prev_btn = $("#pass_prev");
        var pass_next_btn = $("#pass_next");

        //初始化页面,根据自定义分页大小显示数据
        $("#pass-items li").each(function () {
            if(pass_current_first_item < pass_page_size){
                //$("#pass-items li").eq(pass_current_first_item).css('display','');
                $("#pass-items li").eq(pass_current_first_item).fadeIn(500);
                ++pass_current_first_item;
            }
        });
        //为了美观
        //如果一开始条目数量少于pass_page_size的话,改变min-height而让表格显示更好看
        // if(pass_totalPage < pass_page_size) {
        //     var pass_original_height = $(".panel-body").css("min-height").slice(0, -2);
        //     var pass_modify_height = pass_original_height * pass_totalPage/pass_page_size;
        //     $("#pass-items li").css("min-height", pass_modify_height + "px");
        // }
        //一开始数量少于page_size时next_btn要disabled
        if(pass_totalPage <= pass_page_size){
            pass_next_btn.attr("disabled",true);
        }

        //定义按钮next方法
        function pass_next_page(obj) {
            pass_totalPage = $("#pass-items li").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
            var click_item = $(obj);
            pass_prev_btn.attr("disabled",false); //点击下一页后释放prev按钮
            $("#pass-items li").css('display','none'); //要重新展示分页data,所以要先全部设置为none
            //计算分页数量
            pass_page_number = Math.ceil(pass_totalPage/pass_page_size);

            //点击后当前页码+1
            pass_current_page += 1;
            //定位到新的当前页码的第一个条目的索引
            pass_current_first_item = (parseInt(pass_current_page) - 1) * pass_page_size;

            $("#pass-items li").each(function () {

                //展示这一页的条目
                if(pass_current_first_item <= (parseInt(pass_current_page) * pass_page_size - 1)) {
                    //$("#pass-items li").eq(pass_current_first_item).css('display','');
                    $("#pass-items li").eq(pass_current_first_item).fadeIn(500);
                    ++pass_current_first_item;
                }
            });
            //如果这一页是最后一页
            if(pass_current_page == pass_page_number) {
                //则禁止next按钮
                click_item.attr("disabled",true);
            }

        }

        function pass_previous_page(obj) {
            pass_totalPage = $("#pass-items li").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
            var click_item = $(obj);
            pass_next_btn.attr("disabled", false);  //点击上一页后释放next按钮
            $("#pass-items li").css('display', 'none');  //要重新展示分页data,所以要先全部设置为none
            //计算分页数量
            pass_page_number = Math.ceil(pass_totalPage / pass_page_size);

            //点击后当前页码-1
            pass_current_page -= 1;
            //定位到新的当前页码的第一个条目的索引
            pass_current_first_item = (parseInt(pass_current_page) - 1) * pass_page_size;

            $("#pass-items li").each(function () {

                //展示这一页的条目
                if (pass_current_first_item <= (parseInt(pass_current_page) * pass_page_size - 1)) {
                    //$("#pass-items li").eq(pass_current_first_item).css('display', '');
                    $("#pass-items li").eq(pass_current_first_item).fadeIn(500);
                    ++pass_current_first_item;
                }
            });
            //如果点击前的一页是最后一页
            if (pass_current_page == (pass_page_number - 1)) {
                //则释放next按钮
                pass_next_btn.attr("disabled", false);
            }

            //如果这一页是第一页
            if (pass_current_page == 1) {
                //则禁止prev按钮
                click_item.attr("disabled", true);
            }
        }


        ////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////auditPage/////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////

        //auditPage
        var audit_current_page = 1,  //当前页
            audit_current_first_item = 0,  //当前页码的第一个条目的索引
            audit_page_size = 10, //自定义分页大小----------1
            audit_page_number = 1;  //分页数量
        var audit_totalPage = $("#audit-items li").length; //为了实时计算页数-----------2
        var audit_prev_btn = $("#audit_prev");
        var audit_next_btn = $("#audit_next");

        //初始化页面,根据自定义分页大小显示数据
        $("#audit-items li").each(function () {
            if(audit_current_first_item < audit_page_size){
                //$("#audit-items li").eq(audit_current_first_item).css('display','');
                $("#audit-items li").eq(audit_current_first_item).fadeIn(500);
                ++audit_current_first_item;
            }
        });
        //为了美观
        //如果一开始条目数量少于audit_page_size的话,改变min-height而让表格显示更好看
        // if(audit_totalPage < audit_page_size) {
        //     var audit_original_height = $(".panel-body").css("min-height").slice(0, -2);
        //     var audit_modify_height = audit_original_height * audit_totalPage/audit_page_size;
        //     $("#audit-items li").css("min-height", audit_modify_height + "px");
        // }
        //一开始数量少于page_size时next_btn要disabled
        if(audit_totalPage <= audit_page_size){
            audit_next_btn.attr("disabled",true);
        }

        //定义按钮next方法
        function audit_next_page(obj) {
            audit_totalPage = $("#audit-items li").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
            var click_item = $(obj);
            audit_prev_btn.attr("disabled",false); //点击下一页后释放prev按钮
            $("#audit-items li").css('display','none'); //要重新展示分页data,所以要先全部设置为none
            //计算分页数量
            audit_page_number = Math.ceil(audit_totalPage/audit_page_size);

            //点击后当前页码+1
            audit_current_page += 1;
            //定位到新的当前页码的第一个条目的索引
            audit_current_first_item = (parseInt(audit_current_page) - 1) * audit_page_size;

            $("#audit-items li").each(function () {

                //展示这一页的条目
                if(audit_current_first_item <= (parseInt(audit_current_page) * audit_page_size - 1)) {
                    //$("#audit-items li").eq(audit_current_first_item).css('display','');
                    $("#audit-items li").eq(audit_current_first_item).fadeIn(500);
                    ++audit_current_first_item;
                }
            });
            //如果这一页是最后一页
            if(audit_current_page == audit_page_number) {
                //则禁止next按钮
                click_item.attr("disabled",true);
            }

        }

        function audit_previous_page(obj) {
            audit_totalPage = $("#audit-items li").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
            var click_item = $(obj);
            audit_next_btn.attr("disabled", false);  //点击上一页后释放next按钮
            $("#audit-items li").css('display', 'none');  //要重新展示分页data,所以要先全部设置为none
            //计算分页数量
            audit_page_number = Math.ceil(audit_totalPage / audit_page_size);

            //点击后当前页码-1
            audit_current_page -= 1;
            //定位到新的当前页码的第一个条目的索引
            audit_current_first_item = (parseInt(audit_current_page) - 1) * audit_page_size;

            $("#audit-items li").each(function () {

                //展示这一页的条目
                if (audit_current_first_item <= (parseInt(audit_current_page) * audit_page_size - 1)) {
                    //$("#audit-items li").eq(audit_current_first_item).css('display', '');
                    $("#audit-items li").eq(audit_current_first_item).fadeIn(500);
                    ++audit_current_first_item;
                }
            });
            //如果点击前的一页是最后一页
            if (audit_current_page == (audit_page_number - 1)) {
                //则释放next按钮
                audit_next_btn.attr("disabled", false);
            }

            //如果这一页是第一页
            if (audit_current_page == 1) {
                //则禁止prev按钮
                click_item.attr("disabled", true);
            }
        }

        ////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////draftPage/////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////

        //draftPage
        var draft_current_page = 1,  //当前页
            draft_current_first_item = 0,  //当前页码的第一个条目的索引
            draft_page_size = 10, //自定义分页大小----------1
            draft_page_number = 1;  //分页数量
        var draft_totalPage = $("#draft-items li").length; //为了实时计算页数-----------2
        var draft_prev_btn = $("#draft_prev");
        var draft_next_btn = $("#draft_next");

        //初始化页面,根据自定义分页大小显示数据
        $("#draft-items li").each(function () {
            if(draft_current_first_item < draft_page_size){
                //$("#draft-items li").eq(draft_current_first_item).css('display','');
                $("#draft-items li").eq(draft_current_first_item).fadeIn(500);
                ++draft_current_first_item;
            }
        });
        //为了美观
        //如果一开始条目数量少于draft_page_size的话,改变min-height而让表格显示更好看
        // if(draft_totalPage < draft_page_size) {
        //     var draft_original_height = $(".panel-body").css("min-height").slice(0, -2);
        //     var draft_modify_height = draft_original_height * draft_totalPage/draft_page_size;
        //     $("#draft-items li").css("min-height", draft_modify_height + "px");
        // }
        //一开始数量少于page_size时next_btn要disabled
        if(draft_totalPage <= draft_page_size){
            draft_next_btn.attr("disabled",true);
        }

        //定义按钮next方法
        function draft_next_page(obj) {
            draft_totalPage = $("#draft-items li").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
            var click_item = $(obj);
            draft_prev_btn.attr("disabled",false); //点击下一页后释放prev按钮
            $("#draft-items li").css('display','none'); //要重新展示分页data,所以要先全部设置为none
            //计算分页数量
            draft_page_number = Math.ceil(draft_totalPage/draft_page_size);

            //点击后当前页码+1
            draft_current_page += 1;
            //定位到新的当前页码的第一个条目的索引
            draft_current_first_item = (parseInt(draft_current_page) - 1) * draft_page_size;

            $("#draft-items li").each(function () {

                //展示这一页的条目
                if(draft_current_first_item <= (parseInt(draft_current_page) * draft_page_size - 1)) {
                    //$("#draft-items li").eq(draft_current_first_item).css('display','');
                    $("#draft-items li").eq(draft_current_first_item).fadeIn(500);
                    ++draft_current_first_item;
                }
            });
            //如果这一页是最后一页
            if(draft_current_page == draft_page_number) {
                //则禁止next按钮
                click_item.attr("disabled",true);
            }

        }

        function draft_previous_page(obj) {
            draft_totalPage = $("#draft-items li").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
            var click_item = $(obj);
            draft_next_btn.attr("disabled", false);  //点击上一页后释放next按钮
            $("#draft-items li").css('display', 'none');  //要重新展示分页data,所以要先全部设置为none
            //计算分页数量
            draft_page_number = Math.ceil(draft_totalPage / draft_page_size);

            //点击后当前页码-1
            draft_current_page -= 1;
            //定位到新的当前页码的第一个条目的索引
            draft_current_first_item = (parseInt(draft_current_page) - 1) * draft_page_size;

            $("#draft-items li").each(function () {

                //展示这一页的条目
                if (draft_current_first_item <= (parseInt(draft_current_page) * draft_page_size - 1)) {
                    //$("#draft-items li").eq(draft_current_first_item).css('display', '');
                    $("#draft-items li").eq(draft_current_first_item).fadeIn(500);
                    ++draft_current_first_item;
                }
            });
            //如果点击前的一页是最后一页
            if (draft_current_page == (draft_page_number - 1)) {
                //则释放next按钮
                draft_next_btn.attr("disabled", false);
            }

            //如果这一页是第一页
            if (draft_current_page == 1) {
                //则禁止prev按钮
                click_item.attr("disabled", true);
            }
        }


    </script>
@endsection