@props(['admin' => false])

@php
    $class = 'bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500';
    if($admin){
        $class = 'bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600';
    }
@endphp

<x-form.field>
    <button type="submit" class="{{ $class }}">
        {{ $slot }}
    </button>
</x-form.field>
