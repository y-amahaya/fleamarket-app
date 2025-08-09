<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body class="common-body">
    <header class="header">
        <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH" class="site-logo">
    </header>

    <main class="container">
        @yield('content')
    </main>
</body>
</html>