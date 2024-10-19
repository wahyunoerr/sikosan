<?php

use App\Http\Controllers\KamarController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RekeningController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LandingController::class)->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('/', 'index')->name('landing.index');
    });
});

Auth::routes();

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::controller(KamarController::class)->group(function () {
        Route::prefix('kamar')->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'create')->name('kamar.add');
            Route::get('/edit/{id}', 'edit')->name('kamar.edit');
            Route::post('/save', 'store')->name('kamar.save');
            Route::post('/update/{id}', 'update')->name('kamar.update');
            Route::get('/foto/{id}', 'showImage')->name('kamar.image');
            Route::delete('/delete/{id}', 'destroy')->name('kamar.delete');
        });
    });

    Route::controller(RekeningController::class)->group(function () {
        Route::prefix('rekening')->group(function () {
            Route::get('/', 'index');
            Route::get('/edit/{id}', 'edit')->name('rekening.edit');
            Route::post('/save', 'store')->name('rekening.save');
            Route::post('/update/{id}', 'update')->name('rekening.update');
            Route::post('/save', 'store')->name('rekening.save');
            Route::delete('/delete/{id}', 'destroy')->name('rekening.delete');
        });
    });
});
