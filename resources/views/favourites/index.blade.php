<x-layout>
    <x-admin.layout heading="Favourites">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($favourites as $favourite)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="/offers/{{ $favourite->offer->slug }}">
                                            @if($favourite->offer->thumbnail)
                                                <img class="hover:grow hover:shadow-lg" src="{{ asset('storage/' . $favourite->offer->thumbnail) }}" width="336"  height="224">
                                            @else
                                                <img class="hover:grow hover:shadow-lg" src="https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=336&h=224&q=80">
                                            @endif
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-offer-card-description :offer="$favourite->offer" class="col-span-11">
                                            <a href="/offers/{{ $favourite->offer->slug }}">{{ ucwords($favourite->offer->title) }}</a>
                                        </x-offer-card-description>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form method="POST" action="/favourite/{{ $favourite->offer_id }}">
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
                {{ $favourites->links() }}
            </div>
        </div>
    </x-admin.layout>
</x-layout>>
