@props(['offers', 'title', 'categories', 'counties', 'cities', 'transaction_types'])

<section class="bg-white py-8">
    <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
        <nav id="store" class="w-full z-30 top-0 px-6 py-1">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3 relative">
                <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
                    {{ $title }}
                </a>

                <div class="flex items-center" id="store-nav-content">
                    <div class="py-2 w-full max-h-52 left-0">
                        <div class="indicator">
                            @php
                                $label = '';
                                foreach($categories as $category){
                                    if(request('category') == $category->slug){
                                        $label = ucwords($category->name);
                                        break;
                                    };
                                }
                            @endphp
                            <div class="dropdown">
                                <label tabindex="0" class="m-1 btn btn-sm btn-outline border-gray-200 gap-2">
                                    Categories
                                    @if ($label != '')
                                        <div class="badge">{{ $label }}</div>
                                    @endif
                                </label>
                                <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                                    <li><a href="/?category=&{{ http_build_query(request()->except('category', 'page')) }}">All</a></li>
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}" class="{{ request('category') == $category->slug ? 'bg-gray-300' : '' }}">
                                                {{ ucwords($category->name) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="indicator">
                            @php
                                $label = '';
                                foreach($transaction_types as $transaction_type){
                                    if(request('transaction_type') == $transaction_type->slug){
                                        $label = ucwords($transaction_type->name);
                                        break;
                                    };
                                }
                            @endphp
                            <div class="dropdown">
                                <label tabindex="0" class="m-1 btn btn-sm btn-outline border-gray-200 gap-2">
                                    Transaction
                                    @if ($label != '')
                                        <div class="badge">{{ $label }}</div>
                                    @endif
                                </label>
                                <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                                    <li><a href="/?transaction_type=&{{ http_build_query(request()->except('transaction_type', 'page')) }}">All</a></li>
                                    @foreach($transaction_types as $transaction_type)
                                        <li>
                                            <a href="/?transaction_type={{ $transaction_type->slug }}&{{ http_build_query(request()->except('transaction_type', 'page')) }}" class="{{ request('transaction_type') == $transaction_type->slug ? 'bg-gray-300' : '' }}">
                                                {{ ucwords($transaction_type->name) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="indicator">
                            @php
                                $label = '';
                                foreach($counties as $county){
                                    if(request('county') == $county->slug){
                                        $label = ucwords($county->name);
                                        break;
                                    };
                                }
                            @endphp
                            <div class="dropdown">
                                <label tabindex="0" class="m-1 btn btn-sm btn-outline border-gray-200 gap-2">
                                    Counties
                                    @if ($label != '')
                                        <div class="badge">{{ $label }}</div>
                                    @endif
                                </label>
                                <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                                    <li><a href="/?county=&{{ http_build_query(request()->except('county', 'page')) }}">All</a></li>
                                    @foreach($counties as $county)
                                        <li>
                                            <a href="/?county={{ $county->slug }}&{{ http_build_query(request()->except('county', 'page')) }}" class="{{ request('county') == $county->slug ? 'bg-gray-300' : '' }}">
                                                {{ ucwords($county->name) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="indicator">
                            @php
                                $label = '';
                                foreach($cities as $city){
                                    if(request('city') == $city->slug){
                                        $label = ucwords($city->name);
                                        break;
                                    };
                                }
                            @endphp
                            <div class="dropdown">
                                <label tabindex="0" class="m-1 btn btn-sm btn-outline border-gray-200 gap-2">
                                    Cities
                                    @if ($label != '')
                                        <div class="badge">{{ $label }}</div>
                                    @endif
                                </label>
                                <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                                    <li><a href="/?city=&{{ http_build_query(request()->except('city', 'page')) }}">All</a></li>
                                    @foreach($cities as $city)
                                        <li>
                                            <a href="/?city={{ $city->slug }}&{{ http_build_query(request()->except('city', 'page')) }}" class="{{ request('city') == $city->slug ? 'bg-gray-300' : '' }}">
                                                {{ ucwords($city->name) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <form method="GET" action="/" class="pl-3 inline-block">
                            @if (request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if (request('transaction_type'))
                                <input type="hidden" name="transaction_type" value="{{ request('transaction_type') }}">
                            @endif
                            @if (request('county'))
                                <input type="hidden" name="county" value="{{ request('county') }}">
                            @endif
                            @if (request('city'))
                                <input type="hidden" name="city" value="{{ request('city') }}">
                            @endif
                            <input type="text" id="search" name="search" placeholder="Find something"
                                   class="input input-bordered input-sm w-full max-w-xs"
                                   value="{{ request('search') }}"
                            >
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        @if ($offers->count())
            <div class="lg:grid lg:grid-cols-12 md:grid md:grid-cols-12 sm:grid sm:grid-cols-6">
                @foreach($offers as $offer)
                    <div class=" {{ $loop->iteration < 4 ? 'lg:col-span-4 md:col-span-4 sm:col-span-3' : 'col-span-3' }} p-6 flex flex-col">
                        <a href="#">
                            <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w={{ $loop->iteration < 4 ? 464 : 400 }}&h={{ $loop->iteration < 4 ? 464 : 400 }}&q=80">
                            <div class="pt-3 flex items-center justify-between">
                                <p class="">{{ ucwords($offer->title) }}</p>
                                <svg class="h-6 w-6 fill-current text-gray-500 hover:text-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                                </svg>
                            </div>
                            <ul>
                                <li class="pt-1 text-gray-900">@money($offer->price) EUR</li>
                                <li>{{ $offer->rooms }} {{ $offer->rooms > 1 ? 'rooms' : 'room' }}, {{ $offer->surface }} m<sup>2</sup></li>
                                <li>{{ ucwords($offer->county->name) }}, {{ ucwords($offer->city->name) }}, {{ ucwords($offer->area->name) }}</li>
                                <li><span class="badge badge-outline">{{ ucwords($offer->category->name) }}</span> <span class="badge badge-outline">{{ ($offer->transaction_type->name) }}</span></li>
                            </ul>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-8 px-6">
                <p class="mt-8 mb-8">
                    No offers yet. Please check back later.
                </p>
            </div>
        @endif
    </div>
</section>
