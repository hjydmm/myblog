@extends('layouts.admin')
@section('title','タグ')
@section('content')

    <!-- /.row -->
    <div class="row">

        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="javascript:location.replace(location.href);" class="btn btn-primary btn-list btn-nav"><i class="fa fa-refresh"></i> リフレッシュ</a>
                    <a class="btn btn-success btn_addNew btn-list btn-nav" onclick="btn_addNew(this)" ><i class="fa fa-plus"></i> 新規タグ</a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style="min-height: 640px;">
                    <table width="100%" class="table table-striped table-bordered table-hover dataTables_tag" id="dataTables-example">
                        <thead>
                        <tr>
                            {{--<th>全て選択</th>--}}
                            <th>ID</th>
                            <th>タグネーム</th>
                            <th>インデックス</th>
                            <th>重み</th>
                            <th>その他</th>
                        </tr>
                        </thead>
                        <tbody id="tag-items" class="tagBody">
                        @foreach($data as $val)
                            <tr class="tag-data" style="display:none;">
                                {{--<td>--}}
                                {{--<div class="checkbox-custom checkbox-default">--}}
                                {{--<input type="checkbox" value="{{$val -> id}}" name="checkbox[]" class="data_box" id="table_checkbox">--}}
                                {{--<label for="table_checkbox"></label>--}}
                                {{--</div>--}}
                                {{--</td>--}}
                                <td class="id">{{$val -> id}}</td>
                                <td class="name">{{$val -> name}}</td>
                                <td class="index" id="{{$val -> index}}">{{$val -> index}}</td>
                                <td class="weight">{{$val -> weight}}</td>
                                <td class="table_manage">
                                    <a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="{{$val -> id}}"> 編集</a>
                                    <a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="{{$val -> id}}">削除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" id="data_count" value="{{ count($data) }}">
                </div>
                <!-- /.panel-body -->
                <ul class="pager">
                    <li><button id="table_prev" onclick="table_previous_page(this)" disabled="disabled">前のページ</button></li>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><button id="table_next" onclick="table_next_page(this)">次のページ</button></li>
                </ul>
                <div class="g-cf g-pagerwp">
                    <div style="visibility:hidden" class="g-pager">
                    </div>
                </div>
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
                            <label for="tag_name_edit">タグネーム</label>
                            <input type="text" name="tag_name_edit" class="form-control" id="tag_name_edit" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="index_edit">インデックス</label>
                            <input type="text" name="index_edit" class="form-control" id="index_edit" placeholder="" disabled="disabled">
                        </div>
                        <div class="form-group">
                            <label for="weight_edit">重み</label>
                            <input type="text" name="weight_edit" class="form-control" id="weight_edit" placeholder="">
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
                        <h4 class="modal-title" id="myModalLabel_add">新規タグ</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tag_name_add">タグネーム</label>
                            <input type="text" name="tag_name_add" class="form-control" id="tag_name_add" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="index_add">インデックス</label>
                            <input type="text" name="index_add" class="form-control" id="index_add" placeholder="" disabled="disabled">
                        </div>
                        <div class="form-group">
                            <label for="weight_add">重み</label>
                            <input type="text" name="weight_add" class="form-control" id="weight_add" placeholder="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal"><span aria-hidden="true"></span>キャンセル</a>
                        <a id="btn_newSubmit" onclick="btn_newSubmit(this)" class="btn btn-primary" data-dismiss="modal"><span aria-hidden="true"></span>確認</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('tagList-script')
    <script>

        var tableObject_category = $('.dataTables_tag').DataTable({
            responsive: true,
            paging: false,
            searching: false,
            info: false,
            "aaSorting": [[ 2, "asc" ]],//默认第几个排序
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,1,2,3,4]}// 制定列不参与排序
            ]
        });

        //分类选中状态
        $("#admin-tagList").attr("href", "javascript:void(0);");
        $("#admin-tagList").css("color", "#F67777").css("border", "1px solid #F67777").css("background-color", "#fff");


        //取得tag名字的首字母
        $("#tag_name_add").keyup(function(){
            var temp = $("#tag_name_add").val().substring(0, 1);
            if(temp >= 'A' && temp <= 'z') {
                var index = $("#tag_name_add").val().substring(0, 1).toUpperCase();
            }else {
                index = '~';
            }
            $("#index_add").val(index);
        });
        $("#tag_name_edit").keyup(function(){
            var temp = $("#tag_name_edit").val().substring(0, 1);
            if(temp >= 'A' && temp <= 'z') {
                var index = $("#tag_name_edit").val().substring(0, 1).toUpperCase();
            }else {
                index = '~';
            }
            $("#index_edit").val(index);
        });


        ////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////pagination///////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////

        //my_pager
        $(document).ready(function() {

            //自定义PageSize
            var my_page_size = 10;

            //设置初始页面显示
            var init_count = 0;
            $(".tag-data").each(function () {
                if( init_count < my_page_size ) {
                    $(".tag-data").eq(init_count).css('display','');
                    ++ init_count;
                }
            });

            //设置分页信息
            var pageOptions = {
                AllowPaging: false,
                PageIndex: 1,       //设置当前页码
                PageSize: my_page_size,       //设置分页大小
                RecordCount: $("#data_count").val(),  //设置数据总数
                TotalPage: Math.ceil($("#data_count").val()/my_page_size),      //设置总页数
                showPageCount: 2,
                onPageClick: function(pageIndex) {

                    //alert(pageIndex);
                    //点击button样式的改变
                    $(".page-element").removeClass("cur");
                    $(".page-element[id='"+ (parseInt(pageIndex) + 1) +"']").addClass("cur");

                    //no_previous_page -1
                    //previous_page -2
                    //no_next_page -3
                    //next_page -4
                    //其它 pageIndex + 1

                    //previous -1
                    //next -2

                    //previous按钮
                    if(parseInt(pageIndex) == -1) {
                        //第一页状态
                        if(parseInt(pageOptions.PageIndex) == 1) {
                            return;
                        }
                        //点击后回到上一页
                        $(".page-element").removeClass("cur");
                        $(".page-element[id='"+ (parseInt(pageOptions.PageIndex) - 1)  +"']").addClass("cur");
                        //点击后修改当前页码为下一页的页码
                        pageOptions.PageIndex -= 1;
                        if(pageOptions.PageIndex == (parseInt(pageOptions.TotalPage) - 1)) {
                            //释放点击
                            $(".next_page").removeClass("no_next_page").attr("disabled",false).css("pointer-events","");
                        }
                        if(pageOptions.PageIndex == 1) {
                            //禁止点击
                            $(".previous_page").addClass("no_previous_page").attr("disabled",true).css("pointer-events","none");
                        }
                        //next按钮
                    }else if(parseInt(pageIndex) == -2) {
                        //最后一页状态
                        if(pageOptions.PageIndex == (pageOptions.TotalPage)) {
                            return;
                        }
                        //点击到下一页
                        $(".page-element").removeClass("cur");
                        $(".page-element[id='"+ (parseInt(pageOptions.PageIndex) + 1)  +"']").addClass("cur");
                        //点击后修改当前页码为下一页的页码
                        pageOptions.PageIndex += 1;
                        if(pageOptions.PageIndex == 2) {
                            //释放点击
                            $(".previous_page").removeClass("no_previous_page").attr("disabled",false).css("pointer-events","");
                        }
                        if(pageOptions.PageIndex == (pageOptions.TotalPage)) {
                            //禁止点击
                            $(".next_page").addClass("no_next_page").attr("disabled",true).css("pointer-events","none");
                        }
                    }else {
                        //其他按钮

                        //一般情况(非首位情况)
                        // $(".page-element").removeClass("cur");
                        // $(".page-element[id='"+ (parseInt(pageIndex) + 1)  +"']").addClass("cur");
                        // //点击后修改当前页码
                        // pageOptions.PageIndex = parseInt(pageIndex) + 1;

                        //首尾情况需要特殊处理
                        //一开始是首页和尾页的情况
                        if(pageOptions.PageIndex == 1) {
                            $(".page-element").removeClass("cur");
                            $(".page-element[id='"+ (parseInt(pageIndex) + 1)  +"']").addClass("cur");
                            //点击后修改当前页码
                            pageOptions.PageIndex = parseInt(pageIndex) + 1;
                            if(pageOptions.PageIndex == pageOptions.TotalPage) {
                                $(".next_page").addClass("no_next_page").attr("disabled",true).css("pointer-events","none");
                            }
                            $(".previous_page").removeClass("no_previous_page").attr("disabled",false).css("pointer-events","");
                        } else if(pageOptions.PageIndex == pageOptions.TotalPage) {
                            $(".page-element").removeClass("cur");
                            $(".page-element[id='"+ (parseInt(pageIndex) + 1)  +"']").addClass("cur");
                            //点击后修改当前页码
                            pageOptions.PageIndex = parseInt(pageIndex) + 1;
                            if(pageOptions.PageIndex == 1) {
                                $(".previous_page").addClass("no_previous_page").attr("disabled",true).css("pointer-events","none");
                            }
                            $(".next_page").removeClass("no_next_page").attr("disabled",false).css("pointer-events","");
                        } else {
                            //一开始非首或尾部
                            $(".page-element").removeClass("cur");
                            $(".page-element[id='"+ (parseInt(pageIndex) + 1)  +"']").addClass("cur");
                            //点击后修改当前页码
                            pageOptions.PageIndex = parseInt(pageIndex) + 1;
                            //非首尾直接跳到首页
                            if(pageOptions.PageIndex == 1) {
                                $(".previous_page").addClass("no_previous_page").attr("disabled",true).css("pointer-events","none");
                            }
                            //非首尾直接跳到尾部
                            if(pageOptions.PageIndex == pageOptions.TotalPage) {
                                $(".next_page").addClass("no_next_page").attr("disabled",true).css("pointer-events","none");
                            }
                        }

                    }

                    //页面元素显示相关
                    var current_page_element = parseInt(pageOptions.PageIndex - 1) * pageOptions.PageSize;
                    $(".tag-data").css('display', 'none');
                    $(".tag-data").each(function () {
                        if( current_page_element <= (pageOptions.PageIndex * pageOptions.PageSize - 1) ) {
                            $(".tag-data").eq(current_page_element).css('display','');
                            ++ current_page_element;
                        }
                    });
                    return false;
                }
            };

            //初始化分页栏
            $('.g-pagerwp .g-pager').css('visibility', 'visible').pageBar(pageOptions);

            //初始化完后才能获取各种class和属性
            if(pageOptions.PageIndex == 1) {
                //禁止点击
                $(".previous_page").attr("disabled",true).css("pointer-events","none");
            }
            if(pageOptions.PageIndex == pageOptions.TotalPage) {
                //禁止点击
                $(".next_page").attr("disabled",true).css("pointer-events","none");
            }
        });

        ////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////pager////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////


        ////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////button////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////

        // 展示新增框(Admin)
        function btn_addNew(obj){
            $('#myModal_add').modal();
        }

        // 新增确认框(Admin)
        function btn_newSubmit(obj){
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "post",
                url: "{{ url('/admin/articles/tag/add') }}",
                data: {
                    'name': $("#tag_name_add").val(),
                    'index': $("#index_add").val(),
                    'weight': $("#weight_add").val(),
                },
                success: function (response) {

                    if (response.status == 10000) {
                        swal("タグ作成", response.msg, "success");
                        //window.location = window.location;

                        var newTag = '<tr class="tag-data">\n' +
                            '<td>\n' +
                            '<div class="checkbox-custom checkbox-default">\n' +
                            '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                            '<label for="table_checkbox"></label>\n' +
                            '</div>\n' +
                            '</td>\n' +
                            '<td class="id">' + response.data.id + '</td>\n' +
                            '<td class="name">' + response.data.name + '</td>\n' +
                            '<td class="index" id="' + response.data.index + '">' + response.data.index + '</td>\n' +
                            '<td class="weight">' + response.data.weight + '</td>\n' +
                            '<td class="table_manage">\n' +
                            '<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '"> 編集</a>\n' +
                            '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
                            '</td>\n' +
                            '</tr>';

                        //$("#tag-items").prepend(newTag);

                        $(".tag-data").each(function(){
                            var out_this = this;
                            if($(out_this).children(".index").text() > response.data.index) {
                                //$(this).before(newTag);
                                //在jquery的each语句中,return false相当于break
                                //return true相当于continue
                                //return false;
                                var flag = false;
                                var temp = $(".tag-data").children("td[id=" + response.data.index + "]");
                                if(temp.length == 0) {
                                    $(out_this).before(newTag);
                                    return false;
                                }else {
                                    temp.each(function () {
                                        var in_this = this;
                                        //alert($(in_this).siblings(".weight").text());
                                        //alert(response.data.weight);
                                        if(parseInt($(in_this).siblings(".weight").text()) <= parseInt(response.data.weight)) {
                                            flag = true;
                                            $(in_this).parent().before(newTag);
                                            return false;
                                        }
                                    });
                                    if(flag == false) {
                                        $(out_this).before(newTag);
                                    }
                                    return false;
                                }
                            }
                        });


                    }else {
                        swal("タグ作成", response.msg, "error");
                    }
                },
                error: function () {
                    swal("タグ作成", "エラが発生しました", "error");
                },
            })
        }

        // 展示编辑框(Admin)
        function btn_edit(obj){
            var obj_admin = $(obj);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"post",
                url: "{{ url('/admin/articles/tag/find') }}",
                data: {'id': obj_admin.attr('id')},
                success: function(response){
                    if(response.status == 10000){
                        $("#myModalLabel_edit").text(" " + response.data[0].name + " の情報修正");
                        $("#tag_name_edit").val(response.data[0].name);
                        $("#index_edit").val(response.data[0].index);
                        $("#weight_edit").val(response.data[0].weight);
                        $("#hidden_id").val(response.data[0].id);
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
                url: "{{ url('/admin/articles/tag/edit') }}",
                data: {
                    'id': $("#hidden_id").val(),
                    'name': $("#tag_name_edit").val(),
                    'index': $("#index_edit").val(),
                    'weight': $("#weight_edit").val(),
                },
                success: function (response) {
                    if (response.status == 10000) {
                        swal("情報修正", response.msg, "success");
                        //window.location = window.location;
                        var newTag = '<tr class="tag-data">\n' +
                            '<td>\n' +
                            '<div class="checkbox-custom checkbox-default">\n' +
                            '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                            '<label for="table_checkbox"></label>\n' +
                            '</div>\n' +
                            '</td>\n' +
                            '<td class="id">' + response.data.id + '</td>\n' +
                            '<td class="name">' + response.data.name + '</td>\n' +
                            '<td class="index" id="' + response.data.index + '">' + response.data.index + '</td>\n' +
                            '<td class="weight">' + response.data.weight + '</td>\n' +
                            '<td class="table_manage">\n' +
                            '<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '"> 編集</a>\n' +
                            '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
                            '</td>\n' +
                            '</tr>';

                        var element = $('input[value=' + response.data.id + '].data_box').parent().parent().parent();
                        //element.after(newTag);

                        $(".tag-data").each(function(){
                            var out_this = this;
                            if($(out_this).children(".index").text() > response.data.index) {
                                //$(this).before(newTag);
                                //在jquery的each语句中,return false相当于break
                                //return true相当于continue
                                //return false;
                                var flag = false;
                                var temp = $(".tag-data").children("td[id=" + response.data.index + "]");
                                if(temp.length == 0) {
                                    $(out_this).before(newTag);
                                    return false;
                                }else {
                                    temp.each(function () {
                                        var in_this = this;
                                        //alert($(in_this).siblings(".weight").text());
                                        //alert(response.data.weight);
                                        if(parseInt($(in_this).siblings(".weight").text()) <= parseInt(response.data.weight)) {
                                            flag = true;
                                            $(in_this).parent().before(newTag);
                                            return false;
                                        }
                                    });
                                    if(flag == false) {
                                        $(out_this).before(newTag);
                                    }
                                    return false;
                                }
                            }
                        });

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
                            url: "{{ url('/admin/articles/tag/delete') }}",
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




