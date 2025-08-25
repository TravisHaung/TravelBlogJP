@extends('layouts.app')
@section('content')
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->


<div class="container">
  <div class="row">
    <div class="col-md-9">
      <header class="mb-3 d-flex">
        <div>
          <h1 class="mb-1">{{ $article->title }}</h1>
          <p class="text-muted">
            作者：{{ $article->user->name }}
            @if($article->category)
                | 分類：<a href="{{ route('articles.byCategory', $article->category) }}">{{ $article->category->name }}</a>
            @endif
          </p>
          <p>
            標籤：
            @forelse($article->tags as $tag)
                <a href="{{ route('articles.byTag', $tag) }}" class="badge bg-secondary">{{ $tag->name }}</a>
            @empty
                <span class="text-muted">無</span>
            @endforelse
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
    </div>

    <div class="col-md-3">
      @include('partials.sidebar', [
          'categories' => \App\Models\Category::orderBy('id')->get(),
          'tags' => \App\Models\Tag::orderBy('name')->get(),
          'selectedCategory' => $selectedCategory ?? null,
          'selectedTag' => $selectedTag ?? null
      ])
    </div>
  </div>
</div>
@endsection
