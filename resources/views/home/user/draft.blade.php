@extends('layouts.main')
@section('title','分享写作')
@section('main')
<link rel="stylesheet" href="{{ asset('/assets/markdown/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('/assets/simplemde/dist/simplemde.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/assets/simplemde/debug/simplemde.css') }}" />
<!-- <link rel="stylesheet" href="{{ asset('/assets/simplemde/src/css/simplemde.css') }}" />   --> 
<!-- <link rel="stylesheet" href="{{ asset('/assets/markdown/css/editormd.css') }}" />  --> 
<script src="{{ asset('/assets/markdown/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/simplemde/dist/simplemde.min.js') }}"></script>
<script src="{{ asset('/assets/simplemde/debug/simplemde.js') }}"></script>
<!-- <script src="{{ asset('/assets/simplemde/src/js/simplemde.js') }}"></script> -->
<!-- <script src="{{ asset('/assets/markdown/js/editormd.js') }}"></script> -->
<div style="width:74%;min-height:500px;background:#fff;margin:10px auto;">
<style>
    .editormd-code-toolbar select {display:inline-block;}
</style>
<div id="layout">
        <form class="layui-form">
          <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
              <input type="text" name="title"  value="{{ $draft->title }}" lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">分类</label>
            <div class="layui-input-block">
              <select name="category" lay-verify="required" id="category">
                <option value="">请选择</option>
                @foreach ($category as $v)
                	@if (!$v->code)
                		<option value="{{ $v->id }}" @if($draft->cid == $v->id ) selected @endif>{{ str_repeat('-', $v->level)}} {{ $v->name }}</option>
                	@endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">简介</label>
                <div class="layui-input-block">
                  <textarea name="intro" lay-verify="required"  placeholder="请文章简介" class="layui-textarea" id="intro">{{ $draft->intro }}</textarea>
                </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">内容</label>
            <div class="layui-input-block" style="width:80%;">
              <textarea id="content" name="content">
                {{ $draft->content }}
              </textarea>
            </div>
          </div>

          <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
              <input type="radio" name="status" id="status" value="1" title="草稿" @if($draft->status ==1) checked @endif>
              <input type="radio" name="status" id="status" value="2" title="审核" @if($draft->status ==2) checked @endif>
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">标签</label>
            <div class="layui-input-block"   style="width:50%;">
                 <input type="text" name="tags" lay-verify="required" value="{{$draft->tags}}" autocomplete="off" class="layui-input">
            </div>
          </div>
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $draft->id }}">
          <div class="layui-form-item">
            <div class="layui-input-block">
              <!-- <button class="layui-btn" lay-submit lay-filter="publish">发布文章</button> -->
              <button type="submit" class="btn btn-primary" onclick="publish();return false;">最终提交</button>
            </div>
          </div>
        </form>          
	</div>
</div>
<script type="text/javascript">
        var simplemde = new SimpleMDE({
            element: document.getElementById("content"),
            // parsingConfig: {
            //     allowAtxHeaderWithoutSpace: true,
            //     strikethrough: false,
            //     underscoresBreakWords: true,
            // },
            // placeholder: "share your thought here...",
            // spellChecker: false, 
            renderingConfig: {
                   codeSyntaxHighlighting: true,
            },
        });
 
        // 预览
        function publish() {
          //这种手动处理数据的方法一定要把参数全部带上
            var data  = {};
            data.tags = $('input[name=tags]').val();
            data.markdown_content = simplemde.markdown(simplemde.value());
            data.content = simplemde.value();
            data.title  = $('input[name=title]').val();
            data._token = "{{ csrf_token() }}";
            data.category   = $("#category").val();
            data.intro  = $("#intro").val();
            data.status = $("input[name='status']:checked").val();
            //带上id才是修改操作
            data.id = $('input[name=id]').val();

            $.post('/publish', data, function (response) {
                    if (response.status == 10001) {
                        layer.msg(response.msg, {icon: 5}); 
                    }else{
                        layer.msg(response.msg, {icon: 6},function(){
                            window.location.href= "{{ route('user.share',[ $user->id ]) }}"
                        }); 
                    }
            })
        }

     //    inlineAttachment.editors.codemirror4.attach(simplemde.codemirror,{
     //        uploadUrl: 'https://www.njphper.com/uploadImage',
     //        progressText: 'uploading...' ,
     //        uploadFieldName: 'image',
     //        extraParams: {
     //            '_token' : '4U1worPeaY0tREB7JCfjaEQAu7hIKvUmSu18ZdbD',
     //        },
     //    });
     //    $('.CodeMirror').css('height', '500px');

            layui.use('form', function(){
     //         var form = layui.form;
     //         //form.render();

     //         //  var data  = {};
     //         // data.content = simplemde.markdown(simplemde.value());
     //         // data.markdown_content = simplemde.value();
     //         //监听提交
     //         form.on('submit(publish)', function(data){


     //            $("#content").val() = simplemde.value();

     //           $.post('/publish',data.field,function(response){
     //                alert('1111111111');
     //             if (response.status == 10001) {
     //                                        alert('22222222');
          //  layer.msg(response.msg, {icon: 5}); 
         //    } else{
     //                                        alert('33333333');
         //     layer.msg(response.msg, {icon: 6},function(){
          //    window.location.href= "{{ route('user.share',[ $user->id ]) }}"
          //     }); 
          // }
     //            })
                
     //           //return false;
     //         });
            });
</script>
@endsection