<x-layout>
    <x-carousel :offers="$featured"></x-carousel>
    <section class="bg-white py-8">
        <div class="container mx-auto flex items-center flex-wrap pt-4">
            <x-search-simple-nav title="The latests offers" :categories="$categories" :counties="$counties" :cities="$cities" :transaction_types="$transaction_types"></x-search-simple-nav>
            <x-offers-grid :offers="$offers"></x-offers-grid>
        </div>
    </section>
</x-layout>
