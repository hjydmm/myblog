@extends('layouts.articleEdit')
@section('title','記事を書く')
@section('homePage','ホーム')
@section('userPage',"「 " . $user->user_name . " 」" . "の個人ページ")
@section('draftPage','一時保存')


@section('navList')



@endsection

@section('editContent')

<section>

    <textarea id="detail">{{ $article_info->content }}</textarea>
    <div class="button_group">
        <a href="javascript:void(0);" id="2" class="summit_btn" onclick="articleDraft(this)">提交</a>
        <a href="javascript:void(0);" id="1" class="save_btn" onclick="articleDraft(this)">一時保存</a>
    </div>
    <div style="display: none;">
        @foreach($categoriesIdsArray as $Id)
            <span class="cid_item">{{ $Id }}</span>
        @endforeach
    </div>
    <div style="display: none;">
        @foreach($tagsIdsArray as $Id)
            <span class="tid_item">{{ $Id }}</span>
        @endforeach
    </div>
    <div style="display: none;">
        <span id="submitDraft">{{ $article_info->id }}</span>
    </div>
</section>

@endsection

@section('draftScript')

<script>

    $("input#articleTitle").val("{{ $article_info->title }}");

    $("#" + "{{ $article_info->css_style }}").addClass("active");

    // 分类回显
    var Ids = [];
    $(".cid_item").each(function (key,value) {
        Ids[key] = $(this).text();
    });
    $(".category-btn").each(function () {
        var index = $.inArray($(this).attr("id"),Ids);
        if(index >= 0){
            $(this).addClass('active');
        }
    });
    // 标签回显
    var Ids = [];
    $(".tid_item").each(function (key,value) {
        Ids[key] = $(this).text();
    });
    $(".tag-btn").each(function () {
        var index = $.inArray($(this).attr("id"),Ids);
        if(index >= 0){
            $(this).addClass('active');
        }
    });


    //高亮渲染

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
    //     //replace_code_html(replace_code);
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
    //     //remove_add_element();
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
    // function render_markdown_content_first_step(modify) {
    //     middle_str = modify;
    //     //alert(middle_str);
    //     render_action();
    //     //alert(middle_str);
    //     new_str = middle_str;
    //     return new_str;
    // }
    //
    // var new_str = '';
    // var middle_str = '';
    // var codeMirror_text = $(".editor-preview-side").html();
    //
    // new_str = render_markdown_content_first_step(codeMirror_text);
    // $(".editor-preview-side").html(new_str);






    // alert("aaa");
    // alert($(".CodeMirror-code").text());
    // alert("bbb");
    // alert($(".CodeMirror-code").html());
    //$(".editor-preview-side.editor-preview-active-side").text();


</script>

@endsection