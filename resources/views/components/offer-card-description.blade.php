@props(['offer', 'classTitle' => 'pt-3 flex items-center justify-between', 'classPrice' => 'pt-1 text-gray-900'])

<p class="{{ $classTitle }}">{{ ucwords($offer->title) }}</p>
<ul>
    <li class="{{ $classPrice }}">@money($offer->price) EUR</li>
    <li>{{ $offer->rooms }} {{ $offer->rooms > 1 ? 'rooms' : 'room' }}, {{ $offer->surface }} m<sup>2</sup></li>
    <li>{{ ucwords($offer->county->name) }}, {{ ucwords($offer->city->name) }}, {{ ucwords($offer->area->name) }}</li>
    <li>
        <a href="/?category={{ $offer->category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"><span class="badge badge-outline">{{ ucwords($offer->category->name) }}</span></a>
        <a href="/?transaction_type={{ $offer->transaction_type->slug }}&{{ http_build_query(request()->except('transaction_type', 'page')) }}"><span class="badge badge-outline">{{ ($offer->transaction_type->name) }}</span></a>
    </li>
</ul>
