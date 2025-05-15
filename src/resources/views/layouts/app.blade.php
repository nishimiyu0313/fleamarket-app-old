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
            <h1 class="header__heading">CARCHTECH</h1>
            <form class="search-form">
                <input class="search-form__keyword-input" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{request('keyword')}}">
            </form>
            <ul class="header-nav">
                <li class="header-nav__item">
                    <form class="logout__form">
                        <button class="header-nav__button">ログアウト</button>
                    </form>
                    <form class="mypage__form">
                        <button class="header-nav__button">マイページ</button>
                    </form>
                    <form class="sell__form">
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


