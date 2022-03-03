<div>
    <form wire:submit.prevent="submitForm" method="POST" action="#" enctype="multipart/form-data">
        @csrf

        <x-form.input wire:model="title" name="title" :value="old('title')"></x-form.input>
        <x-form.input wire:model="slug" name="slug" :value="old('slug')"></x-form.input>
        <div class="flex mt-6">
            <div class="flex-1">
                <x-form.input wire:model="thumbnail" name="thumbnail" type="file" :value="old('thumbnail')"></x-form.input>
            </div>

            <div>
                <svg wire:loading wire:target="thumbnail" class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>

            @if($thumbnail)
                <img src="{{ $tempUrl }}" alt="" class="rounded-xl ml-6" width="336">
            @endif
        </div>
        <x-form.textarea wire:model="excerpt" name="excerpt">{{ old('excerpt') }}</x-form.textarea>
        <x-form.textarea wire:model="body" name="body">{{ old('body') }}</x-form.textarea>

        <x-form.field>
            <x-form.label name="category"></x-form.label>
            <x-form.select wire:model="category_id" :results="$categories" field="category_id"></x-form.select>
            <x-form.error name="category_id"></x-form.error>
        </x-form.field>

        <x-form.field>
            <x-form.label name="transaction"></x-form.label>
            <x-form.select wire:model="transaction_type_id" :results="$transaction_types" field="transaction_type_id"></x-form.select>
            <x-form.error name="transaction_type_id"></x-form.error>
        </x-form.field>

        <x-form.field>
            <x-form.label name="county"></x-form.label>
            <x-form.select wire:model="county_id" :results="$counties" field="county_id"></x-form.select>
            <x-form.error name="county_id"></x-form.error>
        </x-form.field>

        <x-form.field>
            <x-form.label name="city (county)"></x-form.label>
            <x-form.select wire:model="city_id" :results="$cities" field="city_id" foreignField="county"></x-form.select>
            <x-form.error name="city_id"></x-form.error>
        </x-form.field>

        <x-form.field>
            <x-form.label name="area (city)"></x-form.label>
            <x-form.select wire:model="area_id" :results="$areas" field="area_id" foreignField="city"></x-form.select>
            <x-form.error name="area_id"></x-form.error>
        </x-form.field>

        <x-form.input wire:model="price" name="price" :value="old('price')" type="number"></x-form.input>
        <x-form.input wire:model="surface" name="surface" :value="old('surface')" type="float"></x-form.input>
        <x-form.input wire:model="rooms" name="rooms" :value="old('rooms')" type="number"></x-form.input>
        <x-form.input wire:model="baths" name="baths" :value="old('baths')" type="number"></x-form.input>
        <x-form.checkbox wire:model="featured" name="featured" :value="old('featured')" :checkbox="old('featured')"></x-form.checkbox>

        <x-form.button>Create</x-form.button>
    </form>
    <x-flash></x-flash>
</div>
