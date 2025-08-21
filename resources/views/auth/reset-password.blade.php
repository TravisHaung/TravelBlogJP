@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    <div class="col-md-6">
        <h1 class="h3 mb-3">重設密碼</h1>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $request->email) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">新密碼</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">確認新密碼</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button class="btn btn-primary">更新密碼</button>
        </form>
    </div>
</div>
@endsection