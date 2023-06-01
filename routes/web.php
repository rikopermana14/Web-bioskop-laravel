<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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
Route::get('register', [DashboardController::class, 'register'])->name('register');
Route::post('/registersimpan', [DashboardController::class, 'registerSimpan'])->name('register.simpan');
Route::prefix('auth')->group(function () {
   

    Route::get('login', [DashboardController::class, 'login'])->name('login');
    Route::post('login', [DashboardController::class, 'loginAksi'])->name('login.aksi');

    Route::get('logout', [DashboardController::class, 'logout'])->middleware('auth')->name('logout');
});

Route::get('/login', function () {
    return view('dashboard/auth/login');
});

// Route::middleware('auth')->group(function () {
//     Route::get('index', function () {
//         return view('index');
//     })->name('index');
    Route::middleware('auth')->group(function () {
        // Your routes go here
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('index');
        Route::get('/inputfilm', [App\Http\Controllers\DashboardController::class, 'create'])->name('inputfilm');
        Route::post('/storefilm', [App\Http\Controllers\DashboardController::class, 'storefilm'])->name('dashboard.storefilm');
        Route::get('destroy/{id}', [App\Http\Controllers\DashboardController::class, 'destroy'])->name('film.hapus');
        Route::get('/menu', [App\Http\Controllers\DashboardController::class, 'menu'])->name('menu');
        Route::get('/inputbioskop', [App\Http\Controllers\DashboardController::class, 'bioskop'])->name('bioskop');
        Route::post('/storebioskop', [App\Http\Controllers\DashboardController::class, 'storebioskop'])->name('dashboard.storebioskop');
        Route::get('/booking{id}', [App\Http\Controllers\DashboardController::class, 'booking'])->name('booking');
        Route::get('/price', [App\Http\Controllers\DashboardController::class, 'price'])->name('price');
        Route::post('/storeprice', [App\Http\Controllers\DashboardController::class, 'storeprice'])->name('dashboard.storeprice');
        Route::post('/storebooking', [App\Http\Controllers\DashboardController::class, 'storebooking'])->name('dashboard.storebooking');
       
        Route::get('edit/{id}', [App\Http\Controllers\DashboardController::class, 'edit'])->name('film.edit');
        Route::post('edit/{id}', [App\Http\Controllers\DashboardController::class, 'update'])->name('film.tambah.update');
        Route::get('/aboutus', [App\Http\Controllers\DashboardController::class, 'aboutus'])->name('aboutus');
        Route::get('/cetakpdf', [App\Http\Controllers\DashboardController::class, 'cetakpdf'])->name('cetakpdf');
        Route::get('/laporan-pemesanan', [App\Http\Controllers\DashboardController::class,'generateReport'])->name('generateReport');
        Route::get('/laporan', [App\Http\Controllers\DashboardController::class,'laporan'])->name('laporan');
        Route::get('/cetak-pdf', [DashboardController::class, 'generateReport'])->name('cetak.pdf');

        

    });

// });
   

