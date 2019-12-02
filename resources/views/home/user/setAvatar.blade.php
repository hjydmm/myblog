@extends('layouts.userEdit')
@section('title','头像修改')

@section('content')
<!-- 引入webuploader需要的css文件 -->
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/webuploader-0.1.5/webuploader.css') }}">

<div class="user-widget profile-item">
	<div class="inner-frame">
		<h3>アバター写真アップロード</h3><hr/>
        <form role="form" method="post" action="" class="form-horizontal" id="upload-form">
			<div class="">
		         <!-- 使用webuploader完成上传操作 -->
		        <div id="uploader-demo">
		         <!--用来存放item-->
		            <div id="fileList" class="uploader-list">
		              	<!-- 添加隐藏域 -->
		              <input type="hidden" name="avatar" value="">
			            <div class="pic">
			              <div style="width:260px; height:260px; background:url('{{ $user->avatar }}') no-repeat center / cover" class="thumbnail">
			              </div>
			          	</div>
	              {{--<div class="thumbnail" style="width: 240px;height:240px;overflow:hidden;">--}}
		               {{--<img src="{{ $user->avatar }}" alt="image" style="max-width:240px;width:expression(this.width > 240 ? '240px' : this.width);">--}}
		              {{--</div>--}}
		            </div>
		            <div id="filePicker" style="width: 260px !important;text-align: center;">写真をアップロードする</div>
					<div class="message" style="max-width: 260px;"></div>
		        </div>
			</div>
			{{csrf_field()}}
		</form>
	</div>
</div>
 <!--            <div class="container">
                <form method="post" action="{{ url('/user/uploadAvatar')}}" enctype="multipart/form-data">
                    <div class="card" style="width:400px">
                        <img class="card-img-top" src="{{ $user->avatar }}" alt="Card image" style="width:100%">
                        <div class="card-body">
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                <label class="custom-file-label" for="customFile">选择头像图片文件</label>
                            </div>
                            <input type="hidden" name="_token" value="4zc2ex1ouPMCVR2z3c09a2THLekJvehO9AbQ3xiQ">
                            <button class="btn btn-primary">上传图片</button>
                        </div>
                    </div>
                </form>
            </div> -->

<!--dom结构部分-->

{{--<link rel="stylesheet" type="text/css" href="{{asset('/assets/webuploader-master/css/webuploader.css')}}"/>--}}
{{--<link rel="stylesheet" type="text/css" href="{{asset('/assets/webuploader-master/examples/image-upload/style.css')}}"/>--}}

{{--<div id="wrapper">--}}
 {{--<div id="container">--}}
  {{--<!--头部，相册选择和格式选择-->--}}
  {{--<div id="uploader">--}}
   {{--<div class="queueList">--}}
    {{--<div id="dndArea" class="placeholder">--}}
     {{--<div id="filePicker"></div>--}}
     {{--<p>或将照片拖到这里，单次最多可选300张</p>--}}
    {{--</div>--}}
   {{--</div>--}}
   {{--<div class="statusBar" style="display:none;">--}}
    {{--<div class="progress">--}}
     {{--<span class="text">0%</span>--}}
     {{--<span class="percentage"></span>--}}
    {{--</div>--}}
    {{--<div class="info"></div>--}}
    {{--<div class="btns">--}}
     {{--<div id="filePicker2"></div>--}}
     {{--<div class="uploadBtn">开始上传</div>--}}
    {{--</div>--}}
   {{--</div>--}}
  {{--</div>--}}
 {{--</div>--}}
{{--</div>--}}

{{--<script type="text/javascript" src="{{asset('/assets/webuploader-master/examples/image-upload/jquery.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/assets/webuploader-master/dist/webuploader.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/assets/webuploader-master/examples/image-upload/upload.js')}}"></script>--}}




<!-- 引入webuploader需要的js文件 -->
<script type="text/javascript" src="{{ asset('/assets/webuploader-0.1.5/webuploader.js') }}"></script>
<!-- 引入图片上传js -->
<!-- src="{{ asset('/assets/avatar.js') }} -->
<!-- <script type="text/javascript" src="{{ asset('/assets/avatar2.js') }}"></script>-->

<!-- 如果把以下这段代码封装到一个js里面的话，浏览器缓存会把你气死！！！！！ -->


