@foreach ($children as $child)
    <li>{{ $child->name }}
        @if($child->children->count())
            <ul>
                @include('hierarchy.child', ['children' => $child->children])
            </ul>
        @endif
    </li>
@endforeach