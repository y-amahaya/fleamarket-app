<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
</head>
<body>
    <header class="header">
        <img src="{{ asset('images/logo.svg') }}" alt="COACHTECH" class="site-logo">

        <form class="search-form" action="#" method="GET">
            <input type="text" name="search" placeholder="なにをお探しですか？">
        </form>

        <nav class="nav-links">
            @auth
                {{-- ログイン後 --}}
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="{{ route('mypage.index') }}">マイページ</a>
                <a href="{{ route('product.create') }}">出品</a>
            @else
                {{-- ログイン前 --}}
                <a href="{{ route('login') }}">ログイン</a>
                <a href="{{ route('mypage.index') }}">マイページ</a>
                <a href="{{ route('product.create') }}">出品</a>
            @endauth
        </nav>
    </header>

    @yield('content')
</body>
</html>
