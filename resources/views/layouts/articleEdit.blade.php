@extends('layouts.main')
@section('title','記事を書く')
@section('homePage','ホーム')
@section('userPage',"「 " . $user->user_name . " 」" . "の個人ページ")
@section('articleWritePage','記事を書く')

@section('draft-style')
<style>


        /*.editor-preview-side.editor-preview-active-side {*/
            /*padding: 16px 26px 20px 26px;*/
            /*color: #fff;!important;*/
        /*}*/
        /*.editor-preview-side.editor-preview-active-side h1,*/
        /*.editor-preview-side.editor-preview-active-side h2{*/
            /*border-left: 6px solid #7b47f6;*/
            /*padding: 10px 0 10px 8px;*/
            /*color: #000;*/
            /*!*background-color: rgba(246, 119, 119, 0.1);*!*/
            /*margin-bottom: 10px;*/
            /*margin-top: 16px;*/
            /*font-weight: bold;*/
        /*}*/
        /*.editor-preview-side.editor-preview-active-side h3,*/
        /*.editor-preview-side.editor-preview-active-side h4{*/
            /*background-color: #420099;*/
            /*padding: 10px;*/
            /*color: #fff;*/
            /*font-weight: bold;*/
            /*margin-bottom: 10px;*/
        /*}*/

        /*.editor-preview-side.editor-preview-active-side h5{*/
            /*background-color: #420099;*/
            /*padding: 10px;*/
            /*color: #fff;*/
            /*font-weight: bold;*/
            /*margin-bottom: 10px;*/
        /*}*/

        /*.editor-preview-side.editor-preview-active-side blockquote{*/
            /*background-color: rgba(100, 98, 98, 0.2);*/
            /*border-left: 0 solid #420099;*/
        /*}*/
        /*.editor-preview-side.editor-preview-active-side p {*/
            /*margin-top: 12px;*/
            /*margin-bottom: 12px;*/
            /*color: #000;*/
        /*}*/
        /*.editor-preview-side.editor-preview-active-side pre {*/
            /*background-color: #fff;*/
            /*color: #000;*/
            /*border: 0 solid #420099;*/
            /*border-radius: 0;*/
            /*font-size: 16px;*/
        /*}*/
        /*.editor-preview-side.editor-preview-active-side p a {*/
            /*color: #000;*/
        /*}*/


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
            <span>
                @yield('articleWritePage')
            </span>
        </div>
    </div>
</header>

@endsection

