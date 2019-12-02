@extends('layouts.admin')
@section('title','文章列表')
@section('menu1', 'BLOG管理')
@section('menu2', '文章管理')
@section('menu3', '文章列表')
@section('content')

    <!-- /.row -->
    <div class="row">

        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #fff;">
                    <a href="javascript:location.replace(location.href);" class="btn btn-primary btn-list btn-nav"><i class="fa fa-refresh"></i> リフレッシュ</a>
                    <a class="btn btn-success btn_addNew btn-list btn-nav" onclick="btn_addNew(this)" ><i class="fa fa-plus"></i> 新規カテゴリー</a>
                    {{--<a class="btn btn-info btn_batchEdit btn-list btn-nav" onclick="btn_batchEdit(this)" ><i class="fa fa-pencil"></i> まとめの修正</a>--}}
                    {{--<a class="btn btn-danger btn_batchDelete btn-list btn-nav" onclick="btn_batchDelete(this)" ><i class="fa fa-times"></i> まとめの削除</a>--}}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style="min-height: 640px;">
                    <table width="100%" class="table table-striped table-bordered table-hover dataTables_category" id="dataTables-example">
                        <thead>
                        <tr>
                            {{--<th>全て選択</th>--}}
                            <th>ID</th>
                            <th>親ID</th>
                            <th>親の親ID</th>
                            <th>カテゴリーネーム</th>
                            <th>レベル</th>
                            <th>重み</th>
                            <th>カラー</th>
                            <th>その他</th>
                        </tr>
                        </thead>
                        <tbody id="category-items" class="categoryBody">
                        @foreach ($data as $val)
                            @if($val['level'] == 0)
                            <tr class="danger category-data" style="display:none;">
                            {{--@elseif($val['level'] == 1)--}}
                            {{--<tr class="info">--}}
                            {{--@elseif($val['level'] == 2)--}}
                            {{--<tr class="warning">--}}
                            @else
                            <tr class="category-data" style="display:none;">
                            @endif
                                {{--<td>--}}
                                    {{--<div class="checkbox-custom checkbox-default">--}}
                                        {{--<input type="checkbox" value="{{$val['id']}}" name="checkbox[]" class="data_box" id="table_checkbox">--}}
                                        {{--<label for="table_checkbox"></label>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                <td id="id{{$val['id']}}" class="id">{{$val['id']}}</td>
                                <td id="fid{{$val['fid']}}">{{$val['fid']}}</td>
                                <td id="ffid{{$val['ffid']}}">{{$val['ffid']}}</td>
                                <td>
                                    @if($val['level'])|
                                    @endif
                                    {{str_repeat('———', $val['level'])}} {{$val['name']}}
                                </td>
                                <td>
                                    @if($val['level'] == 0)
                                    <i class="fa fa-star"></i>
                                    @elseif($val['level'] == 1)
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    @elseif($val['level'] == 2)
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    @endif
                                </td>
                                <td class="weight">{{$val['weight']}}</td>
                                <td><div id="{{$val['code']}}" style="height: 20px;width: 20px;background-color: {{$val['color_code']}}"></div></td>
                                <td>
                                    <a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="{{$val['id']}}">編集</a>
                                    <a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="{{$val['id']}}">削除</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.panel-body -->
                <ul class="pager">
                    <li><button id="category_prev" onclick="category_previous_page(this)" disabled="disabled">前のページ</button></li>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li><button id="category_next" onclick="category_next_page(this)">次のページ</button></li>
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
                        <h4 class="modal-title" id="myModalLabel_edit">カテゴリー編集</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_name_edit">カテゴリーネーム</label>
                            <input type="text" name="category_name_edit" class="form-control" id="category_name_edit" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="weight_edit">重み</label>
                            <input type="text" name="weight_edit" class="form-control" id="weight_edit" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="category_selected_edit">カテゴリーを選んでください</label>
                            <div>
                                <span style="min-width: 160px;display: inline-block;">
                                    <select class="form-control select" size="10" name="ffid">
                                        {{--<option value="0" selected="selected">レベル1</option>--}}
                                        @foreach ($data as $val)
                                            @if($val['level'] == 0)
                                                <option class="ff-category" id="{{$val['code']}}" value="{{$val['id']}}">{{$val['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </span>
                                <span style="min-width: 240px;display: inline-block;">
                                    <select class="form-control select" size="10" name="fid">
                                        <option class="f-category" value="0">選ばない</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color_edit">カラー</label>
                            <div>
                                @foreach ($data as $val)
                                    @if($val['level'] == 0)
                                        <div class="select-color" id="{{$val['code']}}" style="display: inline-block;height: 20px;width: 20px;background-color: {{$val['color_code']}};opacity: 0.3;"></div>
                                    @endif
                                @endforeach
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
                        <h4 class="modal-title" id="myModalLabel_add">新規カテゴリー</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_name_add">カテゴリーネーム</label>
                            <input type="text" name="category_name_add" class="form-control" id="category_name_add" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="weight_add">重み</label>
                            <input type="text" name="weight_add" class="form-control" id="weight_add" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="category_selected_add">カテゴリーを選んでください</label>
                            <div>
                                <span style="min-width: 160px;display: inline-block;">
                                    <select class="form-control select" size="10" name="ffid">
                                        {{--<option value="0" selected="selected">レベル1</option>--}}
                                        @foreach ($data as $val)
                                        @if($val['level'] == 0)
                                        <option class="ff-category" id="{{$val['code']}}" value="{{$val['id']}}">{{$val['name']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </span>
                                <span style="min-width: 240px;display: inline-block;">
                                    <select class="form-control select" size="10" name="fid">
                                        <option class="f-category" value="0">選ばない</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color_add">カラー</label>
                            <div>
                                @foreach ($data as $val)
                                @if($val['level'] == 0)
                                <div class="select-color" id="{{$val['code']}}" style="display: inline-block;height: 20px;width: 20px;background-color: {{$val['color_code']}};opacity: 0.3;"></div>
                                @endif
                                @endforeach
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


    </div>

@endsection

@section('categoryList-script')
    <script>

        var tableObject_category = $('.dataTables_category').DataTable({
            responsive: true,
            paging: false,
            searching: false,
            info: false,
            "aaSorting": [[ 7, "asc" ]],//默认第几个排序
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,1,2,3,4,5,6,7]}// 制定列不参与排序
            ]
        });

        //分类选中状态
        $("#admin-categoryList").attr("href", "javascript:void(0);");
        $("#admin-categoryList").css("color", "#F67777").css("border", "1px solid #F67777").css("background-color", "#fff");


        $('select[name=ffid]').change(function(){

            //获取选中父父分类id
            //var up_id = $(this).val();
            var up_id = $(".ff-category:selected").val();
            //修改颜色透明度
            $('.select-color').css("opacity", "0.3");
            $('div[id=' + up_id + '].select-color').css("opacity", "1");
            $.ajax({
                type:"get",
                url: "{{ url('/admin/articles/category/getOptionById') }}",
                data: {'id': up_id},
                success: function(response){
                    if(response.status == 10000){
                        //回调函数，查询数据库后拿到data数据，以下是拿到的data数据的处理
                        //jQuery循环操作
                        var str = '';
                        $.each(response.data,function(index,el){
                            str += "<option class='f-category' value='" + el.id + "'>" + el.name + "</option>";
                            //清空之前的二级的数据,但要保留默认的value=0的元素
                            $('select[name=fid]').find('option:gt(0)').remove();
                            //将数据添加到对应option后面
                            $('select[name=fid]').append(str);
                        })
                    }else {
                        swal("sorry", "エラが発生しました", "error");
                    }
                },
                error: function() {
                    swal("sorry", "エラが発生しました", "error");
                },
            });
        });


        function showOptions(temp) {
            var up_id = $(".ff-category:selected").val();
            //修改颜色透明度
            $('.select-color').css("opacity", "0.3");
            $('div[id=' + up_id + '].select-color').css("opacity", "1");
            $.ajax({
                type:"get",
                url: "{{ url('/admin/articles/category/getOptionById') }}",
                data: {'id': up_id},
                success: function(response){
                    if(response.status == 10000){
                        //回调函数，查询数据库后拿到data数据，以下是拿到的data数据的处理
                        //jQuery循环操作
                        var str = '';
                        $.each(response.data,function(index,el){
                            str += "<option class='f-category' value='" + el.id + "'>" + el.name + "</option>";
                            //清空之前的二级的数据,但要保留默认的value=0的元素
                            $('select[name=fid]').find('option:gt(0)').remove();
                            //将数据添加到对应option后面
                            $('select[name=fid]').append(str);
                            $("option[value=" + temp + "].f-category").prop("selected", true);
                        })
                    }else {
                        swal("sorry", "エラが発生しました", "error");
                    }
                },
                error: function() {
                    swal("sorry", "エラが発生しました", "error");
                },
            });
        }


        ////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////categoryPage//////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////

        //categoryPage
        var category_current_page = 1,  //当前页
            current_first_item = 0,  //当前页码的第一个条目的索引
            category_page_size = 10, //自定义分页大小----------1
            category_page_number = 1;  //分页数量
        var category_totalPage = $("#category-items tr").length; //为了实时计算页数-----------2
        var category_prev_btn = $("#category_prev");
        var category_next_btn = $("#category_next");

        //初始化页面,根据自定义分页大小显示数据
        $(".category-data").each(function () {
            if(current_first_item < category_page_size){
                //$(".category-data").eq(current_first_item).css('display','');
                $(".category-data").eq(current_first_item).fadeIn(500);
                ++current_first_item;
            }
        });
        //为了美观
        //如果一开始条目数量少于category_page_size的话,改变min-height而让表格显示更好看
        if(category_totalPage < category_page_size) {
            var category_original_height = $(".panel-body").css("min-height").slice(0, -2);
            var category_modify_height = category_original_height * category_totalPage/category_page_size;
            $("#category-items").css("min-height", category_modify_height + "px");
        }
        //一开始数量少于page_size时next_btn要disabled
        if(category_totalPage <= category_page_size){
            category_next_btn.attr("disabled",true);
        }

        //定义按钮next方法
        function category_next_page(obj) {
            category_totalPage = $("#category-items tr").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
            var click_item = $(obj);
            category_prev_btn.attr("disabled",false); //点击下一页后释放prev按钮
            $(".category-data").css('display','none'); //要重新展示分页data,所以要先全部设置为none
            //计算分页数量
            category_page_number = Math.ceil(category_totalPage/category_page_size);

            //点击后当前页码+1
            category_current_page += 1;
            //定位到新的当前页码的第一个条目的索引
            current_first_item = (parseInt(category_current_page) - 1) * category_page_size;

            $(".category-data").each(function () {

                //展示这一页的条目
                if(current_first_item <= (parseInt(category_current_page) * category_page_size - 1)) {
                    //$(".category-data").eq(current_first_item).css('display','');
                    $(".category-data").eq(current_first_item).fadeIn(500);
                    ++current_first_item;
                }
            });
            //如果这一页是最后一页
            if(category_current_page == category_page_number) {
                //则禁止next按钮
                click_item.attr("disabled",true);
            }

        }

        function category_previous_page(obj) {
            category_totalPage = $("#category-items tr").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
            var click_item = $(obj);
            category_next_btn.attr("disabled", false);  //点击上一页后释放next按钮
            $(".category-data").css('display', 'none');  //要重新展示分页data,所以要先全部设置为none
            //计算分页数量
            category_page_number = Math.ceil(category_totalPage / category_page_size);

            //点击后当前页码-1
            category_current_page -= 1;
            //定位到新的当前页码的第一个条目的索引
            current_first_item = (parseInt(category_current_page) - 1) * category_page_size;

            $(".category-data").each(function () {

                //展示这一页的条目
                if (current_first_item <= (parseInt(category_current_page) * category_page_size - 1)) {
                    //$(".category-data").eq(current_first_item).css('display', '');
                    $(".category-data").eq(current_first_item).fadeIn(500);
                    ++current_first_item;
                }
            });
            //如果点击前的一页是最后一页
            if (category_current_page == (category_page_number - 1)) {
                //则释放next按钮
                category_next_btn.attr("disabled", false);
            }

            //如果这一页是第一页
            if (category_current_page == 1) {
                //则禁止prev按钮
                click_item.attr("disabled", true);
            }
        }

        ////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////refresh//////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////

        function js_refresh_forCategory() {
            //页面刷新
            $(".category-data").css("display", "none");
            current_first_item = (parseInt(category_current_page) - 1) * category_page_size;
            $(".category-data").each(function () {
                //展示这一页的条目
                if (current_first_item <= (parseInt(category_current_page) * category_page_size - 1)) {
                    $(".category-data").eq(current_first_item).fadeIn(500);
                    ++current_first_item;
                }
            });
            if($("#category-items tr").length == (parseInt(category_current_page) - 1) * category_page_size) {
                $("#category_prev").trigger("click");
            }
            //刷新完按钮状态重置
            category_totalPage = $("#category-items tr").length;
            category_page_number = Math.ceil(category_totalPage/category_page_size);

            if(category_current_page == 1 && category_page_number > 1) {
                category_prev_btn.attr("disabled", true);
                category_next_btn.attr("disabled", false);
            }
            if(category_current_page == category_page_number && category_page_number > 1) {
                category_prev_btn.attr("disabled", false);
                category_next_btn.attr("disabled", true);
            }
            if(category_current_page != 1 && category_current_page != category_page_number) {
                category_prev_btn.attr("disabled", false);
                category_next_btn.attr("disabled", false);
            }
            if(category_page_number == 1) {
                //各种操作完后只有一页的话
                $(".category-data").css("display", "");
                category_prev_btn.attr("disabled", true);
                category_next_btn.attr("disabled", true);
            }
        }

        ////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////modal////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////


        // 展示新增框(Admin)
        function btn_addNew(obj){
            $('#myModal_add').modal();
        }

        // 新增确认框(Admin)
        function btn_newSubmit(obj){

            if($(".ff-category:selected").length == 0 || !$("#category_name_add").val() || !$("#weight_add").val()) {
                swal("新規カテゴリー", "全ての項目を入力してください", "error");
                return;
            }
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "post",
                url: "{{ url('/admin/articles/category/add') }}",
                data: {
                    'name': $("#category_name_add").val(),
                    'weight': $("#weight_add").val(),
                    'ffid': ($(".f-category:selected").length == 0 || $(".f-category:selected").val() == 0) ? 0 : $(".ff-category:selected").val(),
                    'fid': ($(".f-category:selected").length == 0 || $(".f-category:selected").val() == 0) ? $(".ff-category:selected").val() : $(".f-category:selected").val(),
                    'code': $(".ff-category:selected").attr("id"),
                    'color_code': $('div[id=' + $(".ff-category:selected").val() + '].select-color').css("background-color"),
                },
                success: function (response) {

                    if (response.status == 10000) {
                        swal("カテゴリー作成", response.msg, "success");
                        //window.location = window.location;

                        var newList = '<tr class="category-data">\n' +
                            // '<td>\n' +
                            // '<div class="checkbox-custom checkbox-default">\n' +
                            // '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                            // '<label for="table_checkbox"></label>\n' +
                            // '</div>\n' +
                            '</td>\n' +
                            '<td id="id' + response.data.id + '" class="id">' + response.data.id + '</td>\n' +
                            '<td id="fid' + response.data.fid + '">' + response.data.fid + '</td>\n' +
                            '<td id="ffid' + response.data.ffid + '">' + response.data.ffid + '</td>\n';

                        if(response.data.ffid == 0) {
                            var newList2 = '<td>' + '| ——— ' + response.data.name + '</td>\n' +
                                '<td>' + '<i class="fa fa-star"></i>' + '<i class="fa fa-star"></i>' + '</td>\n';
                        }else {
                            newList2 = '<td>' + '| —————— ' + response.data.name + '</td>\n' +
                                '<td>' + '<i class="fa fa-star"></i>' + '<i class="fa fa-star"></i>' + '<i class="fa fa-star"></i>' + '</td>\n';
                        }

                        var newList3 = '<td class="weight">' + response.data.weight + '</td>\n' +
                            '<td>' + '<div id="' + response.data.code + '" style="height: 20px;width: 20px;background-color: ' + response.data.color_code + '"></div>' + '</td>\n' +
                            '<td>\n' +
                            '<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '">編集</a>\n' +
                            '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
                            '</td>\n' +
                            '</tr>';

                        newList = newList + newList2 + newList3;

                        var flag = false;
                        var temp = $(".category-data").children("td[id=" + "fid" + response.data.fid + "]");
                        if(temp.length == 0) {
                            $(".category-data").children("td[id=" + "id" + response.data.fid + "]").parent().after(newList);
                        }else {
                            temp.each(function () {
                                var in_this = this;
                                //alert($(in_this).siblings(".weight").text());
                                //alert(response.data.weight);
                                if(parseInt($(in_this).siblings(".weight").text()) <= parseInt(response.data.weight)) {
                                    flag = true;
                                    $(in_this).parent().before(newList);
                                    return false;
                                }
                            });
                            if(flag == false) {
                                temp.parent().last().after(newList);
                            }
                        }

                        js_refresh_forCategory();

                        //清空填写的内容
                        $("#category_name_add").val("");
                        $("#weight_add").val("");
                        $(".f-category").prop("selected", false);
                        $(".ff-category").prop("selected", false);

                        // 'name': $("#category_name_add").val(),
                        //     'weight': $("#weight_add").val(),
                        //     'ffid': ($(".f-category:selected").length == 0 || $(".f-category:selected").val() == 0) ? 0 : $(".ff-category:selected").val(),
                        //     'fid': ($(".f-category:selected").length == 0 || $(".f-category:selected").val() == 0) ? $(".ff-category:selected").val() : $(".f-category:selected").val(),
                        //     'code': $(".ff-category:selected").attr("id"),
                        //     'color_code': $('div[id=' + $(".ff-category:selected").val() + '].select-color').css("background-color"),


                    }else {
                        swal("カテゴリー作成", response.msg, "error");
                    }
                },
                error: function () {
                    swal("カテゴリー作成", "エラが発生しました", "error");
                },
            })
        }



        // 展示编辑框(Admin)
        function btn_edit(obj){
            var obj_admin = $(obj);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"post",
                url: "{{ url('/admin/articles/category/find') }}",
                data: {'id': obj_admin.attr('id')},
                success: function(response){
                    if(response.status == 10000){
                        $("#myModalLabel_edit").text(" " + response.data.name + " の情報修正");
                        $("#hidden_id").val(response.data.id);
                        $("#category_name_edit").val(response.data.name);
                        $("#weight_edit").val(response.data.weight);
                        $("option[value=" + response.data.code + "].ff-category").prop("selected", true);
                        if(response.data.ffid == 0) {
                            showOptions(response.data.id);
                        }else {
                            showOptions(response.data.fid);
                        }
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

            if($(".ff-category:selected").length == 0 || !$("#category_name_edit").val() || !$("#weight_edit").val()) {
                swal("新規カテゴリー", "全ての項目を入力してください", "error");
                return;
            }

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "post",
                url: "{{ url('/admin/articles/category/edit') }}",
                data: {
                    'id': $("#hidden_id").val(),
                    'name': $("#category_name_edit").val(),
                    'weight': $("#weight_edit").val(),
                    'ffid': ($(".f-category:selected").length == 0 || $(".f-category:selected").val() == 0) ? 0 : $(".ff-category:selected").val(),
                    'fid': ($(".f-category:selected").length == 0 || $(".f-category:selected").val() == 0) ? $(".ff-category:selected").val() : $(".f-category:selected").val(),
                    'code': $(".ff-category:selected").attr("id"),
                    'color_code': $('div[id=' + $(".ff-category:selected").val() + '].select-color').css("background-color"),
                },
                success: function (response) {

                    if (response.status == 10000) {
                        swal("カテゴリー作成", response.msg, "success");
                        //window.location = window.location;

                        var newList = '<tr class="category-data">\n' +
                            // '<td>\n' +
                            // '<div class="checkbox-custom checkbox-default">\n' +
                            // '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
                            // '<label for="table_checkbox"></label>\n' +
                            // '</div>\n' +
                            '</td>\n' +
                            '<td id="id' + response.data.id + '" class="id">' + response.data.id + '</td>\n' +
                            '<td id="fid' + response.data.fid + '">' + response.data.fid + '</td>\n' +
                            '<td id="ffid' + response.data.ffid + '">' + response.data.ffid + '</td>\n';

                        if(response.data.ffid == 0) {
                            var newList2 = '<td>' + '| ——— ' + response.data.name + '</td>\n' +
                                '<td>' + '<i class="fa fa-star"></i>' + '<i class="fa fa-star"></i>' + '</td>\n';
                        }else {
                            newList2 = '<td>' + '| —————— ' + response.data.name + '</td>\n' +
                                '<td>' + '<i class="fa fa-star"></i>' + '<i class="fa fa-star"></i>' + '<i class="fa fa-star"></i>' + '</td>\n';
                        }

                        var newList3 = '<td class="weight">' + response.data.weight + '</td>\n' +
                            '<td>' + '<div id="' + response.data.code + '" style="height: 20px;width: 20px;background-color: ' + response.data.color_code + '"></div>' + '</td>\n' +
                            '<td>\n' +
                            '<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '">編集</a>\n' +
                            '<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
                            '</td>\n' +
                            '</tr>';

                        newList = newList + newList2 + newList3;

                        var element = $('td[id=' + 'id' + response.data.id + ']').parent();

                        var flag = false;
                        var temp = $(".category-data").children("td[id=" + "fid" + response.data.fid + "]");
                        var last_element_symbol;
                        if(temp.length == 0) {
                            $(".category-data").children("td[id=" + "id" + response.data.fid + "]").parent().after(newList);
                        }else {
                            temp.each(function () {
                                var in_this = this;
                                //alert($(in_this).siblings(".weight").text());
                                //alert(response.data.weight);
                                if(parseInt($(in_this).siblings(".weight").text()) <= parseInt(response.data.weight)) {
                                    flag = true;
                                    $(in_this).parent().before(newList);
                                    last_element_symbol = $(in_this).siblings("td[class='id']").text();
                                    return false;
                                }
                            });
                            //插到同等级元素的最后,但是对于只有二级分类元素来说,还要多做处理,要加到倒数第二个二级分类的三级分类下面
                            if(flag == false) {
                                //获取倒数第二个二级分类的id值
                                last_element_symbol = temp.last().siblings("td[class='id']").text();
                                //alert(last_element_symbol);
                                //temp2是看这个二级分类的三级分类个数有多少个
                                var temp2 = $(".category-data").children("td[id=" + "fid" + last_element_symbol + "]");
                                //该二级分类的三级分类个数为0
                                if(temp2.length == 0) {
                                    temp.parent().last().after(newList);
                                }else {
                                    //不为0
                                    temp2.parent().last().after(newList);
                                }
                            }
                        }

                        element.remove();

                        js_refresh_forCategory();

                        //清空填写的内容
                        $("#category_name_add").val("");
                        $("#weight_add").val("");
                        $(".f-category").prop("selected", false);
                        $(".ff-category").prop("selected", false);


                    }else {
                        swal("カテゴリー作成", response.msg, "error");
                    }
                },
                error: function () {
                    swal("カテゴリー作成", "エラが発生しました", "error");
                },
            })

        }

        // 确认删除提示框(Admin)
        function btn_delete(obj){
            //定义该按钮对象，方便之后使用
            var obj_admin = $(obj);
            if(obj_admin.parent().siblings('td[id="fid0"]').length != 0) {
                swal("情報編集", "トップカテゴリーは削除できません!", "error");
                return;
            }

            var len = $("td[id=" + "fid" + obj_admin.attr('id') + "]").length;
            swal({
                title: "ワーニング",
                text: len == 0 ?
                    "削除しますが?" :
                    "このカテゴリーの子カテゴリーもすべて削除されることになりますが、よろしいでしょうか?",
                icon: "warning",
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
                            url: "{{ url('/admin/articles/category/delete') }}",
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
                                    if(len != 0) {
                                        $("td[id=" + "fid" + obj_admin.attr('id') + "]").parent().remove();
                                    }
                                    //window.location = window.location;
                                    //tableObject_admin.fnReloadAjax;
                                    //tableObject_admin.ajax.reload();
                                    //tableObject_admin.ajax.url( '/admin/admin/index2' ).load();

                                    js_refresh_forCategory();

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

