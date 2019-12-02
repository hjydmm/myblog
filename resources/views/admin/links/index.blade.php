@extends('layouts.admin')
@section('title','リンク')
@section('content')

	<!-- /.row -->
	<div class="row">

		<!-- /.col-lg-12 -->
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a href="javascript:location.replace(location.href);" class="btn btn-primary btn-list btn-nav"><i class="fa fa-refresh"></i> リフレッシュ</a>
					<a class="btn btn-success btn_addNew btn-list btn-nav" onclick="btn_addNew(this)" ><i class="fa fa-plus"></i> 新規リンク</a>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" style="min-height: 640px;">
					<table width="100%" class="table table-striped table-bordered table-hover dataTables_link" id="dataTables-example">
						<thead>
						<tr>
							{{--<th>全て選択</th>--}}
							<th>ID</th>
							<th>タイトル</th>
							<th>URL</th>
							<th>表示</th>
							<th>重み</th>
							<th>その他</th>
						</tr>
						</thead>
						<tbody id="table-items" class="linkBody">
						@foreach($data as $val)
							<tr class="table-data" style="display:none;">
								{{--<td>--}}
									{{--<div class="checkbox-custom checkbox-default">--}}
										{{--<input type="checkbox" value="{{$val -> id}}" name="checkbox[]" class="data_box" id="table_checkbox">--}}
										{{--<label for="table_checkbox"></label>--}}
									{{--</div>--}}
								{{--</td>--}}
								<td class="id" id="{{$val -> id}}">{{$val -> id}}</td>
								<td class="title">{{$val -> title}}</td>
								<td class="url">{{$val -> url}}</td>
								<td class="show">
									@if($val -> show == '1')
										<span>YES</span>
									@else
										<span>NO</span>
									@endif
								</td>
								<td class="weight">{{$val -> weight}}</td>
								<td class="table_manage">
									<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="{{$val -> id}}"> 編集</a>
									<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="{{$val -> id}}">削除</a>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
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
							<label for="link_title_edit">タイトル</label>
							<input type="text" name="link_title_edit" class="form-control" id="link_title_edit" placeholder="">
						</div>
						<div class="form-group">
							<label for="URL_edit">URL</label>
							<input type="text" name="URL_edit" class="form-control" id="URL_edit" placeholder="">
						</div>
						<div class="form-group">
							<label for="show_edit">表示</label>
							<div>
								<input name="show_edit" class="show_edit" type="radio" id="show_edit" value="1" checked>
								<label for="show_edit"> YES </label>
								<input name="show_edit" class="show_edit" type="radio" id="show_edit" value="2">
								<label for="show_edit"> NO </label>
							</div>
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
						<h4 class="modal-title" id="myModalLabel_add">新規リンク</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="link_title_add">タイトル</label>
							<input type="text" name="link_title_add" class="form-control" id="link_title_add" placeholder="">
						</div>
						<div class="form-group">
							<label for="URL_add">URL</label>
							<input type="text" name="URL_add" class="form-control" id="URL_add" placeholder="">
						</div>
						<div class="form-group">
							<label for="show_add">表示</label>
							<div>
								<input name="show_add" class="show_add" type="radio" id="show_add" value="1" checked>
								<label for="show_add"> YES </label>
								<input name="show_add" class="show_add" type="radio" id="show_add" value="2">
								<label for="show_add"> NO </label>
							</div>
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

		var tableObject_link = $('.dataTables_link').DataTable({
			responsive: true,
			paging: false,
			searching: false,
			info: false,
			"aaSorting": [[ 4, "desc" ]],//默认第几个排序
			"aoColumnDefs": [
				//{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
				{"orderable":false,"aTargets":[0,1,2,3,4,5]}// 制定列不参与排序
			]
		});

		//分类选中状态
		$("#admin-linkList").attr("href", "javascript:void(0);");
		$("#admin-linkList").css("color", "#F67777").css("border", "1px solid #F67777").css("background-color", "#fff");


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
				url: "{{ url('/admin/links/add') }}",
				data: {
					'title': $("#link_title_add").val(),
					'url': $("#URL_add").val(),
					'show': $('input[name="show_add"]:checked').val(),
					'weight': $("#weight_add").val(),
				},
				success: function (response) {

					if (response.status == 10000) {
						swal("リンク作成", response.msg, "success");
						//window.location = window.location;

						var newList = '<tr class="table-data">\n' +
								// '<td>\n' +
								// '<div class="checkbox-custom checkbox-default">\n' +
								// '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
								// '<label for="table_checkbox"></label>\n' +
								// '</div>\n' +
								// '</td>\n' +
								'<td class="id" id="' + response.data.id + '">' + response.data.id + '</td>\n' +
								'<td class="title">' + response.data.title + '</td>\n' +
								'<td class="url">' + response.data.url + '</td>\n' +
								'<td class="show">\n';

						if(response.data.show == '1') {
							var newList2 = '<span>YES</span>\n';
						}else {
							newList2 = '<span>NO</span>\n';
						}

						var newList3 = '</td>\n' +
								'<td class="weight">' + response.data.weight + '</td>\n' +
								'<td class="table_manage">\n' +
								'<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '"> 編集</a>\n' +
								'<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
								'</td>\n' +
								'</tr>';

						newList = newList + newList2 + newList3;

						var flag = false;
						$(".table-data").each(function(){
							if(parseInt($(this).children(".weight").text()) < parseInt(response.data.weight)) {
								$(this).before(newList);
								flag = true;
								return false;
							}
						});
						if(flag == false) {
							$(".table-data").last().after(newList);
						}
						//页面刷新
						js_refresh();

					}else {
						swal("リンク作成", response.msg, "error");
					}
				},
				error: function () {
					swal("リンク作成", "エラが発生しました", "error");
				},
			})
		}

		// 展示编辑框(Admin)
		function btn_edit(obj){
			var obj_admin = $(obj);
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:"post",
				url: "{{ url('/admin/links/find') }}",
				data: {'id': obj_admin.attr('id')},
				success: function(response){
					if(response.status == 10000){
						$("#myModalLabel_edit").text(" " + response.data[0].title + " の情報修正");
						$("#link_title_edit").val(response.data[0].title);
						$("#URL_edit").val(response.data[0].url);
						$('.show_edit[value=' + response.data[0].show + ']').prop("checked", true);
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
				url: "{{ url('/admin/links/edit') }}",
				data: {
					'id': $("#hidden_id").val(),
					'title': $("#link_title_edit").val(),
					'url': $("#URL_edit").val(),
					'show': $('input[name="show_edit"]:checked').val(),
					'weight': $("#weight_edit").val(),
				},
				success: function (response) {
					if (response.status == 10000) {
						swal("情報修正", response.msg, "success");
						//window.location = window.location;

						var newList = '<tr class="table-data">\n' +
								// '<td>\n' +
								// '<div class="checkbox-custom checkbox-default">\n' +
								// '<input type="checkbox" value="' + response.data.id + '" name="checkbox[]" class="data_box" id="table_checkbox">\n' +
								// '<label for="table_checkbox"></label>\n' +
								// '</div>\n' +
								// '</td>\n' +
								'<td class="id" id="' + response.data.id + '">' + response.data.id + '</td>\n' +
								'<td class="title">' + response.data.title + '</td>\n' +
								'<td class="url">' + response.data.url + '</td>\n' +
								'<td class="show">\n';

						if(response.data.show == '1') {
							var newList2 = '<span>YES</span>\n';
						}else {
							newList2 = '<span>NO</span>\n';
						}

						var newList3 = '</td>\n' +
								'<td class="weight">' + response.data.weight + '</td>\n' +
								'<td class="table_manage">\n' +
								'<a class="btn btn-warning btn_edit btn-list" onclick="btn_edit(this)" id="' + response.data.id + '"> 編集</a>\n' +
								'<a class="btn btn-danger btn_delete btn-list" onclick="btn_delete(this)" id="' + response.data.id + '">削除</a>\n' +
								'</td>\n' +
								'</tr>';

						newList = newList + newList2 + newList3;

						var element = $('td[id=' + response.data.id + ']').parent();
						element.remove();

						var flag = false;
						$(".table-data").each(function(){
							if(parseInt($(this).children(".weight").text()) < parseInt(response.data.weight)) {
								$(this).before(newList);
								flag = true;
								return false;
							}
						});
						if(flag == false) {
							$(".table-data").last().after(newList);
						}
						//页面刷新
						js_refresh();

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
								url: "{{ url('/admin/links/delete') }}",
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
										//页面刷新
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

	</script>
@endsection



