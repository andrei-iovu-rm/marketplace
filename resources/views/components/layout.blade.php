<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace Demo</title>
    <meta name="description" content="Free open source Tailwind CSS Store template">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,store template, shop layout, minimal, monochrome, minimalistic, theme, nordic">

    <link href="/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">

    <style>
        html{
            scroll-behavior: smooth;
        }
        .work-sans {
            font-family: 'Work Sans', sans-serif;
        }

        #menu-toggle:checked + #menu {
            display: block;
        }

        .hover\:grow {
            transition: all 0.3s;
            transform: scale(1);
        }

        .hover\:grow:hover {
            transform: scale(1.02);
        }
    </style>

    @livewireStyles
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">

<x-layout.main-nav>
    <x-layout.user-nav></x-layout.user-nav>
</x-layout.main-nav>

<section class="bg-white py-8">
    <div class="container mx-auto">
        {{ $slot }}
    </div>
</section>

@auth
<section id="newsletter" class="bg-white py-8">
    <div class="container py-8 px-6 mx-auto">
        @inject('newsletter', 'App\Services\NewsletterInterface')
        <h3 class="uppercase tracking-wide font-bold text-gray-800 text-xl mb-8">
            @subscribed($newsletter)
                You can opt out from receiving the latest offers
            @else
                Stay in touch with the latest offers
            @endsubscribed
        </h3>
        <div class="mt-10 text-center">
            <form method="POST" action="/newsletter" class="text-sm">
                @csrf
                @subscribed($newsletter)
                    @method('DELETE')
                    <p class="leading-10 inline-block">Promise to never send emails anymore. No bugs.</p>
                    <div class="relative inline-block rounded-full">
                        <input id="email" name="email" type="text" hidden value="{{ auth()->user()->email }}" class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">

                        <button type="submit" class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-xl text-md font-semibold text-white uppercase py-3 px-8 leading-5">
                            <svg class="h-6 w-6 fill-current text-white-500 inline-block" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  viewBox="0 0 19 19">
                                <path d="M17.388,4.751H2.613c-0.213,0-0.389,0.175-0.389,0.389v9.72c0,0.216,0.175,0.389,0.389,0.389h14.775c0.214,0,0.389-0.173,0.389-0.389v-9.72C17.776,4.926,17.602,4.751,17.388,4.751 M16.448,5.53L10,11.984L3.552,5.53H16.448zM3.002,6.081l3.921,3.925l-3.921,3.925V6.081z M3.56,14.471l3.914-3.916l2.253,2.253c0.153,0.153,0.395,0.153,0.548,0l2.253-2.253l3.913,3.916H3.56z M16.999,13.931l-3.921-3.925l3.921-3.925V13.931z"></path>
                            </svg>
                            Unsubscribe
                        </button>
                    </div>
                @else
                    <p class="leading-10 inline-block">Promise to keep the inbox clean. No bugs.</p>
                    <div class="relative inline-block rounded-full">
                        <input id="email" name="email" type="text" hidden value="{{ auth()->user()->email }}" class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">

                        <button type="submit" class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-xl text-md font-semibold text-white uppercase py-3 px-8 leading-5">
                            <svg class="h-6 w-6 fill-current text-white-500 inline-block" xmlns="http://www.w3.org/2000/svg" width="24" height="24"  viewBox="0 0 19 19">
                                <path d="M17.388,4.751H2.613c-0.213,0-0.389,0.175-0.389,0.389v9.72c0,0.216,0.175,0.389,0.389,0.389h14.775c0.214,0,0.389-0.173,0.389-0.389v-9.72C17.776,4.926,17.602,4.751,17.388,4.751 M16.448,5.53L10,11.984L3.552,5.53H16.448zM3.002,6.081l3.921,3.925l-3.921,3.925V6.081z M3.56,14.471l3.914-3.916l2.253,2.253c0.153,0.153,0.395,0.153,0.548,0l2.253-2.253l3.913,3.916H3.56z M16.999,13.931l-3.921-3.925l3.921-3.925V13.931z"></path>
                            </svg>
                            Subscribe
                        </button>
                    </div>
                @endsubscribed
                @error('email')
                <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </form>
        </div>
    </div>
</section>
@endauth

<footer class="container mx-auto bg-white py-8 border-t border-gray-400">
    <div class="container flex px-3 py-8 ">
        <div class="w-full mx-auto flex flex-wrap">
            <div class="flex w-full lg:w-1/2 ">
                <div class="px-3 md:px-0">
                    <h3 class="font-bold text-gray-900">About</h3>
                    <p class="py-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus commodo nec id erat. Suspendisse consectetur dapibus velit ut lacinia.
                    </p>
                </div>
            </div>
            <div class="flex w-full lg:w-1/2 lg:justify-end lg:text-right">
                <div class="px-3 md:px-0">
                    <h3 class="font-bold text-gray-900">Social</h3>
                    <ul class="list-reset items-center pt-3">
                        <li>
                            <a class="inline-block no-underline hover:text-black hover:underline py-1" href="#">Add social links</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<x-flash></x-flash>
@livewireScripts
</body>

</html>
