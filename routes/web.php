<?php

use App\Enums\UserRole;
use App\Http\Controllers\AdminOfferController;
use App\Http\Controllers\FavouriteOfferController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('demo');
});*/

Route::get('/', [OfferController::class, 'index'])->name('home');

Route::get('offers/{offer:slug}', [OfferController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::middleware('can:admin')->group(function (){
    Route::resource('admin/offers', AdminOfferController::class)->except('show');
});

Route::get('admin/dashboard', [AdminOfferController::class, 'dashboard'])->middleware('can:admin');

/*Route::middleware('auth')->group(function (){
    Route::resource('/favourite', FavouriteOfferController::class)->except('show');
});*/

Route::middleware('auth')->group(function () {
    Route::get('favourites', [FavouriteOfferController::class, 'index']);
    Route::post('/favourite/{offer}', [FavouriteOfferController::class, 'store']);
    Route::delete('/favourite/{offer}', [FavouriteOfferController::class, 'destroy']);
});


Route::get('/inertiajs', function () {
    return Inertia::render('Home');
});
Route::get('/inertiajs/users', function () {
    return Inertia::render('Users/Index', [
        //'time' => now()->toTimeString()
        'users' => \App\Models\User::query()
            ->when(request('search'), function ($query, $search){
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(5)
            ->withQueryString()
            ->through(function ($user){
                return ['id' => $user->id, 'name' => $user->name];
            }),
        'filters' => Request::only(['search'])
    ]);
});
Route::get('/inertiajs/users/create', function (){
    return Inertia::render('Users/Create', [
        'roles' => UserRole::cases(),
    ]);
});
Route::post('/inertiajs/users', function (){
    $attributes = Request::validate([
        'name' => 'required|max:255',
        'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username'), 'regex:/^[\w\d]+$/i'],
        'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
        'password' => ['required', 'min:7', 'max:255'],
        'role' => ['required', (new Enum(UserRole::class))],
    ]);

    \App\Models\User::create($attributes);

    return redirect('/inertiajs/users');
});
Route::get('/inertiajs/settings', function () {
    return Inertia::render('Settings');
});
Route::post('/inertiajs/logout', function () {
    dd(request('foo'));
});
