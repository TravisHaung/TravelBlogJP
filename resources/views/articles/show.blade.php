@extends('layouts.app')
@section('content')
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
<article>
  <header class="mb-3 d-flex">
    <div>
      <h1 class="mb-1">{{ $article->title }}</h1>
      <p class="text-muted">
        分類：{{ $article->category->name ?? '未分類' }} | 作者：{{ $article->user->name }}
      </p>
      <p>
        標籤：
        @foreach($article->tags as $tag)
          <span class="badge bg-secondary">{{ $tag->name }}</span>
        @endforeach
      </p>
    </div>

    @canany(['update', 'delete'], $article)
        <div class="dropdown ms-auto">
          <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-three-dots-vertical"></i>
          </button>

          <ul class="dropdown-menu dropdown-menu-end">
            @can('update', $article)
              <li>
                <a class="dropdown-item" href="{{ route('articles.edit', $article) }}">編輯</a>
              </li>
            @endcan
            @can('delete', $article)
              <li>
                <form action="{{ route('articles.destroy', $article) }}" method="POST"
                      onsubmit="return confirm('確定要刪除嗎？')">
                  @csrf @method('DELETE')
                  <button type="submit" class="dropdown-item text-danger">刪除</button>
                </form>
              </li>
            @endcan
          </ul>
        </div>
      @endcanany
  </header>

  <div class="mb-4">{!! nl2br(e($article->body)) !!}</div>
  
  <div class="d-flex gap-2">
    @can('update', $article)
      <a class="btn btn-outline-secondary" href="{{ route('articles.edit', $article) }}">編輯</a>
    @endcan
    <a class="btn btn-link" href="{{ route('articles.index') }}">返回列表</a>
  </div>
</article>
@endsection
