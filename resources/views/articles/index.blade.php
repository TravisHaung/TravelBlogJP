@extends('layouts.app')
<!-- Very little is needed to make a happy life. - Marcus Aurelius -->
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">文章列表</h1>
  @auth
    <a href="{{ route('articles.create') }}" class="btn btn-primary">新增文章</a>
  @endauth
</div>

@foreach ($articles as $article)
  <div class="card mb-3">
    <!--成為一個卡片內部內容區塊（有 padding）其子元素會以 Flexbox 排列（預設橫向）垂直置中對齊-->
    <div class="card-body d-flex align-items-center">
      <img src="{{ asset($article->user->avatar ?? 'images/default-avatar.png') }}"
            alt="avatar" class="rounded-circle me-2" width="40" height="40">
      <div class="mb-4">
        <h2>
          <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
        </h2>
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

      {{-- @can('update', $article) 檢查目前的使用者是否能對這篇 $article 執行 update 權限。(常在policy中定義) --}}
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
    </div>
  </div>
@endforeach

{{ $articles->links() }}
@endsection
