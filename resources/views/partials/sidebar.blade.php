<div class="card mb-4">
    <!-- An unexamined life is not worth living. - Socrates -->
    <div class="card-header">分類</div>
    <div class="list-group list-group-flush">
        @foreach($categories as $cat)
            <a href="{{ route('articles.byCategory', $cat) }}"
               class="list-group-item list-group-item-action
               {{ isset($selectedCategory) && $selectedCategory->id === $cat->id ? 'active' : '' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">標籤</div>
    <div class="card-body">
        @foreach($tags as $tag)
            <a href="{{ route('articles.byTag', $tag) }}"
               class="badge bg-secondary mb-1 me-1
               {{ isset($selectedTag) && $selectedTag->id === $tag->id ? 'bg-primary' : '' }}">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>
</div>
