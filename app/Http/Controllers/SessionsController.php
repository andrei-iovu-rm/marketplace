<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    /*public function store()
    {
        $attributes = request()->validate(
            [
                'email' => ['required', 'email'],
                'password' => 'required'
            ]
        );

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages(
                [
                    'email' => 'Your provided credentials could not be verified.'
                ]
            );
        }

        session()->regenerate();
        return redirect('/')->with('success', 'Welcome back!');
    }*/

    public function destroy()
    {
        auth()->logout();

        if (Request::inertia()) {
            return Inertia::location('/');
        }
        return redirect('/')->with('success', 'Goodbye!');
    }
}