<script>
 {{--(function ($) {--}}
  {{--// 当domReady的时候开始初始化--}}
  {{--$(function () {--}}
   {{--var $wrap = $('#uploader'),--}}

           {{--// 图片容器--}}
           {{--$queue = $('<ul class="filelist"></ul>')--}}
                   {{--.appendTo($wrap.find('.queueList')),--}}

           {{--// 状态栏，包括进度和控制按钮--}}
           {{--$statusBar = $wrap.find('.statusBar'),--}}

           {{--// 文件总体选择信息。--}}
           {{--$info = $statusBar.find('.info'),--}}

           {{--// 上传按钮--}}
           {{--$upload = $wrap.find('.uploadBtn'),--}}

           {{--// 没选择文件之前的内容。--}}
           {{--$placeHolder = $wrap.find('.placeholder'),--}}

           {{--$progress = $statusBar.find('.progress').hide(),--}}

           {{--// 添加的文件数量--}}
           {{--fileCount = 0,--}}

           {{--// 添加的文件总大小--}}
           {{--fileSize = 0,--}}

           {{--// 优化retina, 在retina下这个值是2--}}
           {{--ratio = window.devicePixelRatio || 1,--}}

           {{--// 缩略图大小--}}
           {{--thumbnailWidth = 110 * ratio,--}}
           {{--thumbnailHeight = 110 * ratio,--}}

           {{--// 可能有pedding, ready, uploading, confirm, done.--}}
           {{--state = 'pedding',--}}

           {{--// 所有文件的进度信息，key为file id--}}
           {{--percentages = {},--}}
           {{--// 判断浏览器是否支持图片的base64--}}
           {{--isSupportBase64 = (function () {--}}
            {{--var data = new Image();--}}
            {{--var support = true;--}}
            {{--data.onload = data.onerror = function () {--}}
             {{--if (this.width != 1 || this.height != 1) {--}}
              {{--support = false;--}}
             {{--}--}}
            {{--}--}}
            {{--data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";--}}
            {{--return support;--}}
           {{--})(),--}}

           {{--// 检测是否已经安装flash，检测flash的版本--}}
           {{--flashVersion = (function () {--}}
            {{--var version;--}}

            {{--try {--}}
             {{--version = navigator.plugins['Shockwave Flash'];--}}
             {{--version = version.description;--}}
            {{--} catch (ex) {--}}
             {{--try {--}}
              {{--version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash')--}}
                      {{--.GetVariable('$version');--}}
             {{--} catch (ex2) {--}}
              {{--version = '0.0';--}}
             {{--}--}}
            {{--}--}}
            {{--version = version.match(/\d+/g);--}}
            {{--return parseFloat(version[0] + '.' + version[1], 10);--}}
           {{--})(),--}}

           {{--supportTransition = (function () {--}}
            {{--var s = document.createElement('p').style,--}}
                    {{--r = 'transition' in s ||--}}
                            {{--'WebkitTransition' in s ||--}}
                            {{--'MozTransition' in s ||--}}
                            {{--'msTransition' in s ||--}}
                            {{--'OTransition' in s;--}}
            {{--s = null;--}}
            {{--return r;--}}
           {{--})(),--}}

           {{--// WebUploader实例--}}
           {{--uploader;--}}

   {{--if (!WebUploader.Uploader.support('flash') && WebUploader.browser.ie) {--}}

    {{--// flash 安装了但是版本过低。--}}
    {{--if (flashVersion) {--}}
     {{--(function (container) {--}}
      {{--window['expressinstallcallback'] = function (state) {--}}
       {{--switch (state) {--}}
        {{--case 'Download.Cancelled':--}}
         {{--alert('您取消了更新！')--}}
         {{--break;--}}

        {{--case 'Download.Failed':--}}
         {{--alert('安装失败')--}}
         {{--break;--}}

        {{--default:--}}
         {{--alert('安装已成功，请刷新！');--}}
         {{--break;--}}
       {{--}--}}
       {{--delete window['expressinstallcallback'];--}}
      {{--};--}}

      {{--var swf = './expressInstall.swf';--}}
      {{--// insert flash object--}}
      {{--var html = '<object type="application/' +--}}
              {{--'x-shockwave-flash" data="' + swf + '" ';--}}

      {{--if (WebUploader.browser.ie) {--}}
       {{--html += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';--}}
      {{--}--}}

      {{--html += 'width="100%" height="100%" style="outline:0">' +--}}
              {{--'<param name="movie" value="' + swf + '" />' +--}}
              {{--'<param name="wmode" value="transparent" />' +--}}
              {{--'<param name="allowscriptaccess" value="always" />' +--}}
              {{--'</object>';--}}

      {{--container.html(html);--}}

     {{--})($wrap);--}}

     {{--// 压根就没有安转。--}}
    {{--} else {--}}
     {{--$wrap.html('<a href="http://www.adobe.com/go/getflashplayer" target="_blank" border="0"><img alt="get flash player" src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg" /></a>');--}}
    {{--}--}}

    {{--return;--}}
   {{--} else if (!WebUploader.Uploader.support()) {--}}
    {{--alert('Web Uploader 不支持您的浏览器！');--}}
    {{--return;--}}
   {{--}--}}

   {{--// 实例化--}}
   {{--uploader = WebUploader.create({--}}
    {{--pick: {--}}
     {{--id: '#filePicker',--}}
     {{--label: '点击选择图片'--}}
    {{--},--}}
    {{--// formData: {--}}
    {{--//  uid: 123--}}
    {{--// },--}}

    {{--//添加一些自己需要的参数--}}
    {{--formData: {--}}
     {{--//'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),--}}
     {{--'_token':'{{csrf_token()}}'--}}
    {{--},--}}


    {{--dnd: '#dndArea',--}}
    {{--paste: '#uploader',--}}
    {{--swf: '../../dist/Uploader.swf',--}}
    {{--chunked: false,--}}
    {{--chunkSize: 512 * 1024,--}}
    {{--server: '/user/uploadAvatar',--}}
    {{--// runtimeOrder: 'flash',--}}

    {{--accept: {--}}
     {{--title: 'Images',--}}
     {{--extensions: 'gif,jpg,jpeg,bmp,png',--}}
     {{--mimeTypes: 'image/jpg,image/jpeg,image/png' //修改这行--}}
    {{--},--}}

    {{--// 禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。--}}
    {{--disableGlobalDnd: true,--}}
    {{--fileNumLimit: 300,--}}
    {{--fileSizeLimit: 200 * 1024 * 1024,    // 200 M--}}
    {{--fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M--}}
   {{--});--}}

   {{--// 拖拽时不接受 js, txt 文件。--}}
   {{--uploader.on('dndAccept', function (items) {--}}
    {{--var denied = false,--}}
            {{--len = items.length,--}}
            {{--i = 0,--}}
            {{--// 修改js类型--}}
            {{--unAllowed = 'text/plain;application/javascript ';--}}

    {{--for (; i < len; i++) {--}}
     {{--// 如果在列表里面--}}
     {{--if (~unAllowed.indexOf(items[i].type)) {--}}
      {{--denied = true;--}}
      {{--break;--}}
     {{--}--}}
    {{--}--}}

    {{--return !denied;--}}
   {{--});--}}

   {{--uploader.on('dialogOpen', function () {--}}
    {{--console.log('here');--}}
   {{--});--}}

   {{--// uploader.on('filesQueued', function() {--}}
   {{--//     uploader.sort(function( a, b ) {--}}
   {{--//         if ( a.name < b.name )--}}
   {{--//           return -1;--}}
   {{--//         if ( a.name > b.name )--}}
   {{--//           return 1;--}}
   {{--//         return 0;--}}
   {{--//     });--}}
   {{--// });--}}

   {{--// 添加“添加文件”的按钮，--}}
   {{--uploader.addButton({--}}
    {{--id: '#filePicker2',--}}
    {{--label: '继续添加'--}}
   {{--});--}}

   {{--uploader.on('ready', function () {--}}
    {{--window.uploader = uploader;--}}
   {{--});--}}

   {{--// 文件上传成功，给item添加成功class, 用样式标记上传成功。--}}
   {{--//file 文件信息  ret 上传成功返回的数据--}}
   {{--uploader.on('uploadSuccess', function (file, ret, hds) {--}}
    {{--$('#' + file.id).addClass('upload-state-done');--}}
   {{--});--}}

   {{--// 当有文件添加进来时执行，负责view的创建--}}
   {{--function addFile(file) {--}}
    {{--var $li = $('<li id="' + file.id + '">' +--}}
            {{--'<p class="title">' + file.name + '</p>' +--}}
            {{--'<p class="imgWrap"></p>' +--}}
            {{--'<p class="progress"><span></span></p>' +--}}
            {{--'</li>'),--}}

            {{--$btns = $('<div class="file-panel">' +--}}
                    {{--'<span class="cancel">删除</span>' +--}}
                    {{--'<span class="rotateRight">向右旋转</span>' +--}}
                    {{--'<span class="rotateLeft">向左旋转</span></div>').appendTo($li),--}}
            {{--$prgress = $li.find('p.progress span'),--}}
            {{--$wrap = $li.find('p.imgWrap'),--}}
            {{--$info = $('<p class="error"></p>'),--}}

            {{--showError = function (code) {--}}
             {{--switch (code) {--}}
              {{--case 'exceed_size':--}}
               {{--text = '文件大小超出';--}}
               {{--break;--}}

              {{--case 'interrupt':--}}
               {{--text = '上传暂停';--}}
               {{--break;--}}

              {{--default:--}}
               {{--text = '上传失败，请重试';--}}
               {{--break;--}}
             {{--}--}}

             {{--$info.text(text).appendTo($li);--}}
            {{--};--}}

    {{--if (file.getStatus() === 'invalid') {--}}
     {{--showError(file.statusText);--}}
    {{--} else {--}}
     {{--// @todo lazyload--}}
     {{--$wrap.text('预览中');--}}
     {{--uploader.makeThumb(file, function (error, src) {--}}
      {{--var img;--}}

      {{--if (error) {--}}
       {{--$wrap.text('不能预览');--}}
       {{--return;--}}
      {{--}--}}

      {{--if (isSupportBase64) {--}}
       {{--img = $('<img src="' + src + '">');--}}
       {{--$wrap.empty().append(img);--}}
      {{--} else {--}}
       {{--$.ajax('../../server/preview.php', {--}}
        {{--method: 'POST',--}}
        {{--data: src,--}}
        {{--dataType: 'json'--}}
       {{--}).done(function (response) {--}}
        {{--if (response.result) {--}}
         {{--img = $('<img src="' + response.result + '">');--}}
         {{--$wrap.empty().append(img);--}}
        {{--} else {--}}
         {{--$wrap.text("预览出错");--}}
        {{--}--}}
       {{--});--}}
      {{--}--}}
     {{--}, thumbnailWidth, thumbnailHeight);--}}

     {{--percentages[file.id] = [file.size, 0];--}}
     {{--file.rotation = 0;--}}
    {{--}--}}

    {{--file.on('statuschange', function (cur, prev) {--}}
     {{--if (prev === 'progress') {--}}
      {{--$prgress.hide().width(0);--}}
     {{--} else if (prev === 'queued') {--}}
      {{--$li.off('mouseenter mouseleave');--}}
      {{--$btns.remove();--}}
     {{--}--}}

     {{--// 成功--}}
     {{--if (cur === 'error' || cur === 'invalid') {--}}
      {{--console.log(file.statusText);--}}
      {{--showError(file.statusText);--}}
      {{--percentages[file.id][1] = 1;--}}
     {{--} else if (cur === 'interrupt') {--}}
      {{--showError('interrupt');--}}
     {{--} else if (cur === 'queued') {--}}
      {{--$info.remove();--}}
      {{--$prgress.css('display', 'block');--}}
      {{--percentages[file.id][1] = 0;--}}
     {{--} else if (cur === 'progress') {--}}
      {{--$info.remove();--}}
      {{--$prgress.css('display', 'block');--}}
     {{--} else if (cur === 'complete') {--}}
      {{--$prgress.hide().width(0);--}}
      {{--$li.append('<span class="success"></span>');--}}
     {{--}--}}

     {{--$li.removeClass('state-' + prev).addClass('state-' + cur);--}}
    {{--});--}}

    {{--$li.on('mouseenter', function () {--}}
     {{--$btns.stop().animate({height: 30});--}}
    {{--});--}}

    {{--$li.on('mouseleave', function () {--}}
     {{--$btns.stop().animate({height: 0});--}}
    {{--});--}}

    {{--$btns.on('click', 'span', function () {--}}
     {{--var index = $(this).index(),--}}
             {{--deg;--}}

     {{--switch (index) {--}}
      {{--case 0:--}}
       {{--uploader.removeFile(file);--}}
       {{--return;--}}

      {{--case 1:--}}
       {{--file.rotation += 90;--}}
       {{--break;--}}

      {{--case 2:--}}
       {{--file.rotation -= 90;--}}
       {{--break;--}}
     {{--}--}}

     {{--if (supportTransition) {--}}
      {{--deg = 'rotate(' + file.rotation + 'deg)';--}}
      {{--$wrap.css({--}}
       {{--'-webkit-transform': deg,--}}
       {{--'-mos-transform': deg,--}}
       {{--'-o-transform': deg,--}}
       {{--'transform': deg--}}
      {{--});--}}
     {{--} else {--}}
      {{--$wrap.css('filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (~~((file.rotation / 90) % 4 + 4) % 4) + ')');--}}
      {{--// use jquery animate to rotation--}}
      {{--// $({--}}
      {{--//     rotation: rotation--}}
      {{--// }).animate({--}}
      {{--//     rotation: file.rotation--}}
      {{--// }, {--}}
      {{--//     easing: 'linear',--}}
      {{--//     step: function( now ) {--}}
      {{--//         now = now * Math.PI / 180;--}}

      {{--//         var cos = Math.cos( now ),--}}
      {{--//             sin = Math.sin( now );--}}

      {{--//         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");--}}
      {{--//     }--}}
      {{--// });--}}
     {{--}--}}


    {{--});--}}

    {{--$li.appendTo($queue);--}}
   {{--}--}}

   {{--// 负责view的销毁--}}
   {{--function removeFile(file) {--}}
    {{--var $li = $('#' + file.id);--}}

    {{--delete percentages[file.id];--}}
    {{--updateTotalProgress();--}}
    {{--$li.off().find('.file-panel').off().end().remove();--}}
   {{--}--}}

   {{--function updateTotalProgress() {--}}
    {{--var loaded = 0,--}}
            {{--total = 0,--}}
            {{--spans = $progress.children(),--}}
            {{--percent;--}}

    {{--$.each(percentages, function (k, v) {--}}
     {{--total += v[0];--}}
     {{--loaded += v[0] * v[1];--}}
    {{--});--}}

    {{--percent = total ? loaded / total : 0;--}}


    {{--spans.eq(0).text(Math.round(percent * 100) + '%');--}}
    {{--spans.eq(1).css('width', Math.round(percent * 100) + '%');--}}
    {{--updateStatus();--}}
   {{--}--}}

   {{--function updateStatus() {--}}
    {{--var text = '', stats;--}}

    {{--if (state === 'ready') {--}}
     {{--text = '选中' + fileCount + '张图片，共' +--}}
             {{--WebUploader.formatSize(fileSize) + '。';--}}
    {{--} else if (state === 'confirm') {--}}
     {{--stats = uploader.getStats();--}}
     {{--if (stats.uploadFailNum) {--}}
      {{--text = '已成功上传' + stats.successNum + '张照片至XX相册，' +--}}
              {{--stats.uploadFailNum + '张照片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'--}}
     {{--}--}}

    {{--} else {--}}
     {{--stats = uploader.getStats();--}}
     {{--text = '共' + fileCount + '张（' +--}}
             {{--WebUploader.formatSize(fileSize) +--}}
             {{--'），已上传' + stats.successNum + '张';--}}

     {{--if (stats.uploadFailNum) {--}}
      {{--text += '，失败' + stats.uploadFailNum + '张';--}}
     {{--}--}}
    {{--}--}}

    {{--$info.html(text);--}}
   {{--}--}}

   {{--function setState(val) {--}}
    {{--var file, stats;--}}

    {{--if (val === state) {--}}
     {{--return;--}}
    {{--}--}}

    {{--$upload.removeClass('state-' + state);--}}
    {{--$upload.addClass('state-' + val);--}}
    {{--state = val;--}}

    {{--switch (state) {--}}
     {{--case 'pedding':--}}
      {{--$placeHolder.removeClass('element-invisible');--}}
      {{--$queue.hide();--}}
      {{--$statusBar.addClass('element-invisible');--}}
      {{--uploader.refresh();--}}
      {{--break;--}}

     {{--case 'ready':--}}
      {{--$placeHolder.addClass('element-invisible');--}}
      {{--$('#filePicker2').removeClass('element-invisible');--}}
      {{--$queue.show();--}}
      {{--$statusBar.removeClass('element-invisible');--}}
      {{--uploader.refresh();--}}
      {{--break;--}}

     {{--case 'uploading':--}}
      {{--$('#filePicker2').addClass('element-invisible');--}}
      {{--$progress.show();--}}
      {{--$upload.text('暂停上传');--}}
      {{--break;--}}

     {{--case 'paused':--}}
      {{--$progress.show();--}}
      {{--$upload.text('继续上传');--}}
      {{--break;--}}

     {{--case 'confirm':--}}
      {{--$progress.hide();--}}
      {{--$('#filePicker2').removeClass('element-invisible');--}}
      {{--$upload.text('开始上传');--}}

      {{--stats = uploader.getStats();--}}
      {{--if (stats.successNum && !stats.uploadFailNum) {--}}
       {{--setState('finish');--}}
       {{--return;--}}
      {{--}--}}
      {{--break;--}}
     {{--case 'finish':--}}
      {{--stats = uploader.getStats();--}}
      {{--if (stats.successNum) {--}}
       {{--// alert('上传成功');--}}
      {{--} else {--}}
       {{--// 没有成功的图片，重设--}}
       {{--state = 'done';--}}
       {{--location.reload();--}}
      {{--}--}}
      {{--break;--}}
    {{--}--}}

    {{--updateStatus();--}}
   {{--}--}}

   {{--uploader.onUploadProgress = function (file, percentage) {--}}
    {{--var $li = $('#' + file.id),--}}
            {{--$percent = $li.find('.progress span');--}}

    {{--$percent.css('width', percentage * 100 + '%');--}}
    {{--percentages[file.id][1] = percentage;--}}
    {{--updateTotalProgress();--}}
   {{--};--}}

   {{--uploader.onFileQueued = function (file) {--}}
    {{--fileCount++;--}}
    {{--fileSize += file.size;--}}

    {{--if (fileCount === 1) {--}}
     {{--$placeHolder.addClass('element-invisible');--}}
     {{--$statusBar.show();--}}
    {{--}--}}

    {{--addFile(file);--}}
    {{--setState('ready');--}}
    {{--updateTotalProgress();--}}
   {{--};--}}

   {{--uploader.onFileDequeued = function (file) {--}}
    {{--fileCount--;--}}
    {{--fileSize -= file.size;--}}

    {{--if (!fileCount) {--}}
     {{--setState('pedding');--}}
    {{--}--}}

    {{--removeFile(file);--}}
    {{--updateTotalProgress();--}}

   {{--};--}}

   {{--uploader.on('all', function (type) {--}}
    {{--var stats;--}}
    {{--switch (type) {--}}
     {{--case 'uploadFinished':--}}
      {{--setState('confirm');--}}
      {{--break;--}}

     {{--case 'startUpload':--}}
      {{--setState('uploading');--}}
      {{--break;--}}

     {{--case 'stopUpload':--}}
      {{--setState('paused');--}}
      {{--break;--}}

    {{--}--}}
   {{--});--}}

   {{--uploader.onError = function (code) {--}}
    {{--alert('Eroor: ' + code);--}}
   {{--};--}}

   {{--$upload.on('click', function () {--}}
    {{--if ($(this).hasClass('disabled')) {--}}
     {{--return false;--}}
    {{--}--}}

    {{--if (state === 'ready') {--}}
     {{--uploader.upload();--}}
    {{--} else if (state === 'paused') {--}}
     {{--uploader.upload();--}}
    {{--} else if (state === 'uploading') {--}}
     {{--uploader.stop();--}}
    {{--}--}}
   {{--});--}}

   {{--$info.on('click', '.retry', function () {--}}
    {{--uploader.retry();--}}
   {{--});--}}

   {{--$info.on('click', '.ignore', function () {--}}
    {{--alert('todo');--}}
   {{--});--}}

   {{--$upload.addClass('state-' + state);--}}
   {{--updateTotalProgress();--}}
  {{--});--}}

 {{--})(jQuery);--}}


</script>








<script>
// 如果把以下这段代码封装到一个js里面的话，浏览器缓存会把你气死！！！！！
// 图片上传demo
jQuery(function() {
    var $ = jQuery,
        $list = $('#fileList'),
        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 2,

        // 缩略图大小
        thumbnailWidth = 130 * ratio,
        thumbnailHeight = 130 * ratio,

        // Web Uploader实例
        uploader;

    // 初始化Web Uploader
    uploader = WebUploader.create({

        //添加一些自己需要的参数
        formData: {
			'_token':'{{csrf_token()}}'
        },

        // 自动上传。
        auto: true,

        // swf文件路径
        swf: '/assets/webuploader-0.1.5/Uploader.swf',

        // 文件接收服务端(路由)。
        server: '/user/uploadAvatar',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

        // 只允许选择文件，可选。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        },

		// 设置缩略图。
		// thumb: {
		// 	width: 260,
		// 	height: 260,
		// 	// 图片质量，只有type为`image/jpeg`的时候才有效。
		// 	quality: 100,
		// 	// 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
		// 	allowMagnify: true,
		// 	// 是否允许裁剪。是否采用裁剪模式。如果采用这样可以避免空白内容。
		// 	crop: true,
		// 	// 为空的话则保留原有图片格式。
		// 	// 否则强制转换成指定的类型。
		// 	type: 'image/jpeg'
		// },

		// 配置压缩的图片的选项。如果此选项为false, 则图片在上传前不进行压缩。
		// compress: {
		// 	width: 1600,
		// 	height: 1600,
		// 	// 图片质量，只有type为`image/jpeg`的时候才有效。
		// 	quality: 100,
		// 	// 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
		// 	allowMagnify: false,
		// 	// 是否允许裁剪。
		// 	crop: false,
		// 	// 是否保留头部meta信息。
		// 	preserveHeaders: true,
		// 	// 如果发现压缩后文件大小比原来还大，则使用原来图片
		// 	// 此属性可能会影响图片自动纠正功能
		// 	noCompressIfLarger: false,
		// 	// 单位字节，如果图片大小小于此值，不会采用压缩。
		// 	compressSize: 0
		// },

		//是否压缩图片
        // compress: false,
        // resize: false,


    });

    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        // var $li = $(
        //         '<div id="' + file.id + '" class="file-item thumbnail">' +
        //             '<img>' +
        //             '<div class="info">' + file.name + '</div>' +
        //         '</div>'
        //         ),
        //     $img = $li.find('img');



        // var $li = $(
        //         '<div id="' + '" class="thumbnail" style="max-width: 260px;max-height:260px;">' +
        //             '<img style="max-width: 100%;max-height: 100%; display: none;">' +
        //         '</div>'
        //         ),
        //     $img = $li.find('img');


		// img += '<div style="'+'width:260px; height:260px; background:url(' + response.data.path + ') no-repeat center / cover" class="thumbnail">';
		// img += '</div>';

        //如果不想添加图片后上一个图片仍然保留的话
        //选择新图之前清除掉之前的预览图数据
        // $('.thumbnail').remove();
		//
        // $list.append( $li );

        //创建缩略图
        // uploader.makeThumb( file, function( error, src ) {
        //     if ( error ) {
        //         $img.replaceWith('<span>不能预览</span>');
        //         return;
        //     }
		//
		// 	$img.css( 'display', 'none' );
        //     //$img.attr( 'src', src );
        // }, thumbnailWidth, thumbnailHeight );

    });

    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                    .appendTo( $li )
                    .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });


    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file, response ) {
    	$('.thumbnail').remove();
        $("#filePicker").remove();
        $( '#'+file.id ).addClass('upload-state-done');
        //将上传成功文件的路径传到隐藏域里面去
        $('input[name=avatar]').val(response.data.path);
        var img = '';
        img += '<div style="'+'width:260px; height:260px; background:url(' + response.data.path + ') no-repeat center / cover" class="thumbnail">';
        img += '</div>';
        $(".pic").html(img);
        //$("#select-bar").remove();

        var str = '';
        str += '<div class="alert alert-success">' + response.msg + '</div>';
        $(".message").html(str);

    });

    // 文件上传失败，现实上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });
});
</script>

@endsection