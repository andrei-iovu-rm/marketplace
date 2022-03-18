<?php

use App\Http\Controllers\AdminOfferController;
use App\Http\Controllers\FavouriteOfferController;
use App\Http\Controllers\Inertiajs\Users;
use App\Http\Controllers\NewsletterController;
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
    Route::post('newsletter', [NewsletterController::class, 'store']);
    Route::delete('newsletter', [NewsletterController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/inertiajs', function () {
        return Inertia::render('Home');
    });
    /*Route::get('/inertiajs/users', [Users::class, 'index']);
    Route::get('/inertiajs/users/create', [Users::class, 'create'])->can('create', User::class);
    Route::post('/inertiajs/users', [Users::class, 'store'])->can('create', User::class);
    Route::get('/inertiajs/users/{user}/edit', [Users::class, 'edit'])->can('update', User::class);
    Route::patch('/inertiajs/users/{user}', [Users::class, 'update'])->can('update', User::class);
    Route::delete('/inertiajs/users/{user}', [Users::class, 'destroy'])->can('delete', User::class);*/
    Route::resource('inertiajs/users', Users::class)->except('show');
    Route::get('/inertiajs/settings', function () {
        return Inertia::render('Settings');
    });
});
