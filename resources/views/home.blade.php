<x-layout>
    <x-carousel :offers="$featured"></x-carousel>
    <x-offers-grid :offers="$offers" title="The latests offers" :categories="$categories" :counties="$counties" :cities="$cities" :transaction_types="$transaction_types"></x-offers-grid>
</x-layout>
