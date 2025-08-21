@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <!-- It always seems impossible until it is done. - Nelson Mandela -->
    <div class="col-md-8 text-center">
        <h1 class="h3 mb-3">請驗證您的 Email</h1>
        <p>已寄送驗證信至您的信箱，請點擊信件中的連結完成驗證。</p>
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">新的驗證連結已寄送至您的信箱！</div>
        @endif
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button class="btn btn-primary">重新寄送驗證信</button>
        </form>
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button class="btn btn-link">登出</button>
        </form>
    </div>
</div>
@endsection