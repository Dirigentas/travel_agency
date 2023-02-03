<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController as C;
use App\Http\Controllers\HotelController as H;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/countries')->name('countries-')->group(function () {
    Route::get('/index', [C::class, 'index'])->name('index')->middleware('roles:A');    
    Route::get('/create', [C::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/store', [C::class, 'store'])->name('store')->middleware('roles:A');    
    Route::get('/edit/{country}', [C::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/update/{country}', [C::class, 'update'])->name('update')->middleware('roles:A');    
    Route::delete('/destroy/{country}', [C::class, 'destroy'])->name('destroy')->middleware('roles:A');    
});

Route::prefix('/hotels')->name('hotels-')->group(function () {
    Route::get('/index', [H::class, 'index'])->name('index')->middleware('roles:A');    
    Route::get('/create', [H::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/store', [H::class, 'store'])->name('store')->middleware('roles:A');    
    Route::get('/edit/{hotel}', [H::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/update/{hotel}', [H::class, 'update'])->name('update')->middleware('roles:A');    
    Route::delete('/destroy/{hotel}', [H::class, 'destroy'])->name('destroy')->middleware('roles:A');    
});


Auth::routes(); //['register'=> false] - panaikina registracijos lauka

Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
