@extends('layouts.app')
@section('content')
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
<h1 class="h3 mb-3">新增文章</h1>
<form action="{{ route('articles.store') }}" method="POST">
  @include('articles._form')
  <button class="btn btn-primary">建立</button>
  <a href="{{ route('articles.index') }}" class="btn btn-link">取消</a>
</form>
@endsection
