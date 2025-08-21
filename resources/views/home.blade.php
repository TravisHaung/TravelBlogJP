@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">歡迎回來，{{ $user->name }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Email：</strong> {{ $user->email }}</p>
            <p><strong>最後登入時間：</strong> {{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : '首次登入' }}</p>
        </div>
    </div>

    <a href="{{ route('articles.index') }}" class="btn btn-primary">瀏覽文章</a>
</div>
@endsection
