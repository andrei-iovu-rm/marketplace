<?php

namespace App\Http\Controllers\Inertiajs;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;

class Users extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index()
    {
        return Inertia::render('Users/Index', [
            //'time' => now()->toTimeString()
            'users' => User::query()
                ->when(request('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(5)
                ->withQueryString()
                ->through(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'can' => [
                            'edit' => Auth::user()->can('update', $user),
                            'delete' => Auth::user()->can('delete', $user)
                        ]
                    ];
                }),
            'filters' => request()->only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create', [
            'roles' => UserRole::cases(),
        ]);
    }

    public function store()
    {
        $attributes = Request::validate([
            'name' => 'required|max:255',
            'username' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('users', 'username'),
                'regex:/^[\w\d]+$/i'
            ],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:7', 'max:255'],
            'role' => ['required', (new Enum(UserRole::class))],
        ]);

        User::create($attributes);

        return redirect('/inertiajs/users');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user,
            'roles' => UserRole::cases(),
        ]);
    }

    public function update(User $user)
    {
        $attributes = Request::validate([
           'name' => 'required|max:255',
           'username' => [
               'required',
               'min:3',
               'max:255',
               Rule::unique('users', 'username')->ignore($user),
               'regex:/^[\w\d]+$/i'
           ],
           'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
           'role' => ['required', (new Enum(UserRole::class))],
       ]);

        $user->update($attributes);

        return redirect('/inertiajs/users');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/inertiajs/users');
    }
}