@section('main')
    <section id="content">
        <div class="container">
            <div class="articleEdit_main">

                <div class="left-content col-lg-4 col-md-4">

                    <div class="row articleEdit_part">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                タイトル
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <input type="text" class="form-control" id="articleTitle" placeholder="タイトルを入力してください" value="" required name="title">
                            </div>
                        </div>
                    </div>


                    <div class="row articleEdit_part">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                レーアウト スタイル
                            </div>
                            <!-- /.panel-heading -->
                            <div id="layout_style" class="panel-body">
                                <a href="javascript:void(0);" class="edit_tag style-btn" id="style-1">orange</a>
                                <a href="javascript:void(0);" class="edit_tag style-btn" id="style-2">green</a>
                                <a href="javascript:void(0);" class="edit_tag style-btn" id="style-3">blue</a>
                                <a href="javascript:void(0);" class="edit_tag style-btn" id="style-4">purple</a>
                            </div>
                        </div>
                    </div>

                    <div class="row articleEdit_part">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                カテゴリー
                            </div>
                            <!-- /.panel-heading -->
                            <div id="edit_category" class="panel-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-pills">
                                    <li class="active"><a href="#front-end" data-toggle="tab">フロントエンド</a>
                                    </li>
                                    <li><a href="#back-end" data-toggle="tab">バックエンド</a>
                                    {{--<li class="active"><a href="#back-end" data-toggle="tab">バックエンド</a>--}}
                                    </li>
                                    {{--<li><a href="#client" data-toggle="tab">クライアント</a>--}}
                                    {{--</li>--}}
                                    <li><a href="#database" data-toggle="tab">データベース</a>
                                    </li>
                                    <li><a href="#server" data-toggle="tab">サーバー</a>
                                    </li>
                                    <li><a href="#IT" data-toggle="tab">基礎知識</a>
                                    </li>
                                    <li><a href="#else" data-toggle="tab">その他</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="front-end">
                                        @foreach ($pageElement['categoryData'] as $val)
                                            @if($val['code'] == 1)
                                                @if($val['level'] == 0)
                                                @elseif($val['level'] == 1)
                                                    <br><br><a href="javascript:void(0);" class="edit_tag edit_tag_big category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @elseif($val['level'] > 1)
                                                    <a href="javascript:void(0);" class="edit_tag edit_tag_small category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="back-end">
                                        @foreach ($pageElement['categoryData'] as $val)
                                            @if($val['code'] == 2)
                                                @if($val['level'] == 0)
                                                @elseif($val['level'] == 1)
                                                    <br><br><a href="javascript:void(0);" class="edit_tag edit_tag_big category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @elseif($val['level'] > 1)
                                                    <a href="javascript:void(0);" class="edit_tag edit_tag_small category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>

                                    {{--<div class="tab-pane fade" id="client">--}}
                                        {{--@foreach ($pageElement['categoryData'] as $val)--}}
                                            {{--@if($val['code'] == 3)--}}
                                                {{--@if($val['level'] == 0)--}}
                                                {{--@elseif($val['level'] == 1)--}}
                                                    {{--<br><br><a href="javascript:void(0);" class="edit_tag edit_tag_big category-btn" id="{{$val['id']}}">{{$val['name']}}</a>--}}
                                                {{--@elseif($val['level'] > 1)--}}
                                                    {{--<a href="javascript:void(0);" class="edit_tag edit_tag_small category-btn" id="{{$val['id']}}">{{$val['name']}}</a>--}}
                                                {{--@endif--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                    {{--</div>--}}
                                    <div class="tab-pane fade" id="database">
                                        @foreach ($pageElement['categoryData'] as $val)
                                            @if($val['code'] == 4)
                                                @if($val['level'] == 0)
                                                @elseif($val['level'] == 1)
                                                    <br><br><a href="javascript:void(0);" class="edit_tag edit_tag_big category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @elseif($val['level'] > 1)
                                                    <a href="javascript:void(0);" class="edit_tag edit_tag_small category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="server">
                                        @foreach ($pageElement['categoryData'] as $val)
                                            @if($val['code'] == 5)
                                                @if($val['level'] == 0)
                                                @elseif($val['level'] == 1)
                                                    <br><br><a href="javascript:void(0);" class="edit_tag edit_tag_big category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @elseif($val['level'] > 1)
                                                    <a href="javascript:void(0);" class="edit_tag edit_tag_small category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="IT">
                                        @foreach ($pageElement['categoryData'] as $val)
                                            @if($val['code'] == 6)
                                                @if($val['level'] == 0)
                                                @elseif($val['level'] == 1)
                                                    <br><br><a href="javascript:void(0);" class="edit_tag edit_tag_big category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @elseif($val['level'] > 1)
                                                    <a href="javascript:void(0);" class="edit_tag edit_tag_small category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="else">
                                        @foreach ($pageElement['categoryData'] as $val)
                                            @if($val['code'] == 7)
                                                @if($val['level'] == 0)
                                                @elseif($val['level'] == 1)
                                                    <br><br><a href="javascript:void(0);" class="edit_tag edit_tag_big category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @elseif($val['level'] > 1)
                                                    <a href="javascript:void(0);" class="edit_tag edit_tag_small category-btn" id="{{$val['id']}}">{{$val['name']}}</a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                    <div class="row articleEdit_part">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                タグ
                            </div>
                            <!-- /.panel-heading -->
                            <div id="edit_tag" class="panel-body">
                                @foreach ($tagData as $val)
                                <a href="javascript:void(0);" class="edit_tag tag-btn" id="{{$val->id}}">{{$val->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="hiddenId" value="{{$user->id}}">
                </div><!-- left-content -->

                <div class="right-content col-lg-8 col-md-8">
                        @yield('editContent')
                </div><!-- right-content -->

            </div><!-- row -->
        </div><!-- container -->
    </section>
@endsection

@section('script')

<script>

    //初始化SimpleMDE
    var simplemde = new SimpleMDE({
        autosave: {
            enabled: false,
            uniqueId: "MyUniqueID",
            delay: 1000
        },
        styleSelectedText: false,
        placeholder: "何でもいいから、とりあえず入力しましょう(>_<)",
        //status: ["autosave"],
        status: ["autosave", "lines", "words"],
        spellChecker: false,
        element: document.getElementById("detail"),
        previewRender: function(plainText) {
            get_css_style();
            return customMarkdownParser(plainText); // Returns HTML from a custom parser
        },
        // lineWrapping: false,
        promptURLs: true,
        toolbar: [
            "bold", "italic", "strikethrough", "heading", "code", "quote", "unordered-list",
            "ordered-list", "link", "image", "table", "horizontal-rule", "side-by-side", "fullscreen", "guide",
            // {
            //     name: "uploadImage",//自定义按钮
            //     action: function customFunction(editor) {
            //         //editor.toggleHeading2.css("background-color", "#567");
            //         console.log(editor);
            //     },
            //     className: "fa fa-star",
            //     title: "Upload Image"
            // }
        ]
    });

    /////////////////////////////////////////////////////////////////////////////////////////////
    // //高亮渲染
    // var color_array = ['#009900', '#2a00ff', '#f6c352', '#ff1a89', '#7f0055', '#087f6e'];
    // var replace_code = ['<', '>'];
    // // var replace_code_11 = ['php', '/title(?=(8>8))', 'title(?=(8>8))'];
    // //html
    // var html_label = ['(?<=(8<8))/[0-9a-z]+(?=(8>8)| )', '(?<=(8<8))[0-9a-z]+(?=(8>8)| )', '!DOCTYPE html'];
    // //str
    // var html_str = ['(?<!(font color=)|(font color="#[0-9a-zA-Z]+))"\\S*?"'];
    // //style
    // var html_style_number = ['[0-9]+(?=px;)'];
    // var html_style_px = ['px(?=;)'];
    // var html_symbol = [';', '[\$](?=[(])'];
    // //program languages
    // var program_languages_keyword = ['function', 'var', 'if', 'else', 'return ', 'break', 'for'];
    // var program_languages_function = ['[\.][0-9a-zA-Z_]+(?=[(]|[;]|[\\s{1}])', '[\\s{1}][0-9a-zA-Z_]+(?=[(])'];
    // //var program_languages_function = ['[\.][^\s^)^(^;^$]+(?=[(]|[;])', '[\s][^\s^)^(^;^$]+(?=[(])'];
    //
    // function render_action() {
    //     replace_code_html(replace_code);
    //     //alert(middle_str);
    //     render_code_html(html_label, color_array[4]);
    //     //alert(middle_str);
    //     render_code_html(html_str, color_array[1]);
    //     //alert(middle_str);
    //     render_code_html(html_style_number, color_array[1]);
    //     //alert(middle_str);
    //     render_code_html(html_style_px, color_array[0]);
    //     //console.log(middle_str);
    //     //alert(middle_str);
    //     render_code_html(program_languages_function, color_array[5]);
    //     //console.log(middle_str);
    //     //alert(middle_str);
    //     render_code_html(program_languages_keyword, color_array[3]);
    //     //console.log(middle_str);
    //     //alert(middle_str);
    //     render_code_html(html_symbol, color_array[3]);
    //     //console.log(middle_str);
    //     //alert(middle_str);
    //     remove_add_element();
    // }
    //
    // function replace_code_html(replace_code) {
    //
    //     replace_code.forEach(function (content, index) {
    //         var reg = new RegExp(content, 'g');
    //         middle_str = middle_str.replace(reg, function (replace_content) {
    //             return "8" + replace_content + "8";
    //         })
    //     });
    //
    // }
    //
    // function render_code_html(render,color) {
    //     render.forEach(function (content, index) {
    //         var reg = new RegExp(content, 'g');
    //         middle_str = middle_str.replace(reg, function (replace_content) {
    //             return replace_content.fontcolor(color);
    //         })
    //     });
    // }
    //
    // function remove_add_element() {
    //     if(middle_str.indexOf('8<8')){
    //         middle_str = middle_str.replace(/8<8/g,  '<code>' + '<' + '</code>');
    //     }
    //     if(modify.indexOf('8>8')){
    //         middle_str = middle_str.replace(/8>8/g,  '<code>' + '>' + '</code>');
    //     }
    // }
    // function replace_element(markdown_content) {
    //
    //     if(markdown_content.indexOf('&lt;')){
    //         markdown_content = markdown_content.replace(/&lt;/g,  '<');
    //     }
    //     if(markdown_content.indexOf('&gt;')){
    //         markdown_content = markdown_content.replace(/&gt;/g,  '>');
    //     }
    //     if(markdown_content.indexOf('&quot;')){
    //         markdown_content = markdown_content.replace(/&quot;/g,  '"');
    //     }
    //     return markdown_content;
    // }
    //
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


    // var codeMirror_text = $(".editor-preview-side").html();

    // new_str = render_markdown_content_first_step(codeMirror_text);
    // $(".editor-preview-side").html(new_str);
    /////////////////////////////////////////////////////////////////////////////////////////////

    function customMarkdownParser(plainText) {
        //console.log(plainText);
        new_str = render_markdown_content_first_step(plainText);
        //console.log(new_str);
        var out_put = simplemde.markdown(new_str);
        //console.log(out_put);
        out_put = replace_element(out_put);

        // var test_content = $("editor-preview-side.editor-preview-active-side h3").eq(0).text();
        // alert(test_content);
        // $("editor-preview-side.editor-preview-active-side p a").eq(0).attr("target", "_blank");
        return out_put;
    }



    //限制标题输入框输入字数
    var ChineseOrJapaneseChar;
    var AsciiChar;
    var display_length; //入力した文字列のdisplay長さ(自分の設定したルールを満たす)
    var actual_length; //自分が設定したルールを満たす文字列のchar長さ

    $("#articleTitle").keyup(function () {
        var input_content = $("#articleTitle").val();
        var set_display_length = 44;

        inputDisplay_length(input_content, set_display_length);

        $("#articleTitle").val(input_content.substr(0, actual_length));
    });

    function displayLength_rule() {
        return ChineseOrJapaneseChar * 2 + AsciiChar;
    }

    function inputDisplay_length(str, set_display_length) {
        var reg = /[\u4E00-\u9FA5\u0800-\u4E00]/;
        ChineseOrJapaneseChar = 0;
        AsciiChar = 0;
        for (var i = 0; i < str.length; ++i) {
            if(reg.test(str.charAt(i))) {
                ++ ChineseOrJapaneseChar;
            }else{
                ++ AsciiChar;
            }
            display_length = displayLength_rule();
            actual_length = ChineseOrJapaneseChar + AsciiChar;
            if (display_length >= set_display_length) {
                break;
            }
        }
    }




    //点击选中css_style,分类按钮和标签按钮，再次点击取消选中，并且限制分类和标签的个数
    $('.style-btn').click(function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
        }else if($(".style-btn.active").length >= 1){
            swal({
                text: "一つだけ選んでください!",
                //icon: "warning",        //弹出框类型
            });
            $(".style-btn.active").removeClass('active');
        }else{
            $(this).addClass('active');
        }
        //$(this).toggleClass('active');
    });
    $('.category-btn').click(function(){//给id为btn的元素添加点击事件
        if($(this).hasClass('active')){
            $(this).removeClass('active');
        }else if($(".category-btn.active").length >= 1){
            swal({
                text: "一つだけ選んでください!",
                //icon: "warning",        //弹出框类型
            });
            $(".category-btn.active").removeClass('active');
        }else{
            $(this).addClass('active');
        }
        //$(this).toggleClass('active');
    });
    $('.tag-btn').click(function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
        }else if($(".tag-btn.active").length >= 4){
            swal({
                text: "三つ以上選ぶことはできません!",
                //icon: "warning",        //弹出框类型
            })
        }else{
            $(this).addClass('active');
        }
        //$(this).toggleClass('active');
    });


    //提交文章数据
    function articleSubmit(obj){
        var btn = $(obj);
        //准备好数组用来存放选中的分类和标签
        var str_categories = [];
        var ids_categories = [];
        var str_tags = [];
        var ids_tags = [];
        $(".category-btn.active").each(function (key, value) {
            str_categories[key] = $(this).text();
            ids_categories[key] = $(this).attr("id");
        });
        $(".tag-btn.active").each(function (key, value) {
            str_tags[key] = $(this).text();
            ids_tags[key] = $(this).attr("id");
        });

        //判断是否有没填写或没选择的项目
        if(!$("#articleTitle").val().length || !$(".style-btn.active").length || !str_categories.length || !str_tags.length || !simplemde.value().length) {
            var text_content;
            if(!$("#articleTitle").val().length) {
                text_content = "タイトルを入力してください!";
            }else if(!$(".style-btn.active").length) {
                text_content = "レーアウトスタイルを一つ選んでください!";
            }else if(!str_categories.length) {
                text_content = "カテゴリーを一つ選んでください!";
            }else if(!str_tags.length) {
                text_content = "タグを少なくとも一つ選んでください!";
            }else if(!simplemde.value().length) {
                text_content = "何でもいいから、何か入力してください　>_<";
            }
            swal({
                text: text_content,
                icon: "error",
                buttons: {
                    cancel: "キャンセル",
                    confirm: "はい",
                }
            });
            return;
        }

        swal({
            title: $("#articleTitle").val(),      //弹出框的title
            text: "レーアウトスタイル:" + $(".style-btn.active").attr("id") + "\nカテゴリー:" + str_categories + "\nタグ:" + str_tags + "\nよろしいでしょうか？",
            buttons: {
                cancel: "キャンセル",
                confirm: "はい",
            }
        })
            .then(willToSubmit => {
                //处理文章内容,转成markdown
                var new_simplemde_markdown = render_markdown_content_first_step(simplemde.value());
                var out_put = simplemde.markdown(new_simplemde_markdown);

                if (willToSubmit) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "post",
                        url: "{{ url('/submitArticle') }}",
                        data: {'title': $("#articleTitle").val(),
                            'intro': $("#articleIntro").val(),
                            'str_categories': str_categories,
                            'ids_categories': ids_categories,
                            'str_tags': str_tags,
                            'ids_tags': ids_tags,
                            'content': simplemde.value(),
                            // 'markdown_content': simplemde.markdown(simplemde.value()),
                            //'content': new_simplemde_markdown,
                            'markdown_content': out_put,
                            'status' : btn.attr('id'),
                            'user_id': "{{ $user->id }}",
                            'author': "{{ $user->user_name }}",
                            'css_style': $(".style-btn.active").attr("id"),
                            'pic_name': str_categories[0]
                        },

                        success: function (response) {
                            if (response.status == 10000) {
                                swal("文章操作", response.msg, "success");
                                window.location.href= "{{ route('user.share', [ $user->id ] ) }}";
                            }else {
                                swal("文章操作", response.msg, "error");
                            }
                        },
                        error: function () {
                            swal("文章操作", "发生未知错误", "error");
                        },
                    })
                }
            });
    }

    //提交草稿
    function articleDraft(obj){
        var btn = $(obj);
        //准备好数组用来存放选中的分类和标签
        var str_categories = [];
        var ids_categories = [];
        var str_tags = [];
        var ids_tags = [];
        $(".category-btn.active").each(function (key, value) {
            str_categories[key] = $(this).text();
            ids_categories[key] = $(this).attr("id");
        });
        $(".tag-btn.active").each(function (key, value) {
            str_tags[key] = $(this).text();
            ids_tags[key] = $(this).attr("id");
        });

        //判断是否有没填写或没选择的项目
        if(!$("#articleTitle").val().length || !$(".style-btn.active").length || !str_categories.length || !str_tags.length || !simplemde.value().length) {
            var text_content;
            if(!$("#articleTitle").val().length) {
                text_content = "タイトルを入力してください!";
            }else if(!$(".style-btn.active").length) {
                text_content = "レーアウトスタイルを一つ選んでください!";
            }else if(!str_categories.length) {
                text_content = "カテゴリーを一つ選んでください!";
            }else if(!str_tags.length) {
                text_content = "タグを少なくとも一つ選んでください!";
            }else if(!simplemde.value().length) {
                text_content = "何でもいいから、何か入力してください　>_<";
            }
            swal({
                text: text_content,
                icon: "error",
                buttons: {
                    cancel: "キャンセル",
                    confirm: "はい",
                }
            });
            return;
        }

        swal({
            title: $("#articleTitle").val(),      //弹出框的title
            text: "レーアウトスタイル:" + $(".style-btn.active").attr("id") + "\nカテゴリー:" + str_categories + "\nタグ:" + str_tags + "\nよろしいでしょうか？",
            buttons: {
                cancel: "キャンセル",
                confirm: "はい",
            }
        })
            .then(willToSubmit => {
                //处理文章内容,转成markdown
                var new_simplemde_markdown = render_markdown_content_first_step(simplemde.value());
                var out_put = simplemde.markdown(new_simplemde_markdown);

                if (willToSubmit) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "post",
                        url: "{{ url('/submitArticleDraft') }}",
                        data: {'title': $("#articleTitle").val(),
                            // 'intro': $("#articleIntro").val(),
                            'str_categories': str_categories,
                            'ids_categories': ids_categories,
                            'str_tags': str_tags,
                            'ids_tags': ids_tags,
                            'content': simplemde.value(),
                            // 'markdown_content': simplemde.markdown(simplemde.value()),
                            // 'content': new_simplemde_markdown,
                            'markdown_content': out_put,
                            'status' : btn.attr('id'),
                            'user_id': "{{ $user->id }}",
                            'author': "{{ $user->user_name }}",
                            'aid': $("#submitDraft").text(),
                            'css_style': $(".style-btn.active").attr("id"),
                            'pic_name': str_categories[0]
                        },

                        success: function (response) {
                            if (response.status == 10000) {
                                swal("文章操作", response.msg, "success");
                                window.location.href= "{{ route('user.share', [ $user->id ] ) }}";
                            }else {
                                swal("文章操作", response.msg, "error");
                            }
                        },
                        error: function () {
                            swal("文章操作", "发生未知错误", "error");
                        },
                    })
                }
            });
    }

