<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController as C;
use App\Http\Controllers\HotelController as H;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;

Route::get('/', [F::class, 'index'])->name('index');
Route::get('/cat/{country}', [F::class, 'showCatHotels'])->name('show-cats-hotels');
Route::get('show/{hotel}', [F::class, 'show'])->name('show');
Route::post('add', [F::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [F::class, 'cart'])->name('cart');
Route::post('/cart', [F::class, 'updateCart'])->name('update-cart');
Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order');

Route::prefix('admin/countries')->name('countries-')->group(function () {
    Route::get('/index', [C::class, 'index'])->name('index')->middleware('roles:A');    
    Route::get('/create', [C::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/store', [C::class, 'store'])->name('store')->middleware('roles:A');    
    Route::get('/edit/{country}', [C::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/update/{country}', [C::class, 'update'])->name('update')->middleware('roles:A');    
    Route::delete('/destroy/{country}', [C::class, 'destroy'])->name('destroy')->middleware('roles:A');    
});

Route::prefix('admin/hotels')->name('hotels-')->group(function () {
    Route::get('/index', [H::class, 'index'])->name('index')->middleware('roles:A');    
    Route::get('/create', [H::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/store', [H::class, 'store'])->name('store')->middleware('roles:A');    
    Route::get('/edit/{hotel}', [H::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/update/{hotel}', [H::class, 'update'])->name('update')->middleware('roles:A');    
    Route::delete('/destroy/{hotel}', [H::class, 'destroy'])->name('destroy')->middleware('roles:A');    
});

Route::prefix('admin/orders')->name('orders-')->group(function () {
    Route::get('/index', [O::class, 'index'])->name('index')->middleware('roles:A');
    Route::put('/edit/{order}', [O::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete')->middleware('roles:A');
});


Auth::routes(); //['register'=> false] - panaikina registracijos lauka

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
