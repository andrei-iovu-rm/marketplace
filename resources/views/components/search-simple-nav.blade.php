@props(['title', 'categories', 'counties', 'cities', 'transaction_types'])

<nav id="store" class="w-full z-30 top-0 px-6 py-1">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3 relative">
        <h2 class="uppercase tracking-wide font-bold text-gray-800 text-xl ">
            {{ $title }}
        </h2>

        <div class="flex items-center" id="store-nav-content">
            <div class="py-2 w-full max-h-52 left-0">
                <x-form.select wire:model="category" :results="$categories" field="category" label="Categories" search="true"></x-form.select>
                <x-form.select wire:model="transaction_type" :results="$transaction_types" field="transaction_type" label="Transaction" search="true"></x-form.select>
                <x-form.select wire:model="county" :results="$counties" field="county" label="Counties" search="true"></x-form.select>
                <x-form.select wire:model="city" :results="$cities" field="city" label="Cities" search="true"></x-form.select>

                <div class="pl-3 inline-block">
                    <input wire:model="search" type="text" id="search" name="search" placeholder="Find something"
                           class="input input-bordered input-sm w-full max-w-xs"
                           value="{{ request('search') }}"
                    >
                </div>
            </div>
        </div>
    </div>
</nav>
