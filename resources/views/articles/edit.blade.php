@extends('layouts.app')
@section('content')
    <!-- Order your soul. Reduce your wants. - Augustine -->
<h1 class="h3 mb-3">編輯文章</h1>
<form action="{{ route('articles.update', $article) }}" method="POST">
  @method('PUT')
  @include('articles._form')
  <button class="btn btn-primary">儲存</button>
  <a href="{{ route('articles.show', $article) }}" class="btn btn-link">返回</a>
</form>
@endsection
