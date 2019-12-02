<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StatusError</title>
</head>

<body class="body-StatusError">

<div class="container">

    <section class="error-wrapper">
        <i class="icon-StatusError"></i>
        <h1>申し訳ございません</h1>
        <h3>アカウントが一時的に凍結されました</h3>
        {{--<p class="page-StatusError">管理者に連絡してください <a href="{{ url("/login") }}">ログイン</a></p>--}}
        <p class="page-StatusError">ホームページへ <a href="{{ url($home_page) }}">Return Home</a></p>
    </section>

</div>

</body>
</html>

