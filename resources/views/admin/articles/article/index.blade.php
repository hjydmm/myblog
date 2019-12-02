@extends('layouts.admin')
@section('title','記事リスト')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #fff;">
                    <a href="javascript:location.replace(location.href);" class="btn btn-primary btn-list btn-nav"><i class="fa fa-refresh"></i> リフレッシュ</a>
                </div>
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#pass" data-toggle="tab">公開記事</a>
                        </li>
                        <li><a href="#audit" data-toggle="tab">審査待ち</a>
                        </li>
                        <li><a href="#draft" data-toggle="tab">下書き</a>
                        </li>
                    </ul>

                    <div id="showArticle" style="display: none">

                    </div>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- #pass -->
                        <div class="tab-pane fade in active" id="pass">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        {{--<div class="panel-heading" style="background-color: rgba(246, 119, 119, 0.05);">--}}
                                            {{--<a href="javascript:location.replace(location.href);" class="btn btn-primary btn-list btn-nav"><i class="fa fa-refresh"></i> リフレッシュ</a>--}}
                                            {{--<a class="btn btn-success btn_addNew btn-list btn-nav" onclick="btn_addNew(this)" ><i class="fa fa-plus"></i> 新規アカウント</a>--}}
                                            {{--<a class="btn btn-info btn_batchEdit btn-list btn-nav" onclick="btn_batchEdit(this)" ><i class="fa fa-pencil"></i> まとめの修正</a>--}}
                                            {{--<a class="btn btn-danger btn_batchDelete btn-list btn-nav" onclick="btn_batchDelete(this)" ><i class="fa fa-times"></i> まとめの削除</a>--}}
                                        {{--</div>--}}
                                        <!-- /.panel-heading -->
                                        <div class="panel-body" style="min-height: 640px;">
                                            <table width="100%" class="table table-striped table-bordered table-hover dataTables_article" id="dataTables-example">
                                                <thead>
                                                <tr>
                                                    {{--<th>全て選択</th>--}}
                                                    <th>ID</th>
                                                    <th>タイトル</th>
                                                    <th>カテゴリー</th>
                                                    <th>作者</th>
                                                    <th>タグ</th>
                                                    <th>記事の補足</th>
                                                    <th>その他</th>
                                                </tr>
                                                </thead>
                                                <tbody id="pass-items" class="passBody">
                                                @foreach($data as $val)
                                                    @if($val->status == 3)
                                                    <tr class="pass-data" style="display:none;">
                                                        {{--<td>--}}
                                                            {{--<div class="checkbox-custom checkbox-default">--}}
                                                                {{--<input type="checkbox" value="{{$val -> id}}" name="checkbox[]" class="data_box" id="table_checkbox">--}}
                                                                {{--<label for="table_checkbox"></label>--}}
                                                            {{--</div>--}}
                                                        {{--</td>--}}
                                                        <td class="id">{{$val -> id}}</td>
                                                        <td class="title">{{$val -> title}}</td>
                                                        {{--<td class="str_categories">{{$val -> categories -> str_categories}}</td>--}}
                                                        <td class="str_categories">{{ preg_replace("/,/", " / ", $val -> categories -> str_categories)}}</td>
                                                        <td class="user_name">{{$val -> users -> user_name}}</td>
                                                        {{--<td class="str_tags">{{$val -> tags -> str_tags}}</td>--}}
                                                        <td class="str_tags">{{ preg_replace("/,/", " / ", $val -> tags -> str_tags)}}</td>
                                                        <td class="article_relate">
                                                            <i class="fa fa-clock-o"></i> &nbsp;<span class="updated_at">{{$val -> updated_at}} ( {{$val -> updated_at -> diffForHumans()}} ) </span>&nbsp;&nbsp;/&nbsp;&nbsp;
                                                            <i class="fa fa-heart-o"></i> &nbsp;<span class="like_number">{{$val -> article_relate -> like_number}}</span>&nbsp;&nbsp;·&nbsp;&nbsp;
                                                            <i class="fa fa-bookmark-o"></i> &nbsp;<span class="store_number">{{$val -> article_relate -> store_number}}</span>&nbsp;&nbsp;·&nbsp;&nbsp;
                                                            <i class="fa fa-comment-o"></i> &nbsp;<span class="comment_number">{{$val -> article_relate -> comment_number}}</span>
                                                        </td>
                                                        <td class="table_manage">
                                                            {{--@if($val -> status == '2')--}}
                                                            {{--<button type="button" class="btn btn-outline btn-danger btn_stop" id="{{$val -> id}}">禁用账号</button>--}}
                                                            {{--@else--}}
                                                            {{--<button type="button" class="btn btn-outline btn-info btn_start" id="{{$val -> id}}">启用账号</button>--}}
                                                            {{--@endif--}}
                                                            <a class="btn btn-success btn_toAudit btn-list" onclick="passToAudit(this)" id="{{$val -> id}}">審査待ちへ</a>

                                                            <a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="{{$val -> id}}"> 編集</a>

                                                            <a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="{{$val -> id}}">削除</a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.panel-body -->
                                        <ul class="pager">
                                            <li><button id="pass_prev" onclick="pass_previous_page(this)" disabled="disabled">前のページ</button></li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <li><button id="pass_next" onclick="pass_next_page(this)">次のページ</button></li>
                                        </ul>
                                    </div>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                        </div>

                        <!-- #audit -->
                        <div class="tab-pane fade" id="audit">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        {{--<div class="panel-heading" style="background-color: #fff;">--}}
                                            {{--<a href="javascript:location.replace(location.href);" class="btn btn-primary btn-list btn-nav"><i class="fa fa-refresh"></i> リフレッシュ</a>--}}
                                            {{--<a class="btn btn-success btn_addNew btn-list btn-nav" onclick="btn_addNew(this)" ><i class="fa fa-plus"></i> 新規アカウント</a>--}}
                                            {{--<a class="btn btn-info btn_batchEdit btn-list btn-nav" onclick="btn_batchEdit(this)" ><i class="fa fa-pencil"></i> まとめの修正</a>--}}
                                            {{--<a class="btn btn-danger btn_batchDelete btn-list btn-nav" onclick="btn_batchDelete(this)" ><i class="fa fa-times"></i> まとめの削除</a>--}}
                                        {{--</div>--}}
                                        <!-- /.panel-heading -->
                                        <div class="panel-body" style="min-height: 640px;">
                                            <table width="100%" class="table table-striped table-bordered table-hover dataTables_article" id="dataTables-example">
                                                <thead>
                                                <tr>
                                                    {{--<th>全て選択</th>--}}
                                                    <th>ID</th>
                                                    <th>タイトル</th>
                                                    <th>カテゴリー</th>
                                                    <th>作者</th>
                                                    <th>タグ</th>
                                                    <th>最後更新する時間</th>
                                                    <th>その他</th>
                                                </tr>
                                                </thead>
                                                <tbody id="audit-items" class="auditBody">
                                                @foreach($data as $val)
                                                    @if($val->status == 2)
                                                    <tr class="audit-data" style="display:none;">
                                                        {{--<td>--}}
                                                            {{--<div class="checkbox-custom checkbox-default">--}}
                                                                {{--<input type="checkbox" value="{{$val -> id}}" name="checkbox[]" class="data_box" id="table_checkbox">--}}
                                                                {{--<label for="table_checkbox"></label>--}}
                                                            {{--</div>--}}
                                                        {{--</td>--}}
                                                        <td class="id">{{$val -> id}}</td>
                                                        <td class="title">{{$val -> title}}</td>
                                                        <td class="str_categories">{{ preg_replace("/,/", " / ", $val -> categories -> str_categories)}}</td>
                                                        <td class="user_name">{{$val -> users -> user_name}}</td>
                                                        {{--<td class="str_tags">{{$val -> tags -> str_tags}}</td>--}}
                                                        <td class="str_tags">{{ preg_replace("/,/", " / ", $val -> tags -> str_tags)}}</td>
                                                        <td class="updated_at">{{$val -> updated_at}} ( {{$val -> updated_at -> diffForHumans()}} ) </td>
                                                        <td class="table_manage">
                                                            {{--@if($val -> status == '2')--}}
                                                            {{--<button type="button" class="btn btn-outline btn-danger btn_stop" id="{{$val -> id}}">禁用账号</button>--}}
                                                            {{--@else--}}
                                                            {{--<button type="button" class="btn btn-outline btn-info btn_start" id="{{$val -> id}}">启用账号</button>--}}
                                                            {{--@endif--}}
                                                            <a class="btn btn-success btn_toPass btn-list" onclick="auditToPass(this)" id="{{$val -> id}}">公開記事へ</a>
                                                            <a class="btn btn-success btn_toNotPass btn-list" onclick="auditToNotPass(this)" id="{{$val -> id}}">下書きへ</a>
                                                            <a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="{{$val -> id}}">編集</a>
                                                            <a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="{{$val -> id}}">削除</a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.panel-body -->
                                        <ul class="pager">
                                            <li><button id="audit_prev" onclick="audit_previous_page(this)" disabled="disabled">前のページ</button></li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <li><button id="audit_next" onclick="audit_next_page(this)">次のページ</button></li>
                                        </ul>
                                    </div>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                        </div>

                        <!-- #draft -->
                        <div class="tab-pane fade" id="draft">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        {{--<div class="panel-heading" style="background-color: #fff;">--}}
                                            {{--<a href="javascript:location.replace(location.href);" class="btn btn-primary btn-list btn-nav"><i class="fa fa-refresh"></i> リフレッシュ</a>--}}
                                            {{--<a class="btn btn-success btn_addNew btn-list btn-nav" onclick="btn_addNew(this)" ><i class="fa fa-plus"></i> 新規アカウント</a>--}}
                                            {{--<a class="btn btn-info btn_batchEdit btn-list btn-nav" onclick="btn_batchEdit(this)" ><i class="fa fa-pencil"></i> まとめの修正</a>--}}
                                            {{--<a class="btn btn-danger btn_batchDelete btn-list btn-nav" onclick="btn_batchDelete(this)" ><i class="fa fa-times"></i> まとめの削除</a>--}}
                                        {{--</div>--}}
                                        <!-- /.panel-heading -->
                                        <div class="panel-body" style="min-height: 640px;">
                                            <table width="100%" class="table table-striped table-bordered table-hover dataTables_article" id="dataTables-example">
                                                <thead>
                                                <tr>
                                                    {{--<th>全て選択</th>--}}
                                                    <th>ID</th>
                                                    <th>タイトル</th>
                                                    <th>カテゴリー</th>
                                                    <th>作者</th>
                                                    <th>タグ</th>
                                                    <th>最後更新する時間</th>
                                                    {{--<th>ステータス</th>--}}
                                                    <th>その他</th>
                                                </tr>
                                                </thead>
                                                <tbody id="draft-items" class="draftBody">
                                                @foreach($data as $val)
                                                    @if($val->status == 1)
                                                    <tr class="draft-data" style="display:none;">
                                                        {{--<td>--}}
                                                            {{--<div class="checkbox-custom checkbox-default">--}}
                                                                {{--<input type="checkbox" value="{{$val -> id}}" name="checkbox[]" class="data_box" id="table_checkbox">--}}
                                                                {{--<label for="table_checkbox"></label>--}}
                                                            {{--</div>--}}
                                                        {{--</td>--}}
                                                        <td class="id">{{$val -> id}}</td>
                                                        <td class="title">{{$val -> title}}</td>
                                                        <td class="str_categories">{{ preg_replace("/,/", " / ", $val -> categories -> str_categories)}}</td>
                                                        <td class="user_name">{{$val -> users -> user_name}}</td>
                                                        {{--<td class="str_tags">{{$val -> tags -> str_tags}}</td>--}}
                                                        <td class="str_tags">{{ preg_replace("/,/", " / ", $val -> tags -> str_tags)}}</td>
                                                        {{---> diffForHumans()--}}
                                                        <td class="updated_at">{{$val -> updated_at}} ( {{$val -> updated_at -> diffForHumans()}} ) </td>
                                                        {{--<td class="status_change">{{$val -> status_change}}</td>--}}
                                                        <td class="table_manage">
                                                            {{--@if($val -> status == '2')--}}
                                                            {{--<button type="button" class="btn btn-outline btn-danger btn_stop" id="{{$val -> id}}">禁用账号</button>--}}
                                                            {{--@else--}}
                                                            {{--<button type="button" class="btn btn-outline btn-info btn_start" id="{{$val -> id}}">启用账号</button>--}}
                                                            {{--@endif--}}
                                                            <a class="btn btn-success btn_toPass btn-list" onclick="draftToPass(this)" id="{{$val -> id}}">公開記事へ</a>
                                                            <a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="{{$val -> id}}">編集</a>
                                                            <a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="{{$val -> id}}">削除</a>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.panel-body -->
                                        <ul class="pager">
                                            <li><button id="draft_prev" onclick="draft_previous_page(this)" disabled="disabled">前のページ</button></li>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <li><button id="draft_next" onclick="draft_next_page(this)">次のページ</button></li>
                                        </ul>
                                    </div>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>


        <!-- 编辑弹出框代码，默认隐藏 -->
        <div class="modal fade" id="myModal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel_edit">情報編集</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username_edit">管理者ネーム</label>
                            <input type="text" name="username_edit" class="form-control" id="username_edit" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="mobile_edit">電話番号</label>
                            <input type="text" name="mobile_edit" class="form-control" id="mobile_edit" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="email_edit">メール</label>
                            <input type="text" name="email_edit" class="form-control" id="email_edit" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="position_id_edit">ポスト</label>
                            <input type="text" name="position_id_edit" class="form-control" id="position_id_edit" placeholder="职位模块弄完再完善">
                        </div>
                        <div class="form-group">
                            <label for="status_edit">ステータス</label>
                            <div>
                                <input name="status_edit" class="status_edit" type="radio" id="status_edit" value="1" checked>
                                <label for="status_edit"> オフ </label>
                                <input name="status_edit" class="status_edit" type="radio" id="status_edit" value="2">
                                <label for="status_edit"> オン </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender_edit">性別</label>
                            <div>
                                <input name="gender_edit" class="gender_edit" type="radio" id="gender_edit" value="1" checked>
                                <label for="gender_edit"> 男 </label>
                                <input name="gender_edit" class="gender_edit" type="radio" id="gender_edit" value="2">
                                <label for="gender_edit"> 女 </label>
                                <input name="gender_edit" class="gender_edit" type="radio" id="gender_edit" value="3">
                                <label for="gender_edit"> 秘密 </label>
                            </div>
                        </div>
                        <input type="hidden" value="" id="hidden_id">
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal"><span aria-hidden="true"></span>キャンセル</a>
                        <a id="btn_editSubmit" onclick="btn_editSubmit(this)" class="btn btn-primary" data-dismiss="modal"><span aria-hidden="true"></span>確認</a>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('articleList-script')
