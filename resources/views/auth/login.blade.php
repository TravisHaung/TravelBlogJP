@extends('layouts.app')
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->

@section('content')
<div class="row justify-content-center">
    <!--在中等螢幕（≥768px）以上時，欄位佔6/12的寬度）。在更小螢幕則會自動變成12/12 -->
    <div class="col-md-6">
        <!-- m:margin（外距）b:bottom（底部）3:間距等級(0～5)-->
        <h1 class="h3 mb-3">登入</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <!--type="email": 限制輸入格式為 Email（有簡易的瀏覽器端驗證）-->
                <!--required autofocus value="{{ old('email') }}: 驗證失敗重新導向時，會自動保留使用者輸入的內容-->
                <input type="email" name="email" class="form-control" required autofocus value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">密碼</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">記住我</label>
            </div>
            <button class="btn btn-primary">登入</button>
            <a class="btn btn-link" href="{{ route('password.request') }}">忘記密碼？</a>
        </form>
    </div>
</div>
@endsection