<?php

use App\Http\Controllers\AdminOfferController;
use App\Http\Controllers\FavouriteOfferController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;
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
    return Inertia::render('Users', [
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
Route:get('/inertiajs/users/create', function (){
    return Inertia::render('UserCreate');
});
Route::get('/inertiajs/settings', function () {
    return Inertia::render('Settings');
});
Route::post('/inertiajs/logout', function () {
    dd(request('foo'));
});