</script>

@yield('draftScript')

@endsection

@section('edit_css_style')

<script>
    function get_css_style() {
        if(!$(".style-btn.active").attr("id") || $(".style-btn.active").attr("id") == 'style-1') {
            var css_style = '<style>\n' +
                '    .editor-preview-side.editor-preview-active-side {\n' +
                '        padding: 16px 26px 20px 26px;\n' +
                '        color: #fff;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side h1,\n' +
                '    .editor-preview-side.editor-preview-active-side h2{\n' +
                '        border-left: 6px solid #f67d00;\n' +
                '        padding: 10px 0 10px 8px;\n' +
                '        color: #000;\n' +
                '        /*background-color: rgba(246, 119, 119, 0.1);*/\n' +
                '        margin-bottom: 10px;\n' +
                '        margin-top: 16px;\n' +
                '        font-weight: bold;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side h3,\n' +
                '    .editor-preview-side.editor-preview-active-side h4{\n' +
                '        background-color: #f67d00;\n' +
                '        padding: 10px;\n' +
                '        color: #fff;\n' +
                '        font-weight: bold;\n' +
                '        margin-bottom: 10px;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side h5{\n' +
                '        background-color: #f67d00;\n' +
                '        padding: 10px;\n' +
                '        color: #fff;\n' +
                '        font-weight: bold;\n' +
                '        margin-bottom: 10px;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side blockquote{\n' +
                '        background-color: rgba(246, 125, 0, 0.2);\n' +
                '        border-left: 5px solid #f67d00;\n' +
                '\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side p{\n' +
                '        margin-top: 12px;\n' +
                '        margin-bottom: 12px;\n' +
                '        color: #000;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side pre {\n' +
                '        /*background-color: #323130;*/\n' +
                '        /*background-color: rgba(255, 198, 114, 0.08);*/\n' +
                '        background-color: #fff;\n' +
                '        font-family: "Comic Sans MS";\n' +
                '        color: #000;\n' +
                '        border-top: 4px dotted #f67d00;\n' +
                '        border-bottom: 4px dotted #f67d00;\n' +
                '        border-left: 0;\n' +
                '        border-right: 0;\n' +
                '        /*font-size: 16px;*/\n' +
                '        font-size: 18px;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side p a {\n' +
                '        color: #ff1a89;\n' +
                '    }\n' +
                '</style>';
        }else if($(".style-btn.active").attr("id") == 'style-2') {
            var css_style = '<style>\n' +
                '    .editor-preview-side.editor-preview-active-side {\n' +
                '        padding: 16px 26px 20px 26px;\n' +
                '        color: #fff;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side h1,\n' +
                '    .editor-preview-side.editor-preview-active-side h2{\n' +
                '        border-left: 6px solid #d2f64f;\n' +
                '        padding: 10px 0 10px 8px;\n' +
                '        color: #000;\n' +
                '        /*background-color: rgba(246, 119, 119, 0.1);*/\n' +
                '        margin-bottom: 10px;\n' +
                '        margin-top: 16px;\n' +
                '        font-weight: bold;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side h3,\n' +
                '    .editor-preview-side.editor-preview-active-side h4{\n' +
                '        background-color: #087f6e;\n' +
                '        padding: 10px;\n' +
                '        color: #fff;\n' +
                '        font-weight: bold;\n' +
                '        margin-bottom: 10px;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side h5{\n' +
                '        background-color: rgba(8, 127, 110, 0.2);\n' +
                '        padding: 10px;\n' +
                '        color: #000;\n' +
                '        font-weight: bold;\n' +
                '        margin-bottom: 10px;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side blockquote{\n' +
                '        background-color: rgba(100, 98, 98, 0.2);\n' +
                '        border-left: 0px solid #e6f60a;\n' +
                '\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side p{\n' +
                '        margin-top: 12px;\n' +
                '        margin-bottom: 12px;\n' +
                '        color: #000;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side pre {\n' +
                '        /*background-color: #323130;*/\n' +
                '        /*background-color: rgba(255, 198, 114, 0.08);*/\n' +
                '        background-color: #fff;\n' +
                '        font-family: "Comic Sans MS";\n' +
                '        color: #000;\n' +
                '        border: 0 solid rgba(100, 98, 98, 0.5);\n' +
                '        border-radius: 0;\n' +
                '        font-size: 16px;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side p a {\n' +
                '        color: #ff1a89;\n' +
                '    }\n' +
                '</style>';
        }else if($(".style-btn.active").attr("id") == 'style-3') {
            var css_style = '<style>\n' +
                '    .editor-preview-side.editor-preview-active-side {\n' +
                '        padding: 16px 26px 20px 26px;\n' +
                '        color: #fff;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side h1,\n' +
                '    .editor-preview-side.editor-preview-active-side h2{\n' +
                '        border-left: 6px solid #3474f6;\n' +
                '        padding: 10px 0 10px 8px;\n' +
                '        color: #000;\n' +
                '        /*background-color: rgba(246, 119, 119, 0.1);*/\n' +
                '        margin-bottom: 10px;\n' +
                '        margin-top: 16px;\n' +
                '        font-weight: bold;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side h3,\n' +
                '    .editor-preview-side.editor-preview-active-side h4{\n' +
                '        background-color: #fff;\n' +
                '        padding: 10px;\n' +
                '        color: #fff;\n' +
                '        font-weight: bold;\n' +
                '        margin-bottom: 10px;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side h5{\n' +
                '        background-color: #0a00ff;\n' +
                '        padding: 10px;\n' +
                '        color: #fff;\n' +
                '        font-weight: bold;\n' +
                '        margin-bottom: 10px;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side blockquote{\n' +
                '        background-color: rgba(100, 98, 98, 0.2);\n' +
                '        border-left: 0 solid #0a00ff;\n' +
                '\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side p{\n' +
                '        margin-top: 12px;\n' +
                '        margin-bottom: 12px;\n' +
                '        color: #000;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side pre {\n' +
                '        /*background-color: #323130;*/\n' +
                '        /*background-color: rgba(255, 198, 114, 0.08);*/\n' +
                '        background-color: rgba(100, 98, 98, 0.04);\n' +
                '        font-family: "Comic Sans MS";\n' +
                '        color: #000;\n' +
                '        border: 0 solid #0a00ff;\n' +
                '        border-radius: 0;\n' +
                '        font-size: 16px;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side p a {\n' +
                '        color: #000;\n' +
                '    }\n' +
                '</style>';
        }else {
            var css_style = '<style>\n' +
                '    .editor-preview-side.editor-preview-active-side {\n' +
                '        padding: 16px 26px 20px 26px;\n' +
                '        color: #fff;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side h1,\n' +
                '    .editor-preview-side.editor-preview-active-side h2{\n' +
                '        border-left: 6px solid #7b47f6;\n' +
                '        padding: 10px 0 10px 8px;\n' +
                '        color: #000;\n' +
                '        /*background-color: rgba(246, 119, 119, 0.1);*/\n' +
                '        margin-bottom: 10px;\n' +
                '        margin-top: 16px;\n' +
                '        font-weight: bold;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side h3,\n' +
                '    .editor-preview-side.editor-preview-active-side h4{\n' +
                '        background-color: #420099;\n' +
                '        padding: 10px;\n' +
                '        color: #fff;\n' +
                '        font-weight: bold;\n' +
                '        margin-bottom: 10px;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side h5{\n' +
                '        background-color: #420099;\n' +
                '        padding: 10px;\n' +
                '        color: #fff;\n' +
                '        font-weight: bold;\n' +
                '        margin-bottom: 10px;\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side blockquote{\n' +
                '        background-color: rgba(100, 98, 98, 0.2);\n' +
                '        border-left: 0 solid #420099;\n' +
                '\n' +
                '    }\n' +
                '\n' +
                '    .editor-preview-side.editor-preview-active-side p{\n' +
                '        margin-top: 12px;\n' +
                '        margin-bottom: 12px;\n' +
                '        color: #000;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side pre {\n' +
                '        /*background-color: #323130;*/\n' +
                '        /*background-color: rgba(255, 198, 114, 0.08);*/\n' +
                '        background-color: #fff;\n' +
                '        font-family: "Comic Sans MS";\n' +
                '        color: #000;\n' +
                '        border: 0 solid #420099;\n' +
                '        border-radius: 0;\n' +
                '        border-bottom: 4px dotted rgba(66, 0, 153, 0.6);\n' +
                '        border-top: 4px dotted rgba(66, 0, 153, 0.6);\n' +
                '        font-size: 16px;\n' +
                '    }\n' +
                '    .editor-preview-side.editor-preview-active-side p a {\n' +
                '        color: #000;\n' +
                '    }\n' +
                '</style>';
        }
        $("header").append(css_style);
    }
</script>

@endsection