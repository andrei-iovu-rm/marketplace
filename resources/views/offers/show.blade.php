<x-layout>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="bg-white overflow-hidden sm:rounded-lg">
        <div class="px-4 pt-5 sm:px-6">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline border-gray-200 gap-2">Back</a>
        </div>
        <div class="px-4 py-5 sm:px-6">
            <x-hero :offer="$offer"></x-hero>
        </div>
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Description</h3>
            <div class="mt-1 text-sm text-gray-500">
                {!! $offer->excerpt !!}
            </div>
        </div>
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Details</h3>
            <div class="mt-1 text-sm text-gray-500">
                {!! $offer->body !!}
            </div>
        </div>
        <div class="border-t border-gray-200">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Full Specs</h3>
            </div>
            <dl class="px-4 py-5 sm:px-6">
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">County</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">{{ ucwords($offer->county->name) }}</dd>
                    <dt class="text-sm font-medium text-gray-500">City</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">{{ ucwords($offer->city->name) }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Area</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">{{ ucwords($offer->area->name) }}</dd>
                    <dt class="text-sm font-medium text-gray-500">Transaction</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">{{ ucwords($offer->transaction_type->name) }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">No. of Rooms</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">{{ $offer->rooms }}</dd>
                    <dt class="text-sm font-medium text-gray-500">Surface</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">{{ $offer->surface }} m<sup>2</sup></dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Baths</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">{{ $offer->baths }}</dd>
                    <dt class="text-sm font-medium text-gray-500">Added By</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">{{ $offer->author->name }}</dd>
                </div>
            </dl>
        </div>
    </div>

</x-layout>
