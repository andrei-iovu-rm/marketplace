@props(['offer', 'favourites'])

<section class="w-full mx-auto bg-nordic-gray-light flex pt-12 md:pt-0 md:items-center bg-cover bg-right" style="max-width:1600px; height: 32rem;
    @if($offer->thumbnail)
        background-image: url({{ asset('storage/' . $offer->thumbnail) }});
    @else
        background-image: url('https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');
    @endif
">
    <div class="container mx-auto">
        <div class="flex flex-col w-full lg:w-1/3 md:w-1/2 justify-center items-start px-6 tracking-wide rounded bg-white opacity-60">
            <x-offer-card-description classTitle="text-black text-2xl my-4" classPrice="text-black text-xl" :offer="$offer">
                {{ ucwords($offer->title) }}
            </x-offer-card-description>
            <livewire:favourites.create :offer="$offer" :favourites="$favourites" />
            <p class="text-sm leading-relaxed mb-4 text-gray-700">Last changed: <time>{{ $offer->updated_at->diffForHumans() }}</time></p>
        </div>
    </div>
</section>
