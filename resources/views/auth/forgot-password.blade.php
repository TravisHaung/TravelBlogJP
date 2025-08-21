@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
    <div class="col-md-6">
        <h1 class="h3 mb-3">忘記密碼</h1>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <button class="btn btn-primary">寄送重設連結</button>
        </form>
    </div>
</div>
@endsection