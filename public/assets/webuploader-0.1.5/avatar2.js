// 如果把以下这段代码封装到一个js里面的话，浏览器缓存会把你气死！！！！！
// 图片上传demo
jQuery(function() {
    var $ = jQuery,
        $list = $('#fileList'),
        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 2,

        // 缩略图大小
        thumbnailWidth = 100 * ratio,
        thumbnailHeight = 100 * ratio,

        // Web Uploader实例
        uploader;

    // 初始化Web Uploader
    uploader = WebUploader.create({

        //添加一些自己需要的参数
        formData: {
            _token: $('input[name=_token]').val(),
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
        }

        //是否压缩图片
        compress:false, 
        resize: false,
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

        var $li = $(
                '<div id="' + '" class="thumbnail" style="max-width: 240px;max-height:240px;">' +
                    '<img style="max-width: 100%;max-height: 100%">' +
                '</div>'
                ),
            $img = $li.find('img');

        //如果不想添加图片后上一个图片仍然保留的话
        //选择新图之前清除掉之前的预览图数据
        $('.thumbnail').remove();

        $list.append( $li );

        // 创建缩略图
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, thumbnailWidth, thumbnailHeight );
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
        $("#filePicker").remove();      
        $( '#'+file.id ).addClass('upload-state-done');
        //将上传成功文件的路径传到隐藏域里面去
        $('input[name=avatar]').val(response.path);
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