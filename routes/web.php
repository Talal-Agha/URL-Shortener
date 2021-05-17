<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('url-shortener', [App\Http\Controllers\ShortLinkController::class, 'index'])->name('shortener.index');

    Route::post('url-shortener', [App\Http\Controllers\ShortLinkController::class, 'store'])->name('shortener.store');
    
    Route::delete('url-shortener/{id}', [App\Http\Controllers\ShortLinkController::class, 'destroy'])->name('shortener.destroy');

});

Route::get('{code}', [App\Http\Controllers\ShortLinkController::class, 'show'])->name('shortener.show');
