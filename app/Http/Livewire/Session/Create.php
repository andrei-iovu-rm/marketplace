<?php

namespace App\Http\Livewire\Session;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    public $email;
    public $password;

    protected $rules = [];

    public function render()
    {
        return view('livewire.session.create');
    }

    public function submitForm()
    {
        if (!auth()->attempt($this->getAttributes())) {
            throw ValidationException::withMessages(
                [
                    'email' => 'Your provided credentials could not be verified.'
                ]
            );
        }

        session()->regenerate();
        session()->flash('success', 'Welcome back!');

        return redirect('/');
    }

    private function getAttributes()
    {
        $this->validateUser();

        $attributes = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        return $attributes;
    }

    private function validateUser()
    {
        $this->rules = [
            'email' => ['required', 'email'],
            'password' => 'required'
        ];

        $this->validate();
    }
}
