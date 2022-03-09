<div>
    <x-carousel :offers="$featured" :favourites="$favourites"></x-carousel>
    <x-search-simple-nav title="The latests offers" :categories="$categories" :counties="$counties" :cities="$cities" :transaction_types="$transaction_types"></x-search-simple-nav>
    <x-offers-grid :offers="$offers" :favourites="$favourites"></x-offers-grid>
</div>
