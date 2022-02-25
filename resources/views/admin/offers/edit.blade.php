<x-layout>
    <x-admin.layout heading="Edit Offer: {{ $offer->title }}">
        <div class="pb-6">
            <a href="/admin/offers" class="btn btn-sm btn-outline border-gray-200 gap-2">Back</a>
        </div>
        <form method="POST" action="/admin/offers/{{ $offer->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $offer->title)"></x-form.input>
            <x-form.input name="slug" :value="old('slug', $offer->slug)"></x-form.input>
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $offer->thumbnail)"></x-form.input>
                </div>
                <img src="{{ asset('storage/' . $offer->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">
            </div>
            <x-form.textarea name="excerpt">{{ old('excerpt', $offer->excerpt) }}</x-form.textarea>
            <x-form.textarea name="body">{{ old('body', $offer->body) }}</x-form.textarea>

            <x-form.field>
                <x-form.label name="category"></x-form.label>
                <x-form.select :results="\App\Models\Category::all()" field="category_id" :defaultValue="$offer->category_id"></x-form.select>
                <x-form.error name="category_id"></x-form.error>
            </x-form.field>

            <x-form.field>
                <x-form.label name="transaction"></x-form.label>
                <x-form.select :results="\App\Models\TransactionType::all()" field="transaction_type_id" :defaultValue="$offer->transaction_type_id"></x-form.select>
                <x-form.error name="transaction_type_id"></x-form.error>
            </x-form.field>

            <x-form.field>
                <x-form.label name="county"></x-form.label>
                <x-form.select :results="\App\Models\County::all()" field="county_id" :defaultValue="$offer->county_id"></x-form.select>
                <x-form.error name="county_id"></x-form.error>
            </x-form.field>

            <x-form.field>
                <x-form.label name="city (county)"></x-form.label>
                <x-form.select :results="\App\Models\City::all()" field="city_id" :defaultValue="$offer->city_id" foreignField="county"></x-form.select>
                <x-form.error name="city_id"></x-form.error>
            </x-form.field>

            <x-form.field>
                <x-form.label name="area (city)"></x-form.label>
                <x-form.select :results="\App\Models\Area::all()" field="area_id" :defaultValue="$offer->area_id" foreignField="city"></x-form.select>
                <x-form.error name="area_id"></x-form.error>
            </x-form.field>

            <x-form.input name="price" :value="old('price', $offer->price)" type="number"></x-form.input>
            <x-form.input name="surface" :value="old('surface', $offer->surface)" type="float"></x-form.input>
            <x-form.input name="rooms" :value="old('rooms', $offer->rooms)" type="number"></x-form.input>
            <x-form.input name="baths" :value="old('baths', $offer->baths)" type="number"></x-form.input>
            <x-form.checkbox name="featured" :value="old('featured', $offer->featured)" :checkbox="$offer->featured"></x-form.checkbox>

            <x-form.button>Update</x-form.button>
        </form>
    </x-admin.layout>
</x-layout>
