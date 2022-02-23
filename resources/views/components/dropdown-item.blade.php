@props(['active' => false])

@php
    $class = '';
    if($active){
        $class = 'bg-gray-300';
    }
@endphp

<li>
    <a {{ $attributes(['class' => $class]) }}>
        {{ $slot }}
    </a>
</li>
