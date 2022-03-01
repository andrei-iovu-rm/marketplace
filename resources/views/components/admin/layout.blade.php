@props(['heading'])

<div class="flex px-6">
    <aside class="w-48 flex-shrink-0 p-4 border-r">
        <h3 class="uppercase font-bold mb-4">Admin</h3>
        <ul>
            @admin
                <li><a href="/admin/offers" class="{{ request()->is('admin/offers') ? 'text-blue-500' : '' }}">All Offers</a></li>
                <li><a href="/admin/offers/create" class="{{ request()->is('admin/offers/create') ? 'text-blue-500' : '' }}">New Offer</a></li>
            @endadmin
            <li><a href="/favourites" class="{{ request()->is('favourites') ? 'text-blue-500' : '' }}">Favourites</a></li>
        </ul>
    </aside>

    <main class="flex-1 p-4">
        <h3 class="uppercase font-bold mb-4">{{ $heading }}</h3>
        <div>
            {{ $slot }}
        </div>
    </main>
</div>
