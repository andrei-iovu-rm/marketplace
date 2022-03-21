<div>
    @auth
        <section id="newsletter" class="bg-white py-8">
            <div class="container py-8 px-6 mx-auto">
                <h3 class="uppercase tracking-wide font-bold text-gray-800 text-xl mb-8">
                    @if($subscribed)
                        You can opt out from receiving the latest offers
                    @else
                        Stay in touch with the latest offers
                    @endif
                </h3>
                <div class="mt-10 text-center">
                    <form wire:submit.prevent="submitForm" method="POST" action="#" class="text-sm">
                        @csrf
                        @if($subscribed)
                            @method('DELETE')
                        @endif
                        <p class="leading-10 inline-block">{{ $subscribed ? 'Promise to never send emails anymore. No bugs.' : 'Promise to keep the inbox clean. No bugs.' }}</p>
                        <div class="relative inline-block rounded-full">
                            <input id="email" name="email" type="text" hidden value="{{ auth()->user()->email }}" class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">

                            <button type="submit" class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-xl text-md font-semibold text-white uppercase py-3 px-8 leading-5">
                                <svg class="h-6 w-6 fill-current text-white-500 inline-block" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  viewBox="0 0 19 19">
                                    <path d="M17.388,4.751H2.613c-0.213,0-0.389,0.175-0.389,0.389v9.72c0,0.216,0.175,0.389,0.389,0.389h14.775c0.214,0,0.389-0.173,0.389-0.389v-9.72C17.776,4.926,17.602,4.751,17.388,4.751 M16.448,5.53L10,11.984L3.552,5.53H16.448zM3.002,6.081l3.921,3.925l-3.921,3.925V6.081z M3.56,14.471l3.914-3.916l2.253,2.253c0.153,0.153,0.395,0.153,0.548,0l2.253-2.253l3.913,3.916H3.56z M16.999,13.931l-3.921-3.925l3.921-3.925V13.931z"></path>
                                </svg>
                                {{ $subscribed ? 'Unsubscribe' : 'Subscribe' }}
                            </button>
                        </div>
                        @error('email')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
        </section>
        <x-flash></x-flash>
    @endauth
</div>
