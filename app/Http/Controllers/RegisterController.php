<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create', [
            'roles' => UserRole::cases(),
        ]);
    }

    public function store()
    {
        $attributes = request()->validate(
            [
                'name' => 'required|max:255',
                'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username'), 'regex:/^[\w\d]+$/i'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
                'password' => ['required', 'min:7', 'max:255'],
                'role' => ['required', (new Enum(UserRole::class))],
            ]
        );

        $user = User::create($attributes);

        auth()->login($user);

        return redirect('/')->with('success', 'Your account has been created!');
    }
}
