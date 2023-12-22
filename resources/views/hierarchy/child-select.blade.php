@foreach ($children as $child)
    <option value="{{ $child->id }}">{{ $child->name }}</option>
    @if ($child->children->count() > 0)
        @include('hierarchy.child-select', ['children' => $child->children])
    @endif
@endforeach
