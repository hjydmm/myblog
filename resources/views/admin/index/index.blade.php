@extends('layouts.admin')
@section('title','ホームページ')
@section('content')

    <div class="col-lg-6" style="font-size: 20px;">
        <table>
            <thead>
            <tr>
                <th style="font-size: 24px;padding: 20px 0;">ウェブサイトの基本情報</th>
            </tr>
            </thead>
            <tbody>
            <tr style="background-color: rgba(151, 151, 151, 0.2);">
                <td>BLOG バージョン</td>
                <td>&nbsp;&nbsp;&nbsp;{{ config('home.version') }}</td>
            </tr>
            <tr>
                <td>PHP バージョン</td>
                <td>&nbsp;&nbsp;&nbsp;{{ PHP_VERSION }}</td>
            </tr>
            <tr style="background-color: rgba(151, 151, 151, 0.2);">
                <td>Laravel バージョン</td>
                <td>&nbsp;&nbsp;&nbsp;5.5.*</td>
            </tr>
            <tr>
                <td>開発ツール</td>
                <td>&nbsp;&nbsp;&nbsp;PHPStorm</td>
            </tr>
            <tr style="background-color: rgba(151, 151, 151, 0.2);">
                <td>Mysql バージョン</td>
                <td>&nbsp;&nbsp;&nbsp;{{ mysqli_get_client_version() }}</td>
            </tr>
            <tr>
                <td>サーバー情報</td>
                <td>&nbsp;&nbsp;&nbsp;{{ $_SERVER ['SERVER_SOFTWARE'] }}</td>
            </tr>
            <tr style="background-color: rgba(151, 151, 151, 0.2);">
                <td>OS 情報</td>
                <td>&nbsp;&nbsp;&nbsp;{{ PHP_OS }}</td>
            </tr>
            <tr>
                <td>opcache</td>
                @if (function_exists('opcache_get_configuration'))
                    <td>&nbsp;&nbsp;&nbsp;{{ opcache_get_configuration()['directives']['opcache.enable'] ? 'オン' : 'オフ' }}</td>
                @else
                    <td>&nbsp;&nbsp;&nbsp;オフ</td>
                @endif
            </tr>
            <tr style="background-color: rgba(151, 151, 151, 0.2);">
                <td>スクリプトの最大実行時間</td>
                <td>&nbsp;&nbsp;&nbsp;{{ get_cfg_var("max_execution_time") }}s</td>
            </tr>
            <tr>
                <td>アップロード制限容量</td>
                <td>&nbsp;&nbsp;&nbsp;{{ get_cfg_var ("upload_max_filesize") }}</td>
            </tr>
            <tr style="background-color: rgba(151, 151, 151, 0.2);">
                <td>今の時間</td>
                <td>&nbsp;&nbsp;&nbsp;{{ date("Y-m-d H:i:s") }}</td>
            </tr>
            </tbody>
        </table>

        {{--<div style="margin-top: 20px;">オンにした拡張</div>--}}
        {{--<div style="padding: 10px 44px 10px 0;">--}}
            {{--@foreach(get_loaded_extensions() as $vo)--}}
            {{--【{{ $vo }}】--}}
            {{--@endforeach--}}
        {{--</div>--}}

    </div>

    <div class="col-lg-3">
        <div class="admin-memo">
            <div id="memo-title" style="padding: 6px 0 10px 0;">
                今後やるべきことを忘れないようここで記入しましょう!
            </div>
            <input type="text" class="form-control" id="memo" placeholder="メモを入力してください" value="" name="memo">
        </div>
        <div class="memo-list admin-memo-list">

        </div>
        <input type="hidden" id="memo-list-admin_id" value="{{ $result->admin_id }}">
        <input type="hidden" id="memo-list" value="{{ $result->content }}">
    </div>
    <!-- /.col-lg-4 -->

    <div class="col-lg-3">
        <div class="admin-memo-future">
            <div id="memo-title-future" style="padding: 6px 0 10px 0;">
                時間があれば是非やってみたいことを記入しよう!
            </div>
            <input type="text" class="form-control" id="memo-future" placeholder="メモを入力してください" value="" name="memo-future">
        </div>
        <div class="memo-list admin-memo-list-future">

        </div>
        <input type="hidden" id="memo-list-admin_id" value="{{ $result->admin_id }}">
        <input type="hidden" id="memo-list-future" value="{{ $result->content_future }}">
    </div>

@endsection

