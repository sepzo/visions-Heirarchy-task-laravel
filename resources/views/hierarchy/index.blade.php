<h1>Hierarchy Tree</h1>

<ul>
    @foreach ($hierarchies as $hierarchy)
        @if ($hierarchy->parent_id === null)
            <li>{{ $hierarchy->name }}
                @if($hierarchy->children->count())
                    <ul>
                        @include('hierarchy.child', ['children' => $hierarchy->children])
                    </ul>
                @endif
            </li>
        @endif
    @endforeach
</ul>

<form action="{{ route('hierarchy.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Hierarchy Name">

    <select name="parent_id">
        <option value="">No Parent</option>
        @foreach ($hierarchies as $hierarchy)
            @if ($hierarchy->parent_id === null)
                <option value="{{ $hierarchy->id }}">{{ $hierarchy->name }}</option>
                @if ($hierarchy->children->count() > 0)
                    @include('hierarchy.child-select', ['children' => $hierarchy->children])
                @endif
            @endif
        @endforeach
    </select>

    <button type="submit">Add Hierarchy</button>
</form>