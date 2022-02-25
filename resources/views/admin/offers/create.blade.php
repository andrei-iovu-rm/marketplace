<x-layout>
    <x-admin.layout heading="New Offer">
        <div class="pb-6">
            <a href="/admin/offers" class="btn btn-sm btn-outline border-gray-200 gap-2">Back</a>
        </div>
        <form method="POST" action="/admin/offers" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" :value="old('title')"></x-form.input>
            <x-form.input name="slug" :value="old('slug')"></x-form.input>
            <x-form.input name="thumbnail" type="file" :value="old('thumbnail')"></x-form.input>
            <x-form.textarea name="excerpt">{{ old('excerpt') }}</x-form.textarea>
            <x-form.textarea name="body">{{ old('body') }}</x-form.textarea>

            <x-form.field>
                <x-form.label name="category"></x-form.label>
                <x-form.select :results="\App\Models\Category::all()" field="category_id"></x-form.select>
                <x-form.error name="category_id"></x-form.error>
            </x-form.field>

            <x-form.field>
                <x-form.label name="transaction"></x-form.label>
                <x-form.select :results="\App\Models\TransactionType::all()" field="transaction_type_id"></x-form.select>
                <x-form.error name="transaction_type_id"></x-form.error>
            </x-form.field>

            <x-form.field>
                <x-form.label name="county"></x-form.label>
                <x-form.select :results="\App\Models\County::all()" field="county_id"></x-form.select>
                <x-form.error name="county_id"></x-form.error>
            </x-form.field>

            <x-form.field>
                <x-form.label name="city (county)"></x-form.label>
                <x-form.select :results="\App\Models\City::all()" field="city_id" foreignField="county"></x-form.select>
                <x-form.error name="city_id"></x-form.error>
            </x-form.field>

            <x-form.field>
                <x-form.label name="area (city)"></x-form.label>
                <x-form.select :results="\App\Models\Area::all()" field="area_id" foreignField="city"></x-form.select>
                <x-form.error name="area_id"></x-form.error>
            </x-form.field>

            <x-form.input name="price" :value="old('price')" type="number"></x-form.input>
            <x-form.input name="surface" :value="old('surface')" type="float"></x-form.input>
            <x-form.input name="rooms" :value="old('rooms')" type="number"></x-form.input>
            <x-form.input name="baths" :value="old('baths')" type="number"></x-form.input>
            <x-form.checkbox name="featured" :value="old('featured')" :checkbox="old('featured')"></x-form.checkbox>

            <x-form.button>Create</x-form.button>
        </form>
    </x-admin.layout>
</x-layout>
