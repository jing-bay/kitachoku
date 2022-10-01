<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>キタチョク-店舗管理者登録</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <div class="header__left">
        <div class="header__logo">
          <a href="/"><img src="{{ asset('images/logo.jpg') }}" alt="キタチョク"></a>
        </div>
      </div>
      <div class="header__middle">店舗管理者ページ</div>
      <div class="header__right">
        @if(Auth::guard('shopadmin')->check())
        <form action="/shopadmin/logout" method="post" class="header__menu--right">
          @csrf
          <button type="submit" class="header__menu-logout">ログアウト</button>
        </form>
        <div class="header__menu--right">
          <a href="/shopadmin/settings">店舗管理ページ</a>
        </div>
        @else
        <div class="header__menu--right">
          <a href="/shopadmin/login">店舗ログイン</a>
        </div>
        <div class="header__menu--right">
          <a href="/shopadmin/register">新規登録</a>
        </div>
        @endif
      </div>
      <div class="header__ham-menu" id="js-ham">
        <ul class="header__list">
          @if(Auth::guard('shopadmin')->check())
          <li class="header__ham-item">
            <form action="/shopadmin/logout" method="post">
              @csrf
              <button type="submit" class="header__menu-logout">ログアウト</button>
            </form>
          </li>
          <li class="header__ham-item"><a href="/shopadmin/settings">店舗管理ページ</a></li>
          @else
          <li class="header__ham-item"><a href="/shopadmin/register">新規登録</a></li>
          <li class="header__ham-item"><a href="/shopadmin/login">店舗ログイン</a></li>
          @endif
        </ul>
      </div>
      <div class="header__menubtn" id="menubtn">
          <span></span>
          <span></span>
          <span></span>
      </div>
    </div>
  </header>
  @yield('shopadmin-header')
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script src="{{ asset('js/shopadmin.js') }}"></script>
  <script src="{{ asset('js/search.js') }}"></script>
</body>
</html>