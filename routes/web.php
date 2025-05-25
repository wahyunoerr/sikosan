<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PindahController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
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
        Route::get('/kamar-detail/{id}', 'getItemKamar')->name('landing.getKamar');
    });
});

Auth::routes([
    'password.confirm' => false,
    'password.email' => false,
    'password.request' => false,
    'password.reset' => false,
    'password.update' => false,
]);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::controller(KamarController::class)->group(function () {
        Route::prefix('kamar')->group(function () {
            Route::get('/', 'index');
            Route::get('/add', 'create')->name('kamar.add');
            Route::get('/edit/{id}', 'edit')->name('kamar.edit');
            Route::post('/save', 'store')->name('kamar.save');
            Route::put('/update/{id}', 'update')->name('kamar.update');
            Route::get('/foto/{id}', 'showImage')->name('kamar.image');
            Route::delete('/delete/{id}', 'destroy')->name('kamar.delete');
            Route::get('/riwayat', 'riwayat')->name('kamar.riwayat');
            Route::get('/laporan-kosong', 'laporanKosong')->name('kamar.laporan.kosong');
        });
    });

    Route::controller(RekeningController::class)->group(function () {
        Route::prefix('rekening')->group(function () {
            Route::get('/', 'index');
            Route::get('/edit/{id}', 'edit')->name('rekening.edit');
            Route::post('/save', 'store')->name('rekening.save');
            Route::post('/update/{id}', 'update')->name('rekening.update');
            Route::delete('/delete/{id}', 'destroy')->name('rekening.delete');
        });
    });

    Route::controller(BookingController::class)->group(function () {
        Route::prefix('booking')->group(function () {
            Route::get('/', 'index')->name('booking.index');
            Route::get('/edit/{id}', 'edit')->name('booking.edit');
            Route::post('/statusBoking/{id}/{status}', 'statusBoking')->name('booking.status');
            Route::post('/update/{id}', 'update')->name('booking.update');
            Route::post('/confirm-payment/{id}', 'confirmPayment')->name('booking.confirmPayment');
            Route::delete('/delete/{id}', 'destroy')->name('booking.delete');
        });
    });

    Route::controller(TransaksiController::class)->group(function () {
        Route::prefix('transaksi')->group(function () {
            Route::get('/', 'index');
            Route::post('/store/{id}', 'store')->name('transaksi.store');
            Route::get('/invoice/{id}', 'invoice')->name('transakci.invoice');
        });
    });

    Route::controller(UserController::class)->group(function () {
        Route::prefix('pengguna')->group(function () {
            Route::get('/', 'index');
            Route::get('/edit/{id}', 'edit')->name('pengguna.edit');
            Route::put('/update/{id}', 'update')->name('pengguna.update');
            Route::delete('/delete/{id}', 'destroy')->name('pengguna.delete');
            Route::post('/orders', 'store');
        });
    });

    Route::controller(ReviewController::class)->group(function () {
        Route::prefix('rating')->group(function () {
            Route::get('/', 'index')->name('rating.index');
            Route::post('/save', 'store')->name('rating.save');
            Route::put('/update/{id}', 'update')->name('rating.update');
            Route::delete('/delete/{id}', 'destroy')->name('rating.delete');
            Route::get('/toggleStatus/{id}', 'toggleStatus')->name('rating.toggleStatus');
        });
    });

    Route::controller(PindahController::class)->group(function () {
        Route::prefix('pindah')->group(function () {
            Route::get('/', 'index')->name('pindah.index');
            Route::get('/create', 'create')->name('pindah.create');
            Route::post('/store', 'store')->name('pindah.store');
            Route::delete('/delete/{id}', 'destroy')->name('pindah.delete');
        });
    });
});

Route::middleware(['auth', 'role:customer|admin'])->group(function () {
    Route::controller(BookingController::class)->group(function () {
        Route::prefix('booking')->group(function () {
            Route::get('/customer', 'customerBooking')->name('booking.customer');
            Route::post('/save', 'store')->name('booking.save');
        });
    });

    Route::controller(LandingController::class)->group(function () {
        Route::post('/reviews/store', 'storeReview')->name('reviews.store');
    });
});
