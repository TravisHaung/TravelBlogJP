<!-- It always seems impossible until it is done. - Nelson Mandela -->
<option value="{{ $category->id }}" 
  {{ $category->id == $selected ? 'selected' : '' }}>
  {{ $prefix . $category->name }}
</option>

@if ($category->children && $category->children->count())
  @foreach ($category->children as $child)
    @include('partials.category-option', [
        'category' => $child,
        'prefix' => $prefix . '—',
        'selected' => $selected
    ])
  @endforeach
@endif
