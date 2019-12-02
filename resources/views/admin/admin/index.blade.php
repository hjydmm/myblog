@extends('layouts.admin')
@section('title','管理者')
@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #fff;">
                <a href="javascript:location.replace(location.href);" class="btn btn-primary btn-list btn-nav"><i class="fa fa-refresh"></i> リフレッシュ</a>
                <a class="btn btn-success btn_addNew btn-list btn-nav" onclick="btn_addNew(this)" ><i class="fa fa-plus"></i> 新規アカウント</a>
                {{--<a class="btn btn-info btn_batchEdit btn-list btn-nav" onclick="btn_batchEdit(this)" ><i class="fa fa-pencil"></i> まとめの修正</a>--}}
                {{--<a class="btn btn-danger btn_batchDelete btn-list btn-nav" onclick="btn_batchDelete(this)" ><i class="fa fa-times"></i> まとめの削除</a>--}}
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" style="min-height: 640px;">
                <table width="100%" class="table table-striped table-bordered table-hover dataTables_admin" id="dataTables-example">
                    <thead>
                    <tr>
                        {{--<th>全て選択</th>--}}
                        <th>ID</th>
                        <th>管理者ネーム</th>
                        <th>性別</th>
                        <th>電話番号</th>
                        <th>メール</th>
                        {{--<th>ポスト</th>--}}
                        <th>ステータス</th>
                        <th>その他</th>
                    </tr>
                    </thead>
                    <tbody id="table-items">
                    @foreach($data as $val)
                    <tr class="table-data" style="display: none;">
                        {{--<td>--}}
                            {{--<div class="checkbox-custom checkbox-default">--}}
                                {{--<input type="checkbox" value="{{$val -> id}}" name="checkbox[]" class="data_box" id="table_checkbox">--}}
                                {{--<label for="table_checkbox"></label>--}}
                            {{--</div>--}}
                        {{--</td>--}}
                        <td class="id" id="{{$val -> id}}">{{$val -> id}}</td>
                        <td class="username">{{$val -> username}}</td>
                        <td class="gender">
                            @if($val -> gender == '1')
                                男
                            @elseif($val -> gender == '2')
                                女
                            @else
                                秘密
                            @endif
                        </td>
                        <td class="mobile">{{$val -> mobile}}</td>
                        <td class="email">{{$val -> email}}</td>
                        {{--<td class="position">管理者</td>--}}
                        <td class="table_status">
                            @if($val -> status == '1')
                                <a class="btn btn-info btn-circle btn-list"><i class="fa fa-check"></i></a>
                            @else
                                <a class="btn btn-danger btn-circle btn-list"><i class="fa fa-times"></i></a>
                            @endif
                        </td>
                        <td class="table_manage">

                            @if($val->id == '1')
                                @if($val -> status == '1')
                                    <a class="btn btn-danger btn_stop btn-list" id="{{$val -> id}}" style="background-color: rgba(217, 83, 79, 0.5);border-color: rgba(217, 83, 79, 0.5);">アカウント(オフ)</a>
                                @else
                                    <a class="btn btn-info btn_start btn-list" id="{{$val -> id}}" style="background-color: rgba(217, 83, 79, 0.5);border-color: rgba(217, 83, 79, 0.5);">アカウント(オン)</a>
                                @endif
                                <a class="btn btn-warning btn_changePassword btn-list" id="{{$val -> id}}" style="background-color: rgba(240, 173, 78, 0.5);border-color: rgba(240, 173, 78, 0.5);">パスワード変更</a>
                                <a class="btn btn-success btn_edit btn-list" id="{{$val -> id}}" style="background-color: rgba(92, 184, 92, 0.5);border-color: rgba(92, 184, 92, 0.5);">編集</a>
                                <a href="javascript:void(0);" class="btn btn-danger btn_delete btn-list" id="{{$val -> id}}" style="background-color: rgba(217, 83, 79, 0.5);border-color: rgba(217, 83, 79, 0.5);">削除</a>
                            @else
                                @if($val -> status == '1')
                                    <a class="btn btn-danger btn_stop btn-list" onclick="btn_stop(this)" id="{{$val -> id}}">アカウント(オフ)</a>
                                @else
                                    <a class="btn btn-info btn_start btn-list" onclick="btn_start(this)" id="{{$val -> id}}">アカウント(オン)</a>
                                @endif
                                <a class="btn btn-warning btn_changePassword btn-list" onclick="btn_changePassword(this)" id="{{$val -> id}}">パスワード変更</a>
                                <a class="btn btn-success btn_edit btn-list" onclick="btn_edit(this)" id="{{$val -> id}}">編集</a>
                                <a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="{{$val -> id}}">削除</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
            <ul class="pager">
                <li><button id="table_prev" onclick="table_previous_page(this)" disabled="disabled">前のページ</button></li>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li><button id="table_next" onclick="table_next_page(this)">次のページ</button></li>
            </ul>
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

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
                    {{--<div class="form-group">--}}
                        {{--<label for="position_id_edit">ポスト</label>--}}
                        {{--<input type="text" name="position_id_edit" class="form-control" id="position_id_edit" placeholder="职位模块弄完再完善">--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="status_edit">ステータス</label>
                        <div>
                            <input name="status_edit" class="status_edit" type="radio" id="status_edit" value="1" checked>
                            <label for="status_edit"> オン </label>
                            <input name="status_edit" class="status_edit" type="radio" id="status_edit" value="2">
                            <label for="status_edit"> オフ </label>
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

    <!-- 新增弹出框代码，默认隐藏 -->
    <div class="modal fade" id="myModal_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel_add">新規アカウント</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username_add">管理者ネーム</label>
                        <input type="text" name="username_add" class="form-control" id="username_add" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="username_add">パスワード</label>
                        <input type="password" name="password_add" class="form-control" id="password_add" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="mobile_add">電話番号</label>
                        <input type="text" name="mobile_add" class="form-control" id="mobile_add" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="email_add">メール</label>
                        <input type="text" name="email_add" class="form-control" id="email_add" placeholder="">
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label for="position_id_add">ポスト</label>--}}
                        {{--<input type="text" name="position_id_add" class="form-control" id="position_id_add" placeholder="開発中">--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="status_add">ステータス</label>
                        <div>
                            <input name="status_add" class="status_add" type="radio" id="status_add" value="1" checked>
                            <label for="status_add"> オン </label>
                            <input name="status_add" class="status_add" type="radio" id="status_add" value="2">
                            <label for="status_add"> オフ </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender_add">性別</label>
                        <div>
                            <input name="gender_add" class="gender_add" type="radio" id="gender_add" value="1" checked>
                            <label for="gender_add"> 男 </label>
                            <input name="gender_add" class="gender_add" type="radio" id="gender_add" value="2">
                            <label for="gender_add"> 女 </label>
                            <input name="gender_add" class="gender_add" type="radio" id="gender_add" value="3">
                            <label for="gender_add"> 秘密　</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal"><span aria-hidden="true"></span>キャンセル</a>
                    <a id="btn_newSubmit" onclick="btn_newSubmit(this)" class="btn btn-primary" data-dismiss="modal"><span aria-hidden="true"></span>確認</a>
                </div>
            </div>
        </div>
    </div>

    <!-- 密码修改弹出框代码，默认隐藏 -->
    <div class="modal fade" id="myModal_changePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel_changePassword">パスワード変更</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="old_password">パスワード(旧)</label>
                        <input type="password" class="form-control input-lg old_password" id="old_password" value="" name="old_password" placeholder="古いパスワードを入力してください" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="new_password">パスワード(新)</label>
                        <input type="password" class="form-control input-lg new_password" id="new_password" value="" name="new_password" placeholder="新いパスワードを入力してください" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="email">パスワード(新)再確認</label>
                        <input type="password" class="form-control input-lg confirm_new_password" id="confirm_new_password" value="" name="confirm_new_password" placeholder="新いパスワードをもう一回入力してください" autocomplete="off">
                    </div>
                    <input type="hidden" value="" id="changePassword_hidden_id">
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal"><span aria-hidden="true"></span>キャンセル</a>
                    <a id="btn_changePasswordSubmit" onclick="btn_changePasswordSubmit(this)" class="btn btn-primary" data-dismiss="modal"><span aria-hidden="true"></span>確認</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('adminList-script')
<script>

    var tableObject_admin = $('.dataTables_admin').DataTable({
        responsive: true,
        paging: false,
        searching: false,
        info: false,
        "aaSorting": [[ 0, "asc" ]],//默认第几个排序
        "aoColumnDefs": [
            //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
            {"orderable":false,"aTargets":[0,1,2,3,4,5,6]}// 制定列不参与排序
        ]
    });

    //管理员选中状态
    $("#admin-adminList").attr("href", "javascript:void(0);");
    $("#admin-adminList").css("color", "#F67777").css("border", "1px solid #F67777").css("background-color", "#fff");

    // 展示新增框(Admin)
    function btn_addNew(obj){
        $('#myModal_add').modal();
    }

    // 新增确认框(Admin)
    function btn_newSubmit(obj){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "post",
            url: "{{ url('/admin/admin/add') }}",
            data: {
                'username': $("#username_add").val(),
                'password': $("#password_add").val(),
                'mobile': $("#mobile_add").val(),
                'email': $("#email_add").val(),
                'position_id': "1",   //后面再完善
                'status': $('input[name="status_add"]:checked').val(),
                'gender': $('input[name="gender_add"]:checked').val(),
            },
            success: function (response) {

                if (response.status == 10000) {
                    swal("アカウント作成", response.msg, "success");
                    //window.location = window.location;
                    var newList_part1 = '<tr class="table-data">\n' +
                        // '<td>\n' +
                        // '<div class="checkbox-custom checkbox-default">\n' +
                        // '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                        // '<label for="table_checkbox"></label>\n' +
                        // '</div>\n' +
                        // '</td>\n' +
                        '<td class="id" id="' + response.data.id + '">' + response.data.id + '</td>\n' +
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
                        '<td class="email">' + response.data.email + '</td>\n';
                        // '<td class="position">管理者</td>\n';

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
                        '<a class="btn btn-success btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '">編集</a>\n' +
                        '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
                        '</td>\n' +
                        '</tr>';
                    if(response.data.status == "1") {
                        var newList = newList_part1 + newList_part2 + newList_part3 + newList_part4 + newList_part6;
                    }else {
                        newList = newList_part1 + newList_part2 + newList_part3 + newList_part5 + newList_part6;
                    }
                    //$("#table-items").append(newList);
                    // if($('tr[style="display:none;"]').length == 10) {
                    //     alert("abc");
                    //     $(".table-data").css('display','none');
                    // }
                    $("#table-items tr").last().after(newList);
                    //window.location = window.location;

                    js_refresh();

                }else {
                    swal("アカウント作成", response.msg, "error");
                }
            },
            error: function () {
                swal("アカウント作成", "エラが発生しました", "error");
            },
        })
    }

    // 展示编辑框(Admin)
    function btn_edit(obj){
        var obj_admin = $(obj);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"post",
            url: "{{ url('/admin/admin/find') }}",
            data: {'id': obj_admin.attr('id')},
            success: function(response){
                if(response.status == 10000){
                    $("#myModalLabel_edit").text(" " + response.data[0].username + " の情報編集");
                    $("#username_edit").val(response.data[0].username);
                    $("#mobile_edit").val(response.data[0].mobile);
                    $("#email_edit").val(response.data[0].email);
                    $("#position_edit").val("2");
                    $("#hidden_id").val(response.data[0].id);
                    $('.status_edit[value=' + response.data[0].status + ']').prop("checked", true);
                    $('.gender_edit[value=' + response.data[0].gender + ']').prop("checked", true);
                    $('#myModal_edit').modal();
                }else {
                    swal("情報編集", "エラが発生しました", "error");
                }
            },
            error: function() {
                swal("情報編集", "エラが発生しました", "error");
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
                    swal("情報編集", response.msg, "success");
                    //window.location = window.location;
                    var newList_part1 = '<tr class="table-data">\n' +
                        // '<td>\n' +
                        // '<div class="checkbox-custom checkbox-default">\n' +
                        // '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                        // '<label for="table_checkbox"></label>\n' +
                        // '</div>\n' +
                        // '</td>\n' +
                        '<td class="id" id="' + response.data.id + '">' + response.data.id + '</td>\n' +
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
                        '<td class="email">' + response.data.email + '</td>\n';
                        // '<td class="position">管理者</td>\n';

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
                        '<a class="btn btn-success btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '">編集</a>\n' +
                        '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
                        '</td>\n' +
                        '</tr>';
                    if(response.data.status == "1") {
                        var newList = newList_part1 + newList_part2 + newList_part3 + newList_part4 + newList_part6;
                    }else {
                        newList = newList_part1 + newList_part2 + newList_part3 + newList_part5 + newList_part6;
                    }
                    var element = $('td[id=' + response.data.id + ']').parent();
                    element.after(newList);
                    element.remove();

                    js_refresh();

                }else {
                    swal("情報編集", response.msg, "error");
                }
            },
            error: function () {
                swal("情報編集", "エラが発生しました", "error");
            },
        })

    }

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
                        url: "{{ url('/admin/admin/delete') }}",
                        data: {'id': obj_admin.attr('id')},
                        success: function (response) {
                            if (response.status == 10000) {
                                // swal("情報編集", response.msg, "success").then(function(isConfirm) {
                                //         if (isConfirm === true) {
                                //             window.location = window.location;
                                //         }else {
                                //             window.location = window.location;
                                //         }
                                //         });
                                swal("情報編集", response.msg, "success");
                                obj_admin.parents("tr").remove();
                                //window.location = window.location;
                                //tableObject_admin.fnReloadAjax;
                                //tableObject_admin.ajax.reload();
                                //tableObject_admin.ajax.url( '/admin/admin/index2' ).load();

                                js_refresh();

                            }else {
                                swal("情報編集", response.msg, "error");
                            }
                        },
                        error: function () {
                            swal("情報編集", "エラが発生しました", "error");
                        },
                    })
                }
            });

    }

    // 切换账号状态(开启)(Admin)
    function btn_start(obj){
        //定义该按钮对象，方便之后使用
        var obj_admin = $(obj);
        swal({
            title: "ワーニング",      //弹出框的title
            text: "アカウントをオンにしますが?",   //弹出框里面的提示文本
            icon: "warning",        //弹出框类型
            buttons: {
                cancel: "キャンセル",
                confirm: "確認",
            }
        })
            .then(willStart => {
                //按下confirm表示willDelete为true
                if (willStart) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "post",
                        url: "{{ url('/admin/admin/status_start') }}",
                        data: {'id': obj_admin.attr('id')},
                        success: function (response) {
                            if (response.status == 10000) {
                                obj_admin.parents("tr").find(".table_manage").prepend('<a class="btn btn-danger btn_stop btn-list" onclick="btn_stop(this)" id="' + response.data['id'] + '">アカウント(オフ)</a>');
                                obj_admin.parents("tr").find(".table_status").html('<a class="btn btn-info btn-circle btn-list"><i class="fa fa-check"></i></a>');
                                obj_admin.remove();
                                swal("情報編集", response.msg, "success");
                            }else {
                                swal("情報編集", response.msg, "error");
                            }
                        },
                        error: function () {
                            swal("情報編集", "エラが発生しました", "error");
                        },
                    })
                }
            });
    }

    // 切换账号状态(关闭)(Admin)
    function btn_stop(obj){
        //定义该按钮对象，方便之后使用
        var obj_admin = $(obj);
        swal({
            title: "ワーニング",      //弹出框的title
            text: "アカウントをオフにしますが?",   //弹出框里面的提示文本
            icon: "warning",        //弹出框类型
            buttons: {
                cancel: "キャンセル",
                confirm: "確認",
            }
        })
            .then(willStop => {
                //按下confirm表示willDelete为true
                if (willStop) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: "post",
                        url: "{{ url('/admin/admin/status_stop') }}",
                        data: {'id': obj_admin.attr('id')},
                        success: function (response) {
                            if (response.status == 10000) {
                                obj_admin.parents("tr").find(".table_manage").prepend('<a class="btn btn-info btn_start btn-list" onclick="btn_start(this)" id="' + response.data['id'] + '">アカウント(オン)</a>');
                                obj_admin.parents("tr").find(".table_status").html('<a class="btn btn-danger btn-circle btn-list"><i class="fa fa-times"></i></a>');
                                obj_admin.remove();
                                swal("情報編集", response.msg, "success");
                            }else {
                                swal("情報編集", response.msg, "error");
                            }
                        },
                        error: function () {
                            swal("情報編集", "エラが発生しました", "error");
                        },
                    })
                }
            });
    }

    // 展示密码修改框(Admin)
    function btn_changePassword(obj){
        var obj_admin = $(obj);
        $("#changePassword_hidden_id").val(obj_admin.attr("id"));
        $('#myModal_changePassword').modal();
    }

    // 提交修改密码(Admin)
    function btn_changePasswordSubmit(obj){
        var obj_admin = $(obj);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"post",
            url: "{{ url('/admin/admin/changePassword') }}",
            data: {'id': $("#changePassword_hidden_id").val(),
                    'old_password': $("#old_password").val(),
                    'new_password': $("#new_password").val(),
                    'confirm_new_password': $("#confirm_new_password").val(),
            },
            success: function (response) {
                $("#old_password").val("");
                $("#new_password").val("");
                $("#confirm_new_password").val("");
                if (response.status == 10000) {
                    swal("パスワード変更", response.msg, "success");
                }else {
                    swal("パスワード変更", response.msg, "error");
                }
            },
            error: function () {
                $("#old_password").val("");
                $("#new_password").val("");
                $("#confirm_new_password").val("");
                swal("パスワード変更", "エラが発生しました", "error");
            },
        });
    }


</script>
@endsection




