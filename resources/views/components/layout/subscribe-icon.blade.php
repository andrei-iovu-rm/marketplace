@props(['active' => false])

@php
    $class = 'text-gray-500 hover:text-black';
    if($active){
        $class = 'text-red-500 hover:text-red';
    }
@endphp

<a class="pl-3 inline-block no-underline" href="#newsletter">
    <svg class="h-6 w-6 fill-current {{ $class }}" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  viewBox="0 0 19 19">
        <path d="M17.388,4.751H2.613c-0.213,0-0.389,0.175-0.389,0.389v9.72c0,0.216,0.175,0.389,0.389,0.389h14.775c0.214,0,0.389-0.173,0.389-0.389v-9.72C17.776,4.926,17.602,4.751,17.388,4.751 M16.448,5.53L10,11.984L3.552,5.53H16.448zM3.002,6.081l3.921,3.925l-3.921,3.925V6.081z M3.56,14.471l3.914-3.916l2.253,2.253c0.153,0.153,0.395,0.153,0.548,0l2.253-2.253l3.913,3.916H3.56z M16.999,13.931l-3.921-3.925l3.921-3.925V13.931z"></path>
    </svg>
</a>
