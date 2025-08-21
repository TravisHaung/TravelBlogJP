<!doctype html>
<html lang="zh-Hant">
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Blog') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  </head>

  <body>
    <!-- navbar-expand-lg：視窗 >= large(lg):,navbar會展開；視窗 < lg: 折疊成漢堡選單 -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
      <div class="container">
        <a class="navbar-brand" href="{{ route('articles.index') }}">Blogg</a>
        
        <!--
        data-bs-toggle="collapse"           這是個「可收合」的按鈕。
        data-bs-target="#navbarsExample"	  點下去之後讓 id=navbarsExample 的物件展開/收合
        aria-controls="navbarsExample"      可存取性設定，指出控制的區塊 ID。
        aria-expanded="false"               表示目前狀態為「未展開」。
        aria-label="Toggle navigation"      給螢幕閱讀器用的描述文字。
        <span class="navbar-toggler-icon">	三條橫線的漢堡圖示。
        -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample" aria-controls="navbarsExample" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div id="navbarsExample" class="collapse navbar-collapse">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}">文章</a></li>
          </ul>
          
          <ul class="navbar-nav ms-auto">
            @auth
            <!--asset(...): Laravel 的 helper，會把路徑補上網站的 base URL，例如：
                asset('images/default-avatar.png') -> https://yourdomain.com/images/default-avatar.png-->
              <img src="{{ asset(auth()->user()->avatar ?? 'images/default-avatar.png') }}" 
                class="rounded-circle me-2" width="32" height="32" alt="avatar">
              <li class="nav-item me-2"><span class="navbar-text">{{ auth()->user()->name }}</span></li>
              <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="btn btn-outline-light btn-sm">登出</button>
                </form>
              </li>
            @else
              <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登入</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">註冊</a></li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>

    <main class="container">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @yield('content')
    </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
