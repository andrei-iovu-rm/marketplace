@props(['offers'])

@if ($offers->count())
    <div class="lg:grid lg:grid-cols-12 md:grid md:grid-cols-12 sm:grid sm:grid-cols-6">
        @foreach($offers as $offer)
            <div class=" {{ $loop->iteration < 4 ? 'lg:col-span-4 md:col-span-4 sm:col-span-3' : 'col-span-3' }} p-6 flex flex-col">
                <a href="/offers/{{ $offer->slug }}">
                    @if($offer->thumbnail)
                        <img class="hover:grow hover:shadow-lg" src="{{ asset('storage/' . $offer->thumbnail) }}" width="{{ $loop->iteration < 4 ? 464 : 336 }}"  height="{{ $loop->iteration < 4 ? 348 : 224 }}">
                    @else
                        <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w={{ $loop->iteration < 4 ? 464 : 336 }}&h={{ $loop->iteration < 4 ? 348 : 224 }}&q=80">
                    @endif
                </a>
                <div class="grid grid-cols-12">
                    <x-offer-card-description :offer="$offer" class="col-span-11">
                        <a href="/offers/{{ $offer->slug }}">{{ ucwords($offer->title) }}</a>
                    </x-offer-card-description>
                    @auth
                        <div class="pt-3 col-span-1">
                            <a href="#">
                                <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                                </svg>
                            </a>
                        </div>
                    @endauth
                </div>
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
