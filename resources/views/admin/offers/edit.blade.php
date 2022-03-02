<x-layout>
    <x-admin.layout heading="Edit Offer: {{ $offer->title }}">
        <div class="pb-6">
            <a href="/admin/offers" class="btn btn-sm btn-outline border-gray-200 gap-2">Back</a>
        </div>
        <livewire:admin.offers.edit :offer="$offer"/>
    </x-admin.layout>
</x-layout>
