@props(['title', 'categories', 'counties', 'cities', 'transaction_types'])

<nav id="store" class="w-full z-30 top-0 px-6 py-1">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3 relative">
        <h2 class="uppercase tracking-wide font-bold text-gray-800 text-xl ">
            {{ $title }}
        </h2>

        <div class="flex items-center" id="store-nav-content">
            <div class="py-2 w-full max-h-52 left-0">
                <x-search-dropdown :results="$categories" field="category" label="Categories"></x-search-dropdown>
                <x-search-dropdown :results="$transaction_types" field="transaction_type" label="Transaction"></x-search-dropdown>
                <x-search-dropdown :results="$counties" field="county" label="Counties"></x-search-dropdown>
                <x-search-dropdown :results="$cities" field="city" label="Cities"></x-search-dropdown>

                <form method="GET" action="/" class="pl-3 inline-block">
                    <x-form.search-hidden-input field="category"></x-form.search-hidden-input>
                    <x-form.search-hidden-input field="transaction_type"></x-form.search-hidden-input>
                    <x-form.search-hidden-input field="county"></x-form.search-hidden-input>
                    <x-form.search-hidden-input field="city"></x-form.search-hidden-input>
                    <input type="text" id="search" name="search" placeholder="Find something"
                           class="input input-bordered input-sm w-full max-w-xs"
                           value="{{ request('search') }}"
                    >
                </form>
            </div>
        </div>
    </div>
</nav>
