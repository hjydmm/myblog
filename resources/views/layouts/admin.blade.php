<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="カシュンヨウのブログ">
    <meta name="author" content="カシュンヨウ">
    <title>双葉のブログ - @yield('title')</title>
    <!-- 开发阶段不需要页面缓存 -->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">

    <!------------------------------------------------------------------------------------------------------>
    <!----------------------------------------------CSS link------------------------------------------------>
    <!------------------------------------------------------------------------------------------------------>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('/assets/backend/my-framework/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="{{asset('/assets/backend/my-framework/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="{{asset('/assets/backend/my-framework/vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="{{asset('/assets/backend/my-framework/vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
    <!-- my-framework - Custom CSS -->
    <link href="{{asset('/assets/backend/my-framework/dist/css/my-framework.css')}}" rel="stylesheet">
    <!-- font-awesome Fonts -->
    <link href="{{asset('/assets/backend/my-framework/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- toastr CSS -->
    <link href="{{asset('/assets/backend/toastr/build/toastr.css')}}" rel="stylesheet">
    <!-- My CSS -->
    <link href="{{asset('/assets/backend/admin-style.css')}}" rel="stylesheet">

    <style>
        .g-cf:after {clear: both;content: "";display: table;}
        .g-cf {zoom:1;}
        /*分页*/
        .g-pager{ text-align:center; color: #111111; font: 12px/1.5em Arial,Tahoma;  float: right;}
        .g-pager a,.g-pager input{ cursor:pointer; border:solid 1px #0F71BE; padding:1px 4px; color:#0F71BE; margin:0 2px; vertical-align:middle; }
        .g-pager a.cur,.g-pager a:hover{ background-color:#0F71BE; color:#fff}
        .g-pager a.no{ border-color:#A3A3A3; color:#A3A3A3; background-color:#E4F2F9}
        .g-pager span{ margin-right:10px; }
        .g-pager input{ cursor:default; width:28px; padding:1px 2px; }
        .g-pagerwp{ height:23px; line-height:23px;padding:5px; margin-bottom:10px; border: 1px solid #DDDDDD;}
        .g-pagerwp .g-btn{ vertical-align:top}

        .g-pager a.no_previous_page {
            background-color: rgba(100, 100, 100, 0.3);
        }
        .g-pager a.no_next_page {
            background-color: rgba(100, 100, 100, 0.3);
        }
    </style>


</head>

<body style="opacity: 0;background-color: #fff;">

    <!-- Navigation -->
    <nav id="navigationBar" class="navbar-fixed-top" style="background-color: #F67777;">
        <div class="nav-top container-fluid">
            {{--navbar的左边部分--}}
            <div id="left-nav">
                <a class="navbar-brand" href="{{ url("/admin/index") }}" style="color: #fff;padding-left: 0">HJYのブログ ( バックエンド )</a>
            </div>
            {{--navbar的右边部分--}}
            <ul id="right-nav" class="nav navbar-top-links" style="float: right;">
                <li class="dropdown" style="">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        @if (Auth::guard('admin')->user())
                            <span style="color: #fff;">
                                <i class="fa fa-user"></i>&nbsp;&nbsp;
                                {{ Auth::guard('admin')->user()->username}}
                            </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-user" style="background-color: rgba(246, 119, 119, 1);">
                        <li><a href="{{ url("/") }}" target="_blank" style="padding-top: 6px;color: #fff;"><i class="fa fa-home fa-fw"></i> HJYのブログへ</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/admin/logout') }}" style="color: #fff;"><i class="fa fa-sign-out fa-fw"></i> ログアウト</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="nav-bottom container-fluid" style="border-top: 2px solid rgba(255,255,255,1);">
            <a id="admin-home" href="{{ url('/admin/index') }}" class="my_nav_tag">ホームページ</a>
            <a id="admin-adminList" href="{{ url('/admin/admin/index') }}" class="my_nav_tag">管理者</a>
            <a id="admin-blogManage" href="javascript:void(0);" class="my_nav_tag blog-btn">ブログ管理</a>
            <span id="blog-content" style="display:inline;" class="display-off">
                <a id="admin-userList" href="{{ url('/admin/users/index') }}" class="my_nav_tag_sm">ユーザーリスト</a>
                <a id="admin-articleList" href="{{ url('/admin/articles/article/index') }}" class="my_nav_tag_sm">記事リスト</a>
                <a id="admin-categoryList" href="{{ url('/admin/articles/category/index') }}" class="my_nav_tag_sm">カテゴリー</a>
                <a id="admin-tagList" href="{{ url('/admin/articles/tag/index') }}" class="my_nav_tag_sm">タグ</a>
                <a id="admin-linkList" href="{{ url('/admin/links/index') }}" class="my_nav_tag_sm">リンク編集</a>
            </span>


        </div>

    </nav>

    <div id="hiddenForSpace" style="min-height: 120px;visibility: hidden"></div>

    <div id="mainContent" style="margin-left: 15px;margin-right: 15px;">
        @yield('content')
    </div>

</body>

<!------------------------------------------------------------------------------------------------------>
<!----------------------------------------------JS script----------------------------------------------->
<!------------------------------------------------------------------------------------------------------>
<!-- jQuery -->
<script type="text/javascript" src="{{ asset('/assets/backend/my-framework/vendor/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script type="text/javascript" src="{{ asset('/assets/backend/my-framework/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Metis Menu Plugin JavaScript -->
<script type="text/javascript" src="{{ asset('/assets/backend/my-framework/vendor/metisMenu/metisMenu.min.js')}}"></script>
<!-- DataTables JavaScript -->
<script type="text/javascript" src="{{ asset('/assets/backend/my-framework/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/assets/backend/my-framework/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('/assets/backend/my-framework/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
<!-- DataTable fnReloadAjax -->
<script type="text/javascript" src="{{ asset('/assets/backend/fnReloadAjax.js')}}"></script>
<!-- Custom my-framework -->
<script type="text/javascript" src="{{ asset('/assets/backend/my-framework/dist/js/my-framework.js')}}"></script>
<!-- sweetalert -->
<script type="text/javascript" src="{{ asset('/assets/backend/sweetalert/dist/sweetalert.min.js')}}"></script>
<!-- toastr -->
<script type="text/javascript" src="{{ asset('/assets/backend/toastr/build/toastr.min.js')}}"></script>
<!-- admin-style -->
<script type="text/javascript" src="{{ asset('/assets/backend/toastr/build/toastr.min.js')}}"></script>
<!-- my pagination -->
<script type="text/javascript" src="{{ asset('/assets/common/pagination/my_pager.js')}}" ></script>

<script>

////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////common_part////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

    // 展示table
    $(document).ready(function() {
        // var tableObject = $('.dataTables').DataTable({
        //     responsive: true,
        //     paging: false,
        //     searching: false,
        //     info: false
        //     // "aaSorting": [[ 1, "asc" ]],//默认第几个排序
        //     // "aoColumnDefs": [
        //     //     //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
        //     //     {"orderable":false,"aTargets":[0,3,4,7]}// 制定列不参与排序
        //     // ]
        // });
        $('body').css('opacity',1);
    });

    //blog管理下拉菜单的打开和关闭
    var display = true;
    $('.blog-btn').click(function(){
        if(!display) {
            $('#blog-content').css('display',"inline");
            display = true;
        }else {
            $('#blog-content').css('display',"none");
            display = false;
        }

    });

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////tablePage/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

    //tablePage
    var table_current_page = 1,  //当前页
        current_first_item = 0,  //当前页码的第一个条目的索引
        table_page_size = 10, //自定义分页大小----------1
        table_page_number = 1;  //分页数量
    var table_totalPage = $("#table-items tr").length; //为了实时计算页数-----------2
    var table_prev_btn = $("#table_prev");
    var table_next_btn = $("#table_next");

    //初始化页面,根据自定义分页大小显示数据
    $(".table-data").each(function () {
        if(current_first_item < table_page_size){
            //$(".table-data").eq(current_first_item).css('display','');
            $(".table-data").eq(current_first_item).fadeIn(500);
            ++current_first_item;
        }
    });
    //为了美观
    //如果一开始条目数量少于table_page_size的话,改变min-height而让表格显示更好看
    if(table_totalPage < table_page_size) {
        var table_original_height = $(".panel-body").css("min-height").slice(0, -2);
        var table_modify_height = table_original_height * table_totalPage/table_page_size;
        $("#table-items").css("min-height", table_modify_height + "px");
    }
    //一开始数量少于page_size时next_btn要disabled
    if(table_totalPage <= table_page_size){
        table_next_btn.attr("disabled",true);
    }

    //定义按钮next方法
    function table_next_page(obj) {
        table_totalPage = $("#table-items tr").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
        var click_item = $(obj);
        table_prev_btn.attr("disabled",false); //点击下一页后释放prev按钮
        $(".table-data").css('display','none'); //要重新展示分页data,所以要先全部设置为none
        //计算分页数量
        table_page_number = Math.ceil(table_totalPage/table_page_size);

        //点击后当前页码+1
        table_current_page += 1;
        //定位到新的当前页码的第一个条目的索引
        current_first_item = (parseInt(table_current_page) - 1) * table_page_size;

        $(".table-data").each(function () {

            //展示这一页的条目
            if(current_first_item <= (parseInt(table_current_page) * table_page_size - 1)) {
                //$(".table-data").eq(current_first_item).css('display','');
                $(".table-data").eq(current_first_item).fadeIn(500);
                ++current_first_item;
            }
        });
        //如果这一页是最后一页
        if(table_current_page == table_page_number) {
            //则禁止next按钮
            click_item.attr("disabled",true);
        }

    }

    function table_previous_page(obj) {
        table_totalPage = $("#table-items tr").length;  //由于增删改查数据条目数随时都会改变,所以每次点击按钮时都要重新获取一次
        var click_item = $(obj);
        table_next_btn.attr("disabled", false);  //点击上一页后释放next按钮
        $(".table-data").css('display', 'none');  //要重新展示分页data,所以要先全部设置为none
        //计算分页数量
        table_page_number = Math.ceil(table_totalPage / table_page_size);

        //点击后当前页码-1
        table_current_page -= 1;
        //定位到新的当前页码的第一个条目的索引
        current_first_item = (parseInt(table_current_page) - 1) * table_page_size;

        $(".table-data").each(function () {

            //展示这一页的条目
            if (current_first_item <= (parseInt(table_current_page) * table_page_size - 1)) {
                //$(".table-data").eq(current_first_item).css('display', '');
                $(".table-data").eq(current_first_item).fadeIn(500);
                ++current_first_item;
            }
        });
        //如果点击前的一页是最后一页
        if (table_current_page == (table_page_number - 1)) {
            //则释放next按钮
            table_next_btn.attr("disabled", false);
        }

        //如果这一页是第一页
        if (table_current_page == 1) {
            //则禁止prev按钮
            click_item.attr("disabled", true);
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////refresh//////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

    function js_refresh() {
        //页面刷新
        $(".table-data").css("display", "none");
        current_first_item = (parseInt(table_current_page) - 1) * table_page_size;
        $(".table-data").each(function () {
            //展示这一页的条目
            if (current_first_item <= (parseInt(table_current_page) * table_page_size - 1)) {
                $(".table-data").eq(current_first_item).fadeIn(500);
                ++current_first_item;
            }
        });
        if($("#table-items tr").length == (parseInt(table_current_page) - 1) * table_page_size) {
            $("#table_prev").trigger("click");
        }
        //刷新完按钮状态重置
        table_totalPage = $("#table-items tr").length;
        table_page_number = Math.ceil(table_totalPage/table_page_size);

        if(table_current_page == 1 && table_page_number > 1) {
            table_prev_btn.attr("disabled", true);
            table_next_btn.attr("disabled", false);
        }
        if(table_current_page == table_page_number && table_page_number > 1) {
            table_prev_btn.attr("disabled", false);
            table_next_btn.attr("disabled", true);
        }
        if(table_current_page != 1 && table_current_page != table_page_number) {
            table_prev_btn.attr("disabled", false);
            table_next_btn.attr("disabled", false);
        }
        if(table_page_number == 1) {
            //各种操作完后只有一页的话
            $(".table-data").css("display", "");
            table_prev_btn.attr("disabled", true);
            table_next_btn.attr("disabled", true);
        }
    }


////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////userList/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////









////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////articleList/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////



</script>

@yield('adminList-script')
@yield('userList-script')
@yield('articleList-script')
@yield('categoryList-script')
@yield('tagList-script')
@yield('linkList-script')

</html>