@props(['offers'])

<style>
    .carousel-open:checked + .carousel-item {
        position: static;
        opacity: 100;
    }

    .carousel-item {
        -webkit-transition: opacity 0.6s ease-out;
        transition: opacity 0.6s ease-out;
    }

    #carousel-1:checked ~ .control-1,
    #carousel-2:checked ~ .control-2,
    #carousel-3:checked ~ .control-3,
    #carousel-4:checked ~ .control-4,
    #carousel-5:checked ~ .control-5 {
        display: block;
    }

    .carousel-indicators {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        bottom: 2%;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 10;
    }

    #carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
    #carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
    #carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet,
    #carousel-4:checked ~ .control-4 ~ .carousel-indicators li:nth-child(4) .carousel-bullet,
    #carousel-5:checked ~ .control-5 ~ .carousel-indicators li:nth-child(5) .carousel-bullet{
        color: #000;
        /*Set to match the Tailwind colour you want the active one to be */
    }
</style>

@if ($offers->count())
    <div class="carousel relative container mx-auto" style="max-width:1600px;">
        <div class="carousel-inner relative overflow-hidden w-full">
            @foreach($offers as $offer)
                <input class="carousel-open" type="radio" id="carousel-{{ $loop->iteration }}" name="carousel" aria-hidden="true" hidden="" {{ $loop->first ? 'checked="checked"' : '' }}>
                <div class="carousel-item absolute opacity-0 min-w-full" style="height:50vh;">
                    <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right" style="background-image: url('https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">

                        <div class="container mx-auto">
                            <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                                <x-offer-card-description classTitle="text-black text-2xl my-4" classPrice="text-black text-xl" :offer="$offer">
                                    <a href="/offers/{{ $offer->slug }}">{{ ucwords($offer->title) }}</a>
                                </x-offer-card-description>
                                <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="/offers/{{ $offer->slug }}">View offer</a>
                            </div>
                        </div>

                    </div>
                </div>
                <label for="carousel-{{ $loop->iteration - 1 < 1 ? $loop->count : $loop->iteration - 1}}" class="prev control-{{ $loop->iteration }} w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
                <label for="carousel-{{ $loop->iteration +1 > $loop->count ? 1 : $loop->iteration + 1}}" class="next control-{{ $loop->iteration }} w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
            @endforeach

            <ol class="carousel-indicators">
                @foreach($offers as $offer)
                    <li class="inline-block mr-3">
                        <label for="carousel-{{ $loop->iteration }}" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
@endif
