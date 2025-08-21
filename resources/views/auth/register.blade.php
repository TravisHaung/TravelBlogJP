@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <!-- Order your soul. Reduce your wants. - Augustine -->
    <div class="col-md-6">
        <h1 class="h3 mb-3">註冊</h1>
        <form method="POST" action="{{ route('register') }}">
            <!--app/Actions/Fortify/CreateNewUser預設必須要有"name","email","password"-->
            @csrf
            <div class="mb-3">
                <label class="form-label">使用者名稱</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">密碼</label>
                <input type="password" name="password" class="form-control" minlength="8" required>
            </div>
            <div class="mb-3">
                <label class="form-label">確認密碼</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">頭像</label>
                <input type="file" name="avatar" class="form-control">
            </div>
            <button class="btn btn-primary">註冊</button>
        </form>
    </div>
</div>
@endsection