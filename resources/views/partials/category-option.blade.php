<!-- It always seems impossible until it is done. - Nelson Mandela -->
<option value="">（未分類）</option>
@foreach($categories as $cat)
  <option value="{{ $cat->id }}" 
    {{ (old('category_id', $selected ?? null) == $cat->id) ? 'selected' : '' }}>
    {{ $cat->name }}
  </option>
@endforeach