<script>

    var tableObject_article = $('.dataTables_article').DataTable({
        responsive: true,
        paging: false,
        searching: false,
        info: false,
        "aaSorting": [[ 5, "desc" ]],//默认第几个排序
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[0,1,2,3,4,5,6]}// 制定列不参与排序
        ]
    });

    //文章选中状态
    $("#admin-articleList").attr("href", "javascript:void(0);");
    $("#admin-articleList").css("color", "#F67777").css("border", "1px solid #F67777").css("background-color", "#fff");


    ////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////pager///////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////

    //passPage
    var pass_current_page = 1,  //当前页
        pass_current_first_item = 0,  //当前页码的第一个条目的索引
        pass_page_size = 10, //自定义分页大小----------1
        pass_page_number = 1;  //分页数量
    var pass_totalPage = $("#pass-items tr").length; //为了实时计算页数-----------2
    var pass_prev_btn = $("#pass_prev");
    var pass_next_btn = $("#pass_next");

    //初始化页面,根据自定义分页大小显示数据
    $(".pass-data").each(function () {
        if(pass_current_first_item < pass_page_size){
            //$(".pass-data").eq(pass_current_first_item).css('display','');
            $(".pass-data").eq(pass_current_first_item).fadeIn(500);
            ++pass_current_first_item;
        }
    });
    //为了美观
    //如果一开始条目数量少于pass_page_size的话,改变min-height而让表格显示更好看
    if(pass_totalPage < pass_page_size) {
        var pass_original_height = $(".panel-body").css("min-height").slice(0, -2);
        var pass_modify_height = pass_original_height * pass_totalPage/pass_page_size;
        $("#pass-items").css("min-height", pass_modify_height + "px");
    }
    //一开始数量少于page_size时next_btn要disabled
    if(pass_totalPage < pass_page_size){
        pass_next_btn.attr("disabled",true);
    }

    //定义按钮next方法
    function pass_next_page(obj) {
        pass_totalPage = $("#pass-items tr").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
        var click_item = $(obj);
        pass_prev_btn.attr("disabled",false); //点击下一页后释放prev按钮
        $(".pass-data").css('display','none'); //要重新展示分页data,所以要先全部设置为none
        //计算分页数量
        pass_page_number = Math.ceil(pass_totalPage/pass_page_size);

        //点击后当前页码+1
        pass_current_page += 1;
        //定位到新的当前页码的第一个条目的索引
        pass_current_first_item = (parseInt(pass_current_page) - 1) * pass_page_size;

        $(".pass-data").each(function () {

            //展示这一页的条目
            if(pass_current_first_item <= (parseInt(pass_current_page) * pass_page_size - 1)) {
                //$(".pass-data").eq(pass_current_first_item).css('display','');
                $(".pass-data").eq(pass_current_first_item).fadeIn(500);
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
        pass_totalPage = $("#pass-items tr").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
        var click_item = $(obj);
        pass_next_btn.attr("disabled", false);  //点击上一页后释放next按钮
        $(".pass-data").css('display', 'none');  //要重新展示分页data,所以要先全部设置为none
        //计算分页数量
        pass_page_number = Math.ceil(pass_totalPage / pass_page_size);

        //点击后当前页码-1
        pass_current_page -= 1;
        //定位到新的当前页码的第一个条目的索引
        pass_current_first_item = (parseInt(pass_current_page) - 1) * pass_page_size;

        $(".pass-data").each(function () {

            //展示这一页的条目
            if (pass_current_first_item <= (parseInt(pass_current_page) * pass_page_size - 1)) {
                //$(".pass-data").eq(pass_current_first_item).css('display', '');
                $(".pass-data").eq(pass_current_first_item).fadeIn(500);
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

    //auditPage
    var audit_current_page = 1,  //当前页
        audit_current_first_item = 0,  //当前页码的第一个条目的索引
        audit_page_size = 10, //自定义分页大小----------1
        audit_page_number = 1;  //分页数量
    var audit_totalPage = $("#audit-items tr").length; //为了实时计算页数-----------2
    var audit_prev_btn = $("#audit_prev");
    var audit_next_btn = $("#audit_next");

    //初始化页面,根据自定义分页大小显示数据
    $(".audit-data").each(function () {
        if(audit_current_first_item < audit_page_size){
            //$(".audit-data").eq(audit_current_first_item).css('display','');
            $(".audit-data").eq(audit_current_first_item).fadeIn(500);
            ++audit_current_first_item;
        }
    });
    //为了美观
    //如果一开始条目数量少于audit_page_size的话,改变min-height而让表格显示更好看
    if(audit_totalPage < audit_page_size) {
        var audit_original_height = $(".panel-body").css("min-height").slice(0, -2);
        var audit_modify_height = audit_original_height * audit_totalPage/audit_page_size;
        $("#audit-items").css("min-height", audit_modify_height + "px");
    }
    //一开始数量少于page_size时next_btn要disabled
    if(audit_totalPage < audit_page_size){
        audit_next_btn.attr("disabled",true);
    }

    //定义按钮next方法
    function audit_next_page(obj) {
        audit_totalPage = $("#audit-items tr").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
        var click_item = $(obj);
        audit_prev_btn.attr("disabled",false); //点击下一页后释放prev按钮
        $(".audit-data").css('display','none'); //要重新展示分页data,所以要先全部设置为none
        //计算分页数量
        audit_page_number = Math.ceil(audit_totalPage/audit_page_size);

        //点击后当前页码+1
        audit_current_page += 1;
        //定位到新的当前页码的第一个条目的索引
        audit_current_first_item = (parseInt(audit_current_page) - 1) * audit_page_size;

        $(".audit-data").each(function () {

            //展示这一页的条目
            if(audit_current_first_item <= (parseInt(audit_current_page) * audit_page_size - 1)) {
                //$(".audit-data").eq(audit_current_first_item).css('display','');
                $(".audit-data").eq(audit_current_first_item).fadeIn(500);
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
        audit_totalPage = $("#audit-items tr").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
        var click_item = $(obj);
        audit_next_btn.attr("disabled", false);  //点击上一页后释放next按钮
        $(".audit-data").css('display', 'none');  //要重新展示分页data,所以要先全部设置为none
        //计算分页数量
        audit_page_number = Math.ceil(audit_totalPage / audit_page_size);

        //点击后当前页码-1
        audit_current_page -= 1;
        //定位到新的当前页码的第一个条目的索引
        audit_current_first_item = (parseInt(audit_current_page) - 1) * audit_page_size;

        $(".audit-data").each(function () {

            //展示这一页的条目
            if (audit_current_first_item <= (parseInt(audit_current_page) * audit_page_size - 1)) {
                //$(".audit-data").eq(audit_current_first_item).css('display', '');
                $(".audit-data").eq(audit_current_first_item).fadeIn(500);
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

    //draftPage
    var draft_current_page = 1,  //当前页
        draft_current_first_item = 0,  //当前页码的第一个条目的索引
        draft_page_size = 10, //自定义分页大小----------1
        draft_page_number = 1;  //分页数量
    var draft_totalPage = $("#draft-items tr").length; //为了实时计算页数-----------2
    var draft_prev_btn = $("#draft_prev");
    var draft_next_btn = $("#draft_next");

    //初始化页面,根据自定义分页大小显示数据
    $(".draft-data").each(function () {
        if(draft_current_first_item < draft_page_size){
            //$(".draft-data").eq(draft_current_first_item).css('display','');
            $(".draft-data").eq(draft_current_first_item).fadeIn(500);
            ++draft_current_first_item;
        }
    });
    //为了美观
    //如果一开始条目数量少于draft_page_size的话,改变min-height而让表格显示更好看
    if(draft_totalPage < draft_page_size) {
        var draft_original_height = $(".panel-body").css("min-height").slice(0, -2);
        var draft_modify_height = draft_original_height * draft_totalPage/draft_page_size;
        $("#draft-items").css("min-height", draft_modify_height + "px");
    }
    //一开始数量少于page_size时next_btn要disabled
    if(draft_totalPage < draft_page_size){
        draft_next_btn.attr("disabled",true);
    }

    //定义按钮next方法
    function draft_next_page(obj) {
        draft_totalPage = $("#draft-items tr").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
        var click_item = $(obj);
        draft_prev_btn.attr("disabled",false); //点击下一页后释放prev按钮
        $(".draft-data").css('display','none'); //要重新展示分页data,所以要先全部设置为none
        //计算分页数量
        draft_page_number = Math.ceil(draft_totalPage/draft_page_size);

        //点击后当前页码+1
        draft_current_page += 1;
        //定位到新的当前页码的第一个条目的索引
        draft_current_first_item = (parseInt(draft_current_page) - 1) * draft_page_size;

        $(".draft-data").each(function () {

            //展示这一页的条目
            if(draft_current_first_item <= (parseInt(draft_current_page) * draft_page_size - 1)) {
                //$(".draft-data").eq(draft_current_first_item).css('display','');
                $(".draft-data").eq(draft_current_first_item).fadeIn(500);
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
        draft_totalPage = $("#draft-items tr").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
        var click_item = $(obj);
        draft_next_btn.attr("disabled", false);  //点击上一页后释放next按钮
        $(".draft-data").css('display', 'none');  //要重新展示分页data,所以要先全部设置为none
        //计算分页数量
        draft_page_number = Math.ceil(draft_totalPage / draft_page_size);

        //点击后当前页码-1
        draft_current_page -= 1;
        //定位到新的当前页码的第一个条目的索引
        draft_current_first_item = (parseInt(draft_current_page) - 1) * draft_page_size;

        $(".draft-data").each(function () {

            //展示这一页的条目
            if (draft_current_first_item <= (parseInt(draft_current_page) * draft_page_size - 1)) {
                //$(".draft-data").eq(draft_current_first_item).css('display', '');
                $(".draft-data").eq(draft_current_first_item).fadeIn(500);
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

    ////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////js_refresh_forArticle//////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////

    function js_refresh_forPassArticle() {
        //页面刷新
        $(".pass-data").css("display", "none");
        pass_current_first_item = (parseInt(pass_current_page) - 1) * pass_page_size;
        $(".pass-data").each(function () {
            //展示这一页的条目
            if (pass_current_first_item <= (parseInt(pass_current_page) * pass_page_size - 1)) {
                $(".pass-data").eq(pass_current_first_item).fadeIn(500);
                ++pass_current_first_item;
            }
        });
        if($("#pass-items tr").length == (parseInt(pass_current_page) - 1) * pass_page_size) {
            $("#pass_prev").trigger("click");
        }
        //刷新完按钮状态重置
        pass_totalPage = $("#pass-items tr").length;
        pass_page_number = Math.ceil(pass_totalPage/pass_page_size);

        if(pass_current_page == 1 && pass_page_number > 1) {
            pass_prev_btn.attr("disabled", true);
            pass_next_btn.attr("disabled", false);
        }
        if(pass_current_page == pass_page_number && pass_page_number > 1) {
            pass_prev_btn.attr("disabled", false);
            pass_next_btn.attr("disabled", true);
        }
        if(pass_current_page != 1 && pass_current_page != pass_page_number) {
            pass_prev_btn.attr("disabled", false);
            pass_next_btn.attr("disabled", false);
        }
        if(pass_page_number == 1) {
            //各种操作完后只有一页的话
            $(".pass-data").css("display", "");
            pass_prev_btn.attr("disabled", true);
            pass_next_btn.attr("disabled", true);
        }
    }

    function js_refresh_forAuditArticle() {
        //页面刷新
        $(".audit-data").css("display", "none");
        audit_current_first_item = (parseInt(audit_current_page) - 1) * audit_page_size;
        $(".audit-data").each(function () {
            //展示这一页的条目
            if (audit_current_first_item <= (parseInt(audit_current_page) * audit_page_size - 1)) {
                $(".audit-data").eq(audit_current_first_item).fadeIn(500);
                ++audit_current_first_item;
            }
        });
        if($("#audit-items tr").length == (parseInt(audit_current_page) - 1) * audit_page_size) {
            $("#audit_prev").trigger("click");
        }
        //刷新完按钮状态重置
        audit_totalPage = $("#audit-items tr").length;
        audit_page_number = Math.ceil(audit_totalPage/audit_page_size);

        if(audit_current_page == 1 && audit_page_number > 1) {
            audit_prev_btn.attr("disabled", true);
            audit_next_btn.attr("disabled", false);
        }
        if(audit_current_page == audit_page_number && audit_page_number > 1) {
            audit_prev_btn.attr("disabled", false);
            audit_next_btn.attr("disabled", true);
        }
        if(audit_current_page != 1 && audit_current_page != audit_page_number) {
            audit_prev_btn.attr("disabled", false);
            audit_next_btn.attr("disabled", false);
        }
        if(audit_page_number == 1) {
            //各种操作完后只有一页的话
            $(".audit-data").css("display", "");
            audit_prev_btn.attr("disabled", true);
            audit_next_btn.attr("disabled", true);
        }
    }

    function js_refresh_forDraftArticle() {
        //页面刷新
        $(".draft-data").css("display", "none");
        draft_current_first_item = (parseInt(draft_current_page) - 1) * draft_page_size;
        $(".draft-data").each(function () {
            //展示这一页的条目
            if (draft_current_first_item <= (parseInt(draft_current_page) * draft_page_size - 1)) {
                $(".draft-data").eq(draft_current_first_item).fadeIn(500);
                ++draft_current_first_item;
            }
        });
        if($("#draft-items tr").length == (parseInt(draft_current_page) - 1) * draft_page_size) {
            $("#draft_prev").trigger("click");
        }
        //刷新完按钮状态重置
        draft_totalPage = $("#draft-items tr").length;
        draft_page_number = Math.ceil(draft_totalPage/draft_page_size);

        if(draft_current_page == 1 && draft_page_number > 1) {
            draft_prev_btn.attr("disabled", true);
            draft_next_btn.attr("disabled", false);
        }
        if(draft_current_page == draft_page_number && draft_page_number > 1) {
            draft_prev_btn.attr("disabled", false);
            draft_next_btn.attr("disabled", true);
        }
        if(draft_current_page != 1 && draft_current_page != draft_page_number) {
            draft_prev_btn.attr("disabled", false);
            draft_next_btn.attr("disabled", false);
        }
        if(draft_page_number == 1) {
            //各种操作完后只有一页的话
            $(".draft-data").css("display", "");
            draft_prev_btn.attr("disabled", true);
            draft_next_btn.attr("disabled", true);
        }
    }





    ////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////see_article///////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////

    // 展示编辑框(文章编辑)
    function btn_edit(obj){
        var obj_admin = $(obj);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"post",
            url: "{{ url('/admin/articles/article/detail') }}",
            data: {'id': obj_admin.attr('id')},
            success: function(response){
                if(response.status == 10000){
                    $("#myModalLabel_edit").text(" " + response.data[0].username + " の情報修正");
                    $("#username_edit").val(response.data[0].username);
                    $("#mobile_edit").val(response.data[0].mobile);
                    $("#email_edit").val(response.data[0].email);
                    $("#position_edit").val("2");
                    $("#hidden_id").val(response.data[0].id);
                    $('.status_edit[value=' + response.data[0].status + ']').prop("checked", true);
                    $('.gender_edit[value=' + response.data[0].gender + ']').prop("checked", true);
                    $('#myModal_edit').modal();
                }else {
                    swal("情報修正", "エラが発生しました", "error");
                }
            },
            error: function() {
                swal("情報修正", "エラが発生しました", "error");
            },
        });
    }

    // 编辑确认框(Admin)
    function btn_editSubmit(obj){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "post",
            url: "{{ url('/admin/admin/edit') }}",
            data: {
                'id': $("#hidden_id").val(),
                'username': $("#username_edit").val(),
                'mobile': $("#mobile_edit").val(),
                'email': $("#email_edit").val(),
                'position_id': "1",   //后面再完善
                'status': $('input[name="status_edit"]:checked').val(),
                'gender': $('input[name="gender_edit"]:checked').val(),
            },
            success: function (response) {
                if (response.status == 10000) {
                    swal("情報修正", response.msg, "success");
                    //window.location = window.location;
                    var newList_part1 = '<tr class="table-data">\n' +
                        '<td>\n' +
                        '<div class="checkbox-custom checkbox-default">\n' +
                        '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                        '<label for="table_checkbox"></label>\n' +
                        '</div>\n' +
                        '</td>\n' +
                        '<td class="id">' + response.data.id + '</td>\n' +
                        '<td class="username">' + response.data.username + '</td>\n';

                    if(response.data.gender == "1") {
                        var newList_part2 = '<td class="username">' + '男' + '</td>\n';
                    }else if(response.data.gender == "2") {
                        newList_part2 = '<td class="username">' + '女' + '</td>\n';
                    }else {
                        newList_part2 = '<td class="username">' + '秘密' + '</td>\n';
                    }

                    var newList_part3 =
                        '<td class="mobile">' + response.data.mobile + '</td>\n' +
                        '<td class="email">' + response.data.email + '</td>\n' +
                        '<td class="position">管理者</td>\n';

                    var newList_part4 = '<td class="table_status">\n' +
                        '<a class="btn btn-info btn-circle btn-list"><i class="fa fa-check"></i></a>\n' +
                        '</td>\n' +
                        '<td class="table_manage">\n' +
                        '<a class="btn btn-danger btn_stop btn-list" onclick="btn_stop(this)" id="' + response.data.id + '">アカウント(オフ)</a>\n';
                    var newList_part5 = '<td class="table_status">\n' +
                        '<a class="btn btn-danger btn-circle btn-list"><i class="fa fa-times"></i></a>\n' +
                        '</td>\n' +
                        '<td class="table_manage">\n' +
                        '<a class="btn btn-info btn_start btn-list" onclick="btn_start(this)" id="' + response.data.id + '">アカウント(オン)</a>\n';

                    var newList_part6 =
                        '<a class="btn btn-warning btn_changePassword btn-list" onclick="btn_changePassword(this)" id="' + response.data.id + '">パスワード変更</a>\n' +
                        '<a class="btn btn-success btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '">修正</a>\n' +
                        '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
                        '</td>\n' +
                        '</tr>';
                    if(response.data.status == "2") {
                        var newList = newList_part1 + newList_part2 + newList_part3 + newList_part4 + newList_part6;
                    }else {
                        newList = newList_part1 + newList_part2 + newList_part3 + newList_part5 + newList_part6;
                    }
                    var element = $('input[value=' + response.data.id + '].data_box').parent().parent().parent();
                    element.after(newList);
                    element.remove();


                }else {
                    swal("情報修正", response.msg, "error");
                }
            },
            error: function () {
                swal("情報修正", "エラが発生しました", "error");
            },
        })

    }
    ////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////pass-audit-draft////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////

    //审核通过的文章转为待审核
    function passToAudit(obj){
        //定义该按钮对象，方便之后使用
        var obj_admin = $(obj);
        swal({
            title: "ワーニング",      //弹出框的title
            text: "公開した記事を審査待ちへ移動しますが?",   //弹出框里面的提示文本
            icon: "warning",        //弹出框类型
            buttons: {
                cancel: "キャンセル",
                confirm: "確認",
            }
        })
        .then(willToAudit => {
            //按下confirm表示willDelete为true
            if (willToAudit) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "post",
                    url: "{{ url('/admin/articles/article/passToAudit') }}",
                    data: {'id': obj_admin.parent().siblings('.id').text(),
                        'title': obj_admin.parent().siblings('.title').text(),
                        'str_categories': obj_admin.parent().siblings('.str_categories').text(),
                        'user_name': obj_admin.parent().siblings('.user_name').text(),
                        'str_tags': obj_admin.parent().siblings('.str_tags').text(),
                    },

                    success: function (response) {
                        if (response.status == 10000) {
                            var str_passToAudit = '<tr class="audit-data">\n' +
                                // '<td>\n' +
                                // '<div class="checkbox-custom checkbox-default">\n' +
                                // '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                                // '<label for="table_checkbox"></label>\n' +
                                // '</div>\n' +
                                // '</td>\n' +
                                '<td class="id">' + response.data.id + '</td>\n' +
                                '<td class="title">' + response.data.title + '</td>\n' +
                                '<td class="str_categories">' + response.data.str_categories + '</td>\n' +
                                '<td class="user_name">' + response.data.user_name + '</td>\n' +
                                '<td class="str_tags">' + response.data.str_tags + '</td>\n' +
                                '<td class="updated_at">' + response.data.updated_at + ' ( ' + response.data.updated_at_format + ' ) ' + '</td>\n' +
                                '<td class="table_manage">\n' +
                                '<a class="btn btn-success btn_toPass btn-list" onclick="auditToPass(this)" id="' + response.data.id + '">公開記事へ</a>\n' +
                                '<a class="btn btn-success btn_toNotPass btn-list" onclick="auditToNotPass(this)" id="' + response.data.id + '">下書きへ</a>\n' +
                                '<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '">編集</a>\n' +
                                '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
                                '</td>\n' +
                                '</tr>';

                            obj_admin.parents(".tab-content").find(".auditBody").prepend(str_passToAudit);
                            obj_admin.parent().parent().remove();
                            //调整页面
                            // if(audit_current_page == 1 && $("#audit-items tr").length >= audit_page_size) {
                            //     $("#audit-items tr").eq(audit_page_size).css("display", "none");
                            // }else {
                            //     $("#audit-items tr").eq(0).css("display", "none"); //新添加的信息条隐藏
                            // }
                            // obj_admin.parent().parent().remove();
                            // if($("#pass-items tr").length >= pass_current_page * pass_page_size) {
                            //     $("#pass-items tr").eq(pass_current_page * pass_page_size - 1).css("display", "");
                            // }
                            // //移除后当前页面没有任何记录的话
                            // if($("#pass-items tr").length / pass_page_size == (pass_current_page - 1) && $("#pass-items tr").length % pass_page_size == 0) {
                            //     if(pass_current_page == 1 || pass_current_page == 2) {
                            //         pass_current_page = 1;
                            //         pass_current_first_item = 0;
                            //         $("#pass-items tr").each(function () {
                            //             if(pass_current_first_item < pass_page_size){
                            //                 $("#pass-items tr").eq(pass_current_first_item).fadeIn(500);
                            //                 ++pass_current_first_item;
                            //             }
                            //         });
                            //         pass_prev_btn.attr("disabled",true);
                            //         pass_next_btn.attr("disabled",true);
                            //     }
                            //     pass_current_page = pass_current_page - 2;
                            //     $("#pass_next").trigger("click");
                            // }
                            js_refresh_forPassArticle();
                            js_refresh_forAuditArticle();


                            swal("文章の編集", response.msg, "success");
                        }else {
                            swal("文章の編集", response.msg, "error");
                        }
                    },
                    error: function () {
                        swal("文章の編集", "エラが発生しました", "error");
                    },
                })
            }
        });
    }

    //待审核的文章转为审核通过
    function auditToPass(obj){
        //定义该按钮对象，方便之后使用
        var obj_admin = $(obj);
        swal({
            title: "ワーニング",      //弹出框的title
            text: "審査待ちの記事を公開記事へ移動しますが?",   //弹出框里面的提示文本
            icon: "warning",        //弹出框类型
            buttons: {
                cancel: "キャンセル",
                confirm: "確認",
            }
        })
        .then(willToPass => {
            //按下confirm表示willDelete为true
            if (willToPass) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "post",
                    url: "{{ url('/admin/articles/article/auditToPass') }}",
                    data: {'id': obj_admin.parent().siblings('.id').text(),
                        'title': obj_admin.parent().siblings('.title').text(),
                        'str_categories': obj_admin.parent().siblings('.str_categories').text(),
                        'user_name': obj_admin.parent().siblings('.user_name').text(),
                        'str_tags': obj_admin.parent().siblings('.str_tags').text(),
                        'updated_at': obj_admin.parent().siblings('.updated_at').text()
                    },

                    success: function (response) {
                        if (response.status == 10000) {
                            //console.log(response.data);
                            //console.log(response.data.article_relate[0].like_number);
                            var str_auditToPass = '<tr class="pass-data">\n' +
                                // '<td>\n' +
                                // '<div class="checkbox-custom checkbox-default">\n' +
                                // '<input type="checkbox" value="' + response.data.pageData.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                                // '<label for="table_checkbox"></label>\n' +
                                // '</div>\n' +
                                // '</td>\n' +
                                '<td class="id">' + response.data.pageData.id + '</td>\n' +
                                '<td class="title">' + response.data.pageData.title + '</td>\n' +
                                '<td class="str_categories">' + response.data.pageData.str_categories + '</td>\n' +
                                '<td class="user_name">' + response.data.pageData.user_name + '</td>\n' +
                                '<td class="str_tags">' + response.data.pageData.str_tags + '</td>\n' +
                                '<td class="article_relate">\n' +
                                '<i class="fa fa-clock-o"></i> &nbsp;<span class="updated_at">' + response.data.pageData.updated_at + ' ( ' + response.data.pageData.updated_at_format + ' ) ' + '</span>&nbsp;&nbsp;/&nbsp;&nbsp;' +
                                '<i class="fa fa-heart-o"></i> &nbsp;<span class="like_number">' + response.data.article_relate[0].like_number + '</span>&nbsp;&nbsp;·&nbsp;&nbsp;\n' +
                                '<i class="fa fa-bookmark-o"></i> &nbsp;<span class="store_number">' + response.data.article_relate[0].store_number + '</span>&nbsp;&nbsp;·&nbsp;&nbsp;\n' +
                                '<i class="fa fa-comment-o"></i> &nbsp;<span class="comment_number">' + response.data.article_relate[0].comment_number + '</span>\n' +
                                '</td>\n' +
                                '<td class="table_manage">\n' +
                                '<a class="btn btn-success btn_toAudit btn-list" onclick="passToAudit(this)" id="' + response.data.pageData.id + '">審査待ちへ</a>\n' +
                                '\n' +
                                '<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.pageData.id + '"> 編集</a>\n' +
                                '\n' +
                                '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.pageData.id + '">削除</a>\n' +
                                '</td>\n' +
                                '</tr>';

                            obj_admin.parents(".tab-content").find(".passBody").prepend(str_auditToPass);
                            obj_admin.parent().parent().remove();
                            //调整页面
                            // if(pass_current_page == 1 ) {
                            //     if($("#pass-items tr").length >= pass_page_size) {
                            //         $("#pass-items tr").eq(pass_page_size).css("display", "none");
                            //     }
                            // }else {
                            //     $("#pass-items tr").eq(0).css("display", "none"); //新添加的信息条隐藏
                            // }
                            // obj_admin.parent().parent().remove();
                            // if($("#audit-items tr").length >= audit_current_page * audit_page_size) {
                            //     $("#audit-items tr").eq(audit_current_page * audit_page_size - 1).css("display", "");
                            // }
                            // //移除后当前页面没有任何记录的话
                            // if($("#audit-items tr").length / audit_page_size == (audit_current_page - 1) && $("#audit-items tr").length % audit_page_size == 0) {
                            //     if(audit_current_page == 1 || audit_current_page == 2) {
                            //         audit_current_page = 1;
                            //         audit_current_first_item = 0;
                            //         $("#audit-items tr").each(function () {
                            //             if(audit_current_first_item < audit_page_size){
                            //                 $("#audit-items tr").eq(audit_current_first_item).fadeIn(500);
                            //                 ++audit_current_first_item;
                            //             }
                            //         });
                            //         audit_prev_btn.attr("disabled",true);
                            //         audit_next_btn.attr("disabled",true);
                            //     }
                            //     audit_current_page = audit_current_page - 2;
                            //     $("#audit_next").trigger("click");
                            // }
                            js_refresh_forAuditArticle();
                            js_refresh_forPassArticle();

                            swal("文章の編集", response.msg, "success");
                        }else {
                            swal("文章の編集", response.msg, "error");
                        }
                    },
                    error: function () {
                        swal("文章の編集", "エラが発生しました", "error");
                    },
                })
            }
        });
    }

    //待审核的文章转为审核不通过
    function auditToNotPass(obj){
        //定义该按钮对象，方便之后使用
        var obj_admin = $(obj);
        swal({
            title: "ワーニング",      //弹出框的title
            text: "審査待ちの記事を下書きへ移動しますが?",   //弹出框里面的提示文本
            icon: "warning",        //弹出框类型
            buttons: {
                cancel: "キャンセル",
                confirm: "確認",
            }
        })
        .then(willToNotPass => {
            //按下confirm表示willDelete为true
            if (willToNotPass) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "post",
                    url: "{{ url('/admin/articles/article/auditToNotPass') }}",
                    data: {'id': obj_admin.parent().siblings('.id').text(),
                        'title': obj_admin.parent().siblings('.title').text(),
                        'str_categories': obj_admin.parent().siblings('.str_categories').text(),
                        'user_name': obj_admin.parent().siblings('.user_name').text(),
                        'str_tags': obj_admin.parent().siblings('.str_tags').text(),
                        'updated_at': obj_admin.parent().siblings('.updated_at').text()
                    },

                    success: function (response) {
                        if (response.status == 10000) {
                            //console.log(response.data);
                            var str_auditToNotPass = '<tr class="draft-data">\n' +
                                // '<td>\n' +
                                // '<div class="checkbox-custom checkbox-default">\n' +
                                // '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                                // '<label for="table_checkbox"></label>\n' +
                                // '</div>\n' +
                                // '</td>\n' +
                                '<td class="id">' + response.data.id + '</td>\n' +
                                '<td class="title">' + response.data.title + '</td>\n' +
                                '<td class="str_categories">' + response.data.str_categories + '</td>\n' +
                                '<td class="user_name">' + response.data.user_name + '</td>\n' +
                                '<td class="str_tags">' + response.data.str_tags + '</td>\n' +
                                '<td class="updated_at">' + response.data.updated_at + ' ( ' + response.data.updated_at_format + ' ) ' + '</td>\n' +
                                '<td class="table_manage">\n' +
                                '<a class="btn btn-success btn_toPass btn-list" onclick="draftToPass(this)" id="' + response.data.id + '">公開記事へ</a>\n' +
                                '<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '">編集</a>\n' +
                                '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
                                '</td>\n' +
                                '</tr>';

                            obj_admin.parents(".tab-content").find(".draftBody").prepend(str_auditToNotPass);
                            obj_admin.parent().parent().remove();
                            //调整页面
                            // if(draft_current_page == 1 && $("#draft-items tr").length >= draft_page_size) {
                            //     $("#draft-items tr").eq(draft_page_size).css("display", "none");
                            // }else {
                            //     $("#draft-items tr").eq(0).css("display", "none"); //新添加的信息条隐藏
                            // }
                            // obj_admin.parent().parent().remove();
                            // if($("#audit-items tr").length >= audit_current_page * audit_page_size) {
                            //     $("#audit-items tr").eq(audit_current_page * audit_page_size - 1).css("display", "");
                            // }
                            // //移除后当前页面没有任何记录的话
                            // if($("#audit-items tr").length / audit_page_size == (audit_current_page - 1) && $("#audit-items tr").length % audit_page_size == 0) {
                            //     if(audit_current_page == 1 || audit_current_page == 2) {
                            //         audit_current_page = 1;
                            //         audit_current_first_item = 0;
                            //         $("#audit-items tr").each(function () {
                            //             if(audit_current_first_item < audit_page_size){
                            //                 $("#audit-items tr").eq(audit_current_first_item).fadeIn(500);
                            //                 ++audit_current_first_item;
                            //             }
                            //         });
                            //         audit_prev_btn.attr("disabled",true);
                            //         audit_next_btn.attr("disabled",true);
                            //     }
                            //     audit_current_page = audit_current_page - 2;
                            //     $("#audit_next").trigger("click");
                            // }
                            js_refresh_forAuditArticle();
                            js_refresh_forDraftArticle();

                            swal("文章の編集", response.msg, "success");
                        }else {
                            swal("文章の編集", response.msg, "error");
                        }
                    },
                    error: function () {
                        swal("文章の編集", "エラが発生しました", "error");
                    },
                })
            }
        });
    }

    //审核不通过的文章转为审核通过
    function draftToPass(obj){
        //定义该按钮对象，方便之后使用
        var obj_admin = $(obj);
        swal({
            title: "ワーニング",      //弹出框的title
            text: "下書きを公開記事へ移動しますが?",   //弹出框里面的提示文本
            icon: "warning",        //弹出框类型
            buttons: {
                cancel: "キャンセル",
                confirm: "確認",
            }
        })
        .then(willToPass => {
            //按下confirm表示willDelete为true
            if (willToPass) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "post",
                    url: "{{ url('/admin/articles/article/auditToPass') }}",
                    data: {'id': obj_admin.parent().siblings('.id').text(),
                        'title': obj_admin.parent().siblings('.title').text(),
                        'str_categories': obj_admin.parent().siblings('.str_categories').text(),
                        'user_name': obj_admin.parent().siblings('.user_name').text(),
                        'str_tags': obj_admin.parent().siblings('.str_tags').text(),
                        'updated_at': obj_admin.parent().siblings('.updated_at').text()
                    },

                    success: function (response) {
                        if (response.status == 10000) {
                            //console.log(response.data);
                            //console.log(response.data.article_relate[0].like_number);
                            var str_draftToPass = '<tr class="pass-data">\n' +
                                // '<td>\n' +
                                // '<div class="checkbox-custom checkbox-default">\n' +
                                // '<input type="checkbox" value="' + response.data.pageData.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                                // '<label for="table_checkbox"></label>\n' +
                                // '</div>\n' +
                                // '</td>\n' +
                                '<td class="id">' + response.data.pageData.id + '</td>\n' +
                                '<td class="title">' + response.data.pageData.title + '</td>\n' +
                                '<td class="str_categories">' + response.data.pageData.str_categories + '</td>\n' +
                                '<td class="user_name">' + response.data.pageData.user_name + '</td>\n' +
                                '<td class="str_tags">' + response.data.pageData.str_tags + '</td>\n' +
                                '<td class="article_relate">\n' +
                                '<i class="fa fa-clock-o"></i> &nbsp;<span class="updated_at">' + response.data.pageData.updated_at + ' ( ' + response.data.pageData.updated_at_format + ' ) ' + '</span>&nbsp;&nbsp;/&nbsp;&nbsp;' +
                                '<i class="fa fa-heart-o"></i> &nbsp;<span class="like_number">' + response.data.article_relate[0].like_number + '</span>&nbsp;&nbsp;·&nbsp;&nbsp;\n' +
                                '<i class="fa fa-bookmark-o"></i> &nbsp;<span class="store_number">' + response.data.article_relate[0].store_number + '</span>&nbsp;&nbsp;·&nbsp;&nbsp;\n' +
                                '<i class="fa fa-comment-o"></i> &nbsp;<span class="comment_number">' + response.data.article_relate[0].comment_number + '</span>\n' +
                                '</td>\n' +
                                '<td class="table_manage">\n' +
                                '<a class="btn btn-success btn_toAudit btn-list" onclick="passToAudit(this)" id="' + response.data.pageData.id + '">審査待ちへ</a>\n' +
                                '\n' +
                                '<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.pageData.id + '"> 編集</a>\n' +
                                '\n' +
                                '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.pageData.id + '">削除</a>\n' +
                                '</td>\n' +
                                '</tr>';

                            obj_admin.parents(".tab-content").find(".passBody").prepend(str_draftToPass);
                            obj_admin.parent().parent().remove();
                            //调整页面
                            // if(pass_current_page == 1 && $("#pass-items tr").length >= pass_page_size) {
                            //     $("#pass-items tr").eq(pass_page_size).css("display", "none");
                            // }else {
                            //     $("#pass-items tr").eq(0).css("display", "none"); //新添加的信息条隐藏
                            // }
                            // obj_admin.parent().parent().remove();
                            // if($("#draft-items tr").length >= draft_current_page * draft_page_size) {
                            //     $("#draft-items tr").eq(draft_current_page * draft_page_size - 1).css("display", "");
                            // }
                            // //移除后当前页面没有任何记录的话
                            // if($("#draft-items tr").length / draft_page_size == (draft_current_page - 1) && $("#draft-items tr").length % draft_page_size == 0) {
                            //     if(draft_current_page == 1 || draft_current_page == 2) {
                            //         draft_current_page = 1;
                            //         draft_current_first_item = 0;
                            //         $("#draft-items tr").each(function () {
                            //             if(draft_current_first_item < draft_page_size){
                            //                 $("#draft-items tr").eq(draft_current_first_item).fadeIn(500);
                            //                 ++draft_current_first_item;
                            //             }
                            //         });
                            //         draft_prev_btn.attr("disabled",true);
                            //         draft_next_btn.attr("disabled",true);
                            //     }
                            //     draft_current_page = draft_current_page - 2;
                            //     $("#draft_next").trigger("click");
                            // }
                            js_refresh_forDraftArticle();
                            js_refresh_forPassArticle();

                            swal("文章の編集", response.msg, "success");
                        }else {
                            swal("文章の編集", response.msg, "error");
                        }
                    },
                    error: function () {
                        swal("文章の編集", "エラが発生しました", "error");
                    },
                })
            }
        });
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////delete////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////

    // 确认删除提示框(Admin)
    function btn_delete(obj){
        //定义该按钮对象，方便之后使用
        var obj_admin = $(obj);
        swal({
            title: "ワーニング",      //弹出框的title
            text: "削除しますが?",   //弹出框里面的提示文本
            icon: "warning",        //弹出框类型
            buttons: {
                cancel: "キャンセル",
                confirm: "確認",
            }
        })
        .then(willDelete => {
            //按下confirm表示willDelete为true
            if (willDelete) {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: "post",
                    url: "{{ url('/admin/articles/article/delete') }}",
                    data: {'id': obj_admin.attr('id')},
                    success: function (response) {
                        if (response.status == 10000) {
                            swal("文章の編集", response.msg, "success");
                            obj_admin.parents("tr").remove();

                            js_refresh_forPassArticle();
                            js_refresh_forAuditArticle();
                            js_refresh_forDraftArticle();

                        }else {
                            swal("文章の編集", response.msg, "error");
                        }
                    },
                    error: function () {
                        swal("文章の編集", "エラが発生しました", "error");
                    },
                })
            }
        });

    }



</script>
@endsection

