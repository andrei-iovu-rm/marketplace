<div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="mb-2 grid grid-cols-4 gap-4">
                    <div class="col-span-1 items-start">
                        <input wire:model="search" type="search" id="search" name="search" placeholder="Find something"
                               class="input input-bordered input-sm w-full max-w-xs"
                               value="{{ request('search') }}"
                        >
                    </div>
                    <div class="col-span-1 items-start flex">
                        <select wire:model="category" class="select select-bordered select-sm w-full max-w-xs text-sm text-gray-500 font-medium">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1 items-start flex">
                        <select wire:model="transaction_type" class="select select-bordered select-sm w-full max-w-xs text-sm text-gray-500 font-medium">
                            <option value="">Select Transaction</option>
                            @foreach($transactions as $transaction_type)
                                <option value="{{ $transaction_type->id }}">{{ ucwords($transaction_type->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1 items-start flex mt-1">
                        <div class="items-center h-5">
                            <input wire:model="featured" type="checkbox" name="featured" id="featured" class="checkbox">
                        </div>
                        <div class="ml-3 text-sm leading-5 items-center">
                            <label for="featured">Featured?</label>
                        </div>
                    </div>
                </div>
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('title')" class="text-xs font-medium text-gray-500 uppercase tracking-wider">Title</button>
                                    <x-sort-icon field="title" :sortField="$sortField" :sortAsc="$sortAsc"></x-sort-icon>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Localisation</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Edit</span></th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Delete</span></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($offers as $offer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-admin.offer-card-description :offer="$offer">
                                        {{ ucwords($offer->title) }}
                                    </x-admin.offer-card-description>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ ucwords($offer->county->name) }}, {{ ucwords($offer->city->name) }}</div>
                                    <div class="text-sm text-gray-500">{{ ucwords($offer->area->name) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucwords($offer->category->name) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucwords($offer->transaction_type->name) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $offer->featured ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}"> {{ $offer->featured ? 'Yes' : 'No' }} </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="/admin/offers/{{ $offer->id }}/edit" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form method="POST" action="/admin/offers/{{ $offer->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-xs text-gray-400">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="w-full px-6 py-1 mt-2">
            {{ $offers->links() }}
        </div>
    </div>
</div>
