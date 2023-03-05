<!-- Displaying the current category -->
<option value="{{ $category->id }}" @if($category->id == $parent_id) {{'selected'}} @endif >
    {{$level}}{{ $category->name}}
</option>
<!-- If category has children -->
@if (count($category->allLevelChildrenWithSubChild) > 0)
    @php $level = $level.' -- ' @endphp
    @foreach ($category->allLevelChildrenWithSubChild as $sub)
        <!-- Call this blade file again (recursive) and pass the current subcategory to it -->
        @include('admin.categories.categories', ['parent_id' => $parent_id,'category' => $sub, $level])
    @endforeach
@endif
