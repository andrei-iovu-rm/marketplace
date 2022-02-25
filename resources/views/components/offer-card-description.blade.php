@props(['offer', 'classTitle' => 'pt-3 flex items-center justify-between', 'classPrice' => 'pt-1 text-gray-900'])

<div {{ $attributes(['class' => '']) }}>
    <p class="{{ $classTitle }}">{{ $slot }}</p>
    <ul class="text-gray-700">
        <li class="{{ $classPrice }}">@money($offer->price) EUR</li>
        <li>{{ $offer->rooms }} {{ $offer->rooms > 1 ? 'rooms' : 'room' }}, {{ $offer->surface }} m<sup>2</sup></li>
        <li>
            <x-anchor :results="$offer->county" field="county"></x-anchor>,
            <x-anchor :results="$offer->city" field="city"></x-anchor>,
            {{ ucwords($offer->area->name) }}
        </li>
        <li>
            <x-anchor :results="$offer->category" field="category" badge="true"></x-anchor>
            <x-anchor :results="$offer->transaction_type" field="transaction_type" badge="true"></x-anchor>
        </li>
    </ul>
</div>
