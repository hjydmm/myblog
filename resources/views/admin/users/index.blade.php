@extends('layouts.admin')
@section('title','ユーザー管理')
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #fff;">
                    <a href="javascript:location.replace(location.href);" class="btn btn-primary btn-list btn-nav"><i class="fa fa-refresh"></i> リフレッシュ</a>
                    {{--<a class="btn btn-success btn_addNew btn-list btn-nav" onclick="btn_addNew(this)" ><i class="fa fa-plus"></i> 新規アカウント</a>--}}
                    {{--<a class="btn btn-info btn_batchEdit btn-list btn-nav" onclick="btn_batchEdit(this)" ><i class="fa fa-pencil"></i> まとめの修正</a>--}}
                    {{--<a class="btn btn-danger btn_batchDelete btn-list btn-nav" onclick="btn_batchDelete(this)" ><i class="fa fa-times"></i> まとめの削除</a>--}}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style="min-height: 740px;">
                    <table width="100%" class="table table-striped table-bordered table-hover dataTables" id="dataTables-example">
                        <thead>
                        <tr>
                            {{--<th>全て選択</th>--}}
                            <th>ID</th>
                            <th>ユーザー</th>
                            <th>写真</th>
                            <th>性別</th>
                            <th>メールアドレス</th>
                            <th>都道府県</th>
                            <th>GitHub</th>
                            <th>アピール</th>
                            <th>ステータス</th>
                            <th>その他</th>
                        </tr>
                        </thead>
                        <tbody id="table-items" style="">
                        @foreach($data as $val)
                            <tr class="table-data" style="display:none;line-height: 64px;height: 64px;">
                                {{--<td>--}}
                                    {{--<div class="checkbox-custom checkbox-default">--}}
                                        {{--<input type="checkbox" value="{{$val -> id}}" name="checkbox[]" class="data_box" id="table_checkbox">--}}
                                        {{--<label for="table_checkbox"></label>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                <td>{{$val -> id}}</td>
                                <td>{{$val -> user_name}}</td>
                                <td>
                                    {{--<div>--}}
                                        <div style="width:40px;height:40px;margin:0;padding:0;background:url('{{ $val->avatar }}') no-repeat center / cover" class="thumbnail"></div>
                                    {{--</div>--}}
                                    {{--<img src="{{$val -> avatar}}" width="50" height="50"/>--}}
                                </td>
                                <td>
                                    @if($val -> gender == '1')
                                        男
                                    @elseif($val -> gender == '2')
                                        女
                                    @else
                                        秘密
                                    @endif
                                </td>
                                <td>{{$val -> email}}</td>
                                <td>{{$val -> city}}</td>
                                {{--<td>--}}
                                    {{--@if($val -> activation == '1')--}}
                                        {{--未激活--}}
                                    {{--@elseif($val -> activation == '2')--}}
                                        {{--已激活--}}
                                    {{--@else--}}
                                        {{--未知错误--}}
                                    {{--@endif--}}
                                {{--</td>--}}
                                <td><a target="_blank" href="{{$val->github_homepage}}">{{$val->github_name}}</a></td>
                                <td>{{$val->introduction}}</td>
                                <td class="table_status">
                                    @if($val -> status == '1')
                                        <a class="btn btn-info btn-circle btn-list"><i class="fa fa-check"></i></a>
                                    @else
                                        <a class="btn btn-danger btn-circle btn-list"><i class="fa fa-times"></i></a>
                                    @endif
                                </td>
                                <td class="table_manage">

                                    @if($val->id == '6' || $val->id == '7' || $val->id == '8')
                                        @if($val -> status == '1')
                                            <a class="btn btn-danger btn_stop btn-list" id="{{$val -> id}}" style="background-color: rgba(217, 83, 79, 0.5);border-color: rgba(217, 83, 79, 0.5);">アカウント(オフ)</a>
                                        @else
                                            <a class="btn btn-info btn_start btn-list" id="{{$val -> id}}" style="background-color: rgba(217, 83, 79, 0.5);border-color: rgba(217, 83, 79, 0.5);">アカウント(オン)</a>
                                        @endif
                                        <a href="javascript:void(0);" class="btn btn-danger btn_delete btn-list" id="{{$val -> id}}" style="background-color: rgba(217, 83, 79, 0.5);border-color: rgba(217, 83, 79, 0.5);">削除</a>
                                    @else
                                        @if($val -> status == '1')
                                            <a class="btn btn-danger btn_stop btn-list" onclick="btn_stop(this)" id="{{$val -> id}}">アカウント(オフ)</a>
                                        @else
                                            <a class="btn btn-info btn_start btn-list" onclick="btn_start(this)" id="{{$val -> id}}">アカウント(オン)</a>
                                        @endif
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

    </div>

@endsection

@section('userList-script')
    <script>

        var tableObject_admin = $('.dataTables_admin').DataTable({
            responsive: true,
            paging: false,
            searching: false,
            info: false,
            "aaSorting": [[ 0, "asc" ]],//默认第几个排序
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,1,2,3,4,5,6,7]}// 制定列不参与排序
            ]
        });

        $("#admin-userList").attr("href", "javascript:void(0);");
        $("#admin-userList").css("color", "#F67777").css("border", "1px solid #F67777").css("background-color", "#fff");

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
                            url: "{{ url('/admin/users/delete') }}",
                            data: {'id': obj_admin.attr('id')},
                            success: function (response) {
                                if (response.status == 10000) {
                                    swal("情報編集", response.msg, "success");
                                    obj_admin.parents("tr").remove();

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
                            url: "{{ url('/admin/users/status_start') }}",
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
                            url: "{{ url('/admin/users/status_stop') }}",
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

    </script>
@endsection


