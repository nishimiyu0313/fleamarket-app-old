<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachteckfurima</title>
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
    @yield('css')
</head>

<body>
    <div class="app">
        <header class="header">
            <a class="header__heading" href="/">
                <img src="{{ asset('images/logo.pmg1.svg') }}" alt="COACHTECHロゴ" height="35">
            </a>
            <form class="search-form" action="/item/search" method="get">
                @csrf
                <input class="search-form__keyword-input" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{request('keyword')}}">
                <input type="hidden" name="type" value="{{ request('type') == 'mylist' ? 'mylist' : '/' }}">
            </form>
            <ul class="header-nav">
                <li class="header-nav__item">
                    @if (Auth::check())
                    <form class="form" action="/logout" method="post" novalidate>
                        @csrf
                        <button class="header-nav__button">ログアウト</button>
                    </form>
                    @endif

                    <form class="mypage__form" action="/mypage/sell" method="get" novalidate>
                        <button class="header-nav__button">マイページ</button>
                    </form>
                    <form class="sell__form" action="/sell" method="get" novalidate>
                        <button class="header-nav__button-sell">出品</button>
                    </form>
                </li>


            </ul>
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

</html>