<?php

namespace App\Http\Livewire\Register;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;
    public $username;
    public $password;
    public $role;

    protected $rules = [];

    public function render()
    {
        return view('livewire.register.create', [
            'roles' => UserRole::cases(),
        ]);
    }

    public function submitForm()
    {
        $user = User::create($this->getAttributes());
        auth()->login($user);

        session()->flash('success', 'Your account has been created!');

        return redirect('/');
    }

    private function getAttributes()
    {
        $this->validateUser();

        $attributes = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        ];

        return $attributes;
    }

    private function validateUser()
    {
        $this->rules = [
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username'), 'regex:/^[\w\d]+$/i'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:7', 'max:255'],
            'role' => ['required', (new Enum(UserRole::class))],
        ];

        $this->validate();
    }
}