@section('userList-script')
    <script>

        $("#admin-home").attr("href", "javascript:void(0);");
        $("#admin-home").css("color", "#F67777").css("border", "1px solid #F67777").css("background-color", "#fff");

        $(".admin-memo-list").html($("#memo-list").val());
        $(".admin-memo-list-future").html($("#memo-list-future").val());

        {{--$(document).ready(function () {--}}

            {{--$("#memo").keydown(function (event) {--}}
                {{--if(event.keyCode == 13) {--}}
                    {{--var memo_content = $("#memo").val();--}}
                    {{--var memo_date = "{{ date('Y-m-d H:i:s') }}";--}}
                    {{--var str_memo = '<div class="memo-display" style="margin: 16px 0 16px 0">\n' +--}}
                        {{--'<div class="clearfix" style="background-color: #d3d6fb;padding: 4px 0 4px 0;border-bottom: 1px solid #fff;">\n' +--}}
                        {{--'<span class="col-md-11" style="float: left;font-size: 16px;color: #000;display: inline-block;padding-top: 4px;padding-bottom: 2px;">' + memo_date + '</span>\n' +--}}
                        {{--'<a href="javascript:void(0);" onclick="deleteMemo(this)" id="memo_delete" class="col-md-1" style="float: right;font-size: 18px;color: #000;display: inline-block;padding: 0 10px 0 10px;">×</a>\n' +--}}
                        {{--'</div>\n' +--}}
                        {{--'<div style="background-color: #d3d6fb;padding: 10px 0 10px 0">\n' +--}}
                        {{--'<a href="javascript:void(0);" onclick="editMemo(this)" style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">◎' + memo_content + '</a>\n' +--}}
                        {{--'</div>\n' +--}}
                        {{--'</div>';--}}

                    {{--$(".admin-memo-list").prepend(str_memo);--}}

                    {{--//清空输入框内容--}}
                    {{--$("#memo").val('');--}}

                    {{--// 保存memo的list到memo表的content字段中,用于页面显示--}}
                    {{--$.ajax({--}}
                        {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                        {{--type: "post",--}}
                        {{--url: "{{ url('/admin/memo/update') }}",--}}
                        {{--data: {'admin_id': $("#memo-list-admin_id").val(),--}}
                            {{--'content': $(".admin-memo-list").html(),--}}
                        {{--},--}}
                    {{--});--}}
                {{--}--}}
            {{--})--}}

        {{--});--}}


        $(document).ready(function () {

            $("#memo,#memo-future").keydown(function (event) {
                var memo_background_color = '';
                if($(this).attr("id") == "memo") {
                    memo_background_color = "#d3d6fb";
                } else {
                    memo_background_color = "#dbfbc3";
                }
                if(event.keyCode == 13) {
                    var memo_content = $(this).val();
                    var memo_date = "{{ date('Y-m-d H:i:s') }}";
                    var str_memo = '<div class="memo-display" style="margin: 16px 0 16px 0">\n' +
                        '<div class="clearfix" style="background-color: ' + memo_background_color + ';padding: 4px 0 4px 0;border-bottom: 1px solid #fff;">\n' +
                        '<span class="col-md-11" style="float: left;font-size: 16px;color: #000;display: inline-block;padding-top: 4px;padding-bottom: 2px;">' + memo_date + '</span>\n' +
                        '<a href="javascript:void(0);" onclick="deleteMemo(this)" id="memo_delete" class="col-md-1" style="float: right;font-size: 18px;color: #000;display: inline-block;padding: 0 10px 0 10px;">×</a>\n' +
                        '</div>\n' +
                        '<div style="background-color: ' + memo_background_color + ';padding: 10px 0 10px 0">\n' +
                        '<a id="' + $(this).attr("id") + '" href="javascript:void(0);" onclick="editMemo(this)" style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">◎' + memo_content + '</a>\n' +
                        '</div>\n' +
                        '</div>';

                    //alert($(this).attr("id"));

                    var memo_list = $(this).parent().next();

                    memo_list.prepend(str_memo);

                    //清空输入框内容
                    $(this).val('');

                    // 保存memo的list到memo表的content字段中,用于页面显示
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "post",
                        url: "{{ url('/admin/memo/update') }}",
                        data: {'admin_id': $("#memo-list-admin_id").val(),
                            'content': $(".admin-memo-list").html(),
                            'content_future': $(".admin-memo-list-future").html()
                        },
                    });
                }
            })

        });

        //删除memo内容
        function deleteMemo(obj) {
            $(obj).parent().parent().remove();
            // 保存memo的list到memo表的content字段中,用于页面显示
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "post",
                url: "{{ url('/admin/memo/update') }}",
                data: {'admin_id': $("#memo-list-admin_id").val(),
                    'content': $(".admin-memo-list").html(),
                    'content_future': $(".admin-memo-list-future").html()
                },
            });
        }

        //修改memo内容
        function editMemo(obj) {

            var memo_background_color = '';
            if($(obj).attr("id") == "memo") {
                memo_background_color = "#d3d6fb";
            } else {
                memo_background_color = "#dbfbc3";
            }
            //alert($(this).attr("id"));
            //alert(memo_background_color);
            var edit_content = '<input onblur="blur_memo(this)" style="background-color: ' + memo_background_color + ';border-color: rgba(246, 119, 119, 0)!important;box-shadow: 0 0 0 rgba(246, 119, 119, 0)!important;" type="text" id="memo_edit" class="form-control" value="' + $(obj).text() + '" name="memo_edit">';
            $(obj).after(edit_content);
            $(obj).remove();
            $("#memo_edit").trigger("focus");
        }
        function blur_memo(obj) {
            var memo_content = $("#memo_edit").val();
            var after_edit = '<a href="javascript:void(0);" onclick="editMemo(this)" style="font-size: 16px;color: #000;display: inline-block;padding: 0 10px 0 10px;">' + memo_content + '</a>\n';
            $(obj).after(after_edit);
            $(obj).remove();

            // 保存memo的list到memo表的content字段中,用于页面显示
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "post",
                url: "{{ url('/admin/memo/update') }}",
                data: {'admin_id': $("#memo-list-admin_id").val(),
                    'content': $(".admin-memo-list").html(),
                    'content_future': $(".admin-memo-list-future").html()
                },
            });
        }

    </script>
@endsection


