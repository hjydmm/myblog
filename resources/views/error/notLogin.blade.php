<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginError</title>
</head>

<body class="body-LoginError">

<div class="container">

    <section class="error-wrapper">
        <i class="icon-LoginError"></i>
        <h1>申し訳ございません</h1>
        <h3>未登録/セッションがタイムアウトしました</h3>
        <p class="page-LoginError">再度ログインしてください <a href="{{ url("/login") }}">ログイン</a></p>
        <p class="page-LoginError">ホームページへ <a href="{{ url($home_page) }}">Return Home</a></p>
    </section>

</div>

</body>
</html>
