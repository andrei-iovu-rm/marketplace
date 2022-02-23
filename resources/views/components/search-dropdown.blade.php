@props(['results', 'field', 'label'])

<div class="indicator">
    @php
        $selected = '';
        foreach($results as $result){
            if(request($field) == $result->slug){
                $selected = ucwords($result->name);
                break;
            };
        }
    @endphp
    <div class="dropdown dropdown-hover">
        <label tabindex="0" class="m-1 btn btn-sm btn-outline border-gray-200 gap-2">
            {{ $label }}
            @if ($selected != '')
                <div class="badge">{{ $selected }}</div>
            @endif
        </label>
        <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
            <x-dropdown-item href="/?{{ $field }}=&{{ http_build_query(request()->except($field, 'page')) }}">All</x-dropdown-item>
            @foreach($results as $result)
                <x-dropdown-item href="/?{{ $field }}={{ $result->slug }}&{{ http_build_query(request()->except($field, 'page')) }}" :active="(request($field) == $result->slug)">
                    {{ ucwords($result->name) }}
                </x-dropdown-item>
            @endforeach
        </ul>
    </div>
</div>
