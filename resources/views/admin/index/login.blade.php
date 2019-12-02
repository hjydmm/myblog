<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>ログイン - HJY ADMIN BLOG</title>
    <!-- 开发阶段不需要页面缓存 -->
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('/assets/common/bootstrap-3.1.1/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- font-awesome Fonts -->
    <link href="{{asset('/assets/common/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <!-- My CSS -->
    <link href="{{asset('/assets/common/common-style.css')}}" rel="stylesheet">
</head>

<style>
    @if ($errors->has('username'))
    input.username::-webkit-input-placeholder {
        /* placeholder颜色  */
        color: rgba(246, 119, 119, 0.7)!important;
        font-weight: bold;
        /*!* placeholder字体大小  *!*/
        font-size: 13px;
        /*!* placeholder位置  *!*/
        /*text-align: right;*/
    }
    @endif
    @if ($errors->has('password'))
    input.password::-webkit-input-placeholder {
        /* placeholder颜色  */
        color: rgba(246, 119, 119, 0.7)!important;
        font-weight: bold;
        /*!* placeholder字体大小  *!*/
        font-size: 13px;
        /*!* placeholder位置  *!*/
        /*text-align: right;*/
    }
    @endif
</style>

<body class="body">
<div class="main">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="margin-top: 100px;">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ログイン</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{ url('/admin/doLogin')  }}" method="post">
                            <fieldset>
                                <div class="form-group">
                                    @if ($errors->has('username'))
                                    <input class="form-control username" placeholder="ユーザー名" name="username" type="text" autocomplete="off">
                                    @else
                                    <input class="form-control username" placeholder="ユーザー名" name="username" type="text" autocomplete="off" value="{{ old('username') }}">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input class="form-control password" placeholder="パスワード" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input id="remember" name="remember" type="checkbox" value="remember">次回から自動でログイン
                                    </label>
                                </div>
                                {{ csrf_field() }}
                                <button class="login-button" type="submit">ログイン</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 message" style="margin-top: 100px;"></div>



        </div>
    </div>

</div>
</body>
<!------------------------------------------------------------------------------------------------------>
<!----------------------------------------------JS script----------------------------------------------->
<!------------------------------------------------------------------------------------------------------>
<!-- jQuery -->
<script type="text/javascript" src="{{ asset('/assets/common/jquery-1.11.2/jquery.min.js')}}"></script>
<!-- sweetalert -->
<script type="text/javascript" src="{{ asset('/assets/common/sweetalert/dist/sweetalert.min.js')}}"></script>
<script>

    @if ($errors->has('username'))
    $(".username").attr("placeholder", "{{ $errors->first('username') }}");
    {{--@else--}}
    {{--$(".username").val("{{ old('username') }}");--}}
    @endif

    @if ($errors->has('password'))
    $(".password").attr("placeholder", "{{ $errors->first('password') }}");
    @endif

    @if ($errors->has('loginError'))
    swal("ログインエラー", "{{ $errors->first('loginError') }}", "error");
    @endif

</script>
