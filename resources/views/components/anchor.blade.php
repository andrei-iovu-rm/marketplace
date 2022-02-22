@props(['results', 'field', 'badge' => false])

@php
    $class = 'no-underline border-b border-gray-600 hover:text-black hover:border-black';
    if ($badge){
        $class = '';
    }
@endphp

<a href="/?{{ $field }}={{ $results->slug }}&{{ http_build_query(request()->except($field, 'page')) }}" class="{{ $class }}">
    @if($badge)
        <span class="badge badge-outline">
    @endif
    {{ ucwords($results->name) }}
    @if($badge)
        </span>
    @endif
</a>
