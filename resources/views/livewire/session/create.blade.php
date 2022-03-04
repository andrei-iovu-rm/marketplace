<div>
    <form wire:submit.prevent="submitForm" method="POST" action="#" class="mt-10">
        @csrf

        <x-form.input wire:model.defer="email" name="email" type="email" autocomplete="email"></x-form.input>
        <x-form.input wire:model.defer="password" name="password" type="password" autocomplete="current-password"></x-form.input>
        <x-form.button>Log In</x-form.button>
    </form>
</div>
