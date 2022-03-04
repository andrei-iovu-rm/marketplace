<div>
    <form wire:submit.prevent="submitForm" method="POST" action="#" class="mt-10">
        @csrf

        <x-form.input wire:model.defer="name" name="name" :value="old('name')" required></x-form.input>
        <x-form.input wire:model.defer="username" name="username" :value="old('username')" required></x-form.input>
        <x-form.input wire:model.defer="email" name="email" :value="old('email')" type="email" required></x-form.input>
        <x-form.input wire:model.defer="password" name="password" :value="old('password')" type="password" autocomplete="new-password" required></x-form.input>

        <x-form.field>
            <x-form.label name="role"></x-form.label>
            <x-form.select-enum wire:model.defer="role" :results="$roles" field="role" required></x-form.select-enum>
            <x-form.error name="role"></x-form.error>
        </x-form.field>

        <x-form.button>Submit</x-form.button>
    </form>
</div>
