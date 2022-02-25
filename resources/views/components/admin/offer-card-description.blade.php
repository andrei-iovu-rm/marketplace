@props(['offer'])

<div {{ $attributes(['class' => '']) }}>
    <p class="text-sm font-medium text-gray-900">{{ $slot }}</p>
    <ul>
        <li class="pt-1 text-sm font-medium text-gray-900">@money($offer->price) EUR</li>
        <li class="text-sm text-gray-500">{{ $offer->rooms }} {{ $offer->rooms > 1 ? 'rooms' : 'room' }}, {{ $offer->surface }} m<sup>2</sup></li>
    </ul>
</div>
