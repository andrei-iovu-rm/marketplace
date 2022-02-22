@props(['offers'])

@if ($offers->count())
    <div class="lg:grid lg:grid-cols-12 md:grid md:grid-cols-12 sm:grid sm:grid-cols-6">
        @foreach($offers as $offer)
            <div class=" {{ $loop->iteration < 4 ? 'lg:col-span-4 md:col-span-4 sm:col-span-3' : 'col-span-3' }} p-6 flex flex-col">
                <a href="/offers/{{ $offer->slug }}">
                    <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w={{ $loop->iteration < 4 ? 464 : 400 }}&h={{ $loop->iteration < 4 ? 464 : 400 }}&q=80">
                </a>
                <x-offer-card-description :offer="$offer"></x-offer-card-description>
            </div>
        @endforeach
    </div>
    <div class="w-full px-6 py-1 mt-2">
        {{ $offers->links() }}
    </div>
@else
    <div class="py-8 px-6">
        <p class="mt-8 mb-8">
            No offers yet. Please check back later.
        </p>
    </div>
@endif
