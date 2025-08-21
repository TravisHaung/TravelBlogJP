@csrf
    <!-- It is never too late to be what you might have been. - George Eliot -->
<div class="mb-3">
  <label class="form-label">標題</label>
  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
         value="{{ old('title', $article->title ?? '') }}" required maxlength="150">
  @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label for="category_id" class="form-label">分類</label>
  <select name="category_id" id="category_id" class="form-select">
    <option value="">（未分類）</option>
    @foreach ($categories as $category)
      @include('partials.category-option', [
          'category' => $category,
          'prefix' => '',
          'selected' => old('category_id', $article->category_id ?? '')
      ])
    @endforeach
  </select>
</div>

<div class="mb-3">
  <label class="form-label">內容</label>
  <textarea name="body" rows="8" class="form-control @error('body') is-invalid @enderror" required>{{ old('body', $article->body ?? '') }}</textarea>
  @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<!--
<div class="mb-3">
  <label class="form-label">發佈時間（可留空）</label>
  <input type="datetime-local" name="published_at" class="form-control @error('published_at') is-invalid @enderror" 
         value="{{ old('published_at', optional($article->published_at ?? null)->format('Y-m-d\\TH:i')) }}">
  @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
-->

<div class="mb-3">
  <label class="form-label">標籤</label>
  <div class="d-flex flex-wrap">
    @foreach($tags as $tag)
      <div class="form-check me-3">
        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}"
          class="form-check-input"
          {{ in_array($tag->id, old('tags', isset($article) ? $article->tags->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
        <label for="tag{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
      </div>
    @endforeach
  </div>
</div>