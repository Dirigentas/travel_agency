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
    Route::get('/index', [C::class, 'index'])->name('index'); //->middleware('roles:Ad|Ma');    
    Route::get('/create', [C::class, 'create'])->name('create'); //->middleware('roles:Ad');
    Route::post('/store', [C::class, 'store'])->name('store'); //->middleware('roles:Ad');    
    Route::get('/edit/{country}', [C::class, 'edit'])->name('edit'); //->middleware('roles:Ad|Ma');
    Route::put('/update/{country}', [C::class, 'update'])->name('update'); //->middleware('roles:Ad|Ma');    
    Route::delete('/destroy/{country}', [C::class, 'destroy'])->name('destroy'); //->middleware('roles:Ad');    
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
