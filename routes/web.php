<?php

use App\Http\Controllers\admin\information\InformationController;
use App\Http\Controllers\admin\game\GameController;
use App\Http\Controllers\admin\KonsultasiAdminController;
use App\Http\Controllers\ai\GeminiController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\seller\HitungController;
use App\Http\Controllers\main\MainController;
use App\Http\Controllers\main\ContactController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\seller\KonsultasiSellerController;
use App\Http\Controllers\seller\SellerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

require __DIR__.'/auth.php';

Route::middleware('guest')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('index');

    Route::get('/informasi', [MainController::class, 'informasi'])->name('informasi');
    Route::get('/informasi/{title}', [MainController::class, 'baca'])->name('baca');

    Route::get('/contact', [ContactController::class, 'contact'])->name('contact.view');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

    Route::get('/permainan', [MainController::class, 'permainan'])->name('permainan');


    Route::get('/{name}', [GuestController::class, 'index'])->name('usaha');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('seller')->prefix('seller')->name('seller.')->group(function () {
        Route::get('/index', [SellerController::class, 'index'])->name('index');
        Route::get('/custom', [SellerController::class, 'custom'])->name('custom');
        Route::get('/chat', [SellerController::class, 'chat'])->name('chat');
        Route::post('/custom/name/store', [SellerController::class, 'nameStore'])->name('custom.name.store');
        Route::post('/custom/link/store', [SellerController::class, 'linkStore'])->name('custom.link.store');

        Route::post('/generate-content', [GeminiController::class, 'generateContent'])->name('generateContent');
        Route::post('/ai/analisis', [GeminiController::class, 'analisisManajemen'])->name('analisisManajemen');

        Route::get('/variabel', [HitungController::class, 'variabel'])->name('variabel');
        Route::post('/variabel/store', [HitungController::class, 'variabelStore'])->name('variabel.store');
        Route::delete('/variabel/{id}/destroy', [HitungController::class, 'variabelDestroy'])->name('variabel.destroy');

        Route::get('/tetap', [HitungController::class, 'tetap'])->name('tetap');
        Route::post('/tetap/store', [HitungController::class, 'tetapStore'])->name('tetap.store');
        Route::delete('/tetap/{id}/destroy', [HitungController::class, 'tetapDestroy'])->name('tetap.destroy');

        Route::get('/dataHitung', [HitungController::class, 'dataHitung'])->name('dataHitung');
        Route::get('/data-pdf', [HitungController::class, 'downloadPdf'])->name('pdf');

        Route::get('/hitung', [HitungController::class, 'hitung'])->name('hitung');
        Route::post('/harga-jual/store', [HitungController::class, 'hargaJualStore'])->name('hargaJual.store');
        Route::post('/hpp/store', [HitungController::class, 'hppStore'])->name('hpp.store');
        Route::post('/bepUnit/store', [HitungController::class, 'bepUnitStore'])->name('bepUnit.store');
        Route::post('/bepRupiah/store', [HitungController::class, 'bepRupiahStore'])->name('bepRupiah.store');
        Route::post('/perkiraanPenjualan/store', [HitungController::class, 'perkiraanPenjualan'])->name('perkiraanPenjualan.store');
        Route::post('/biayaProduksi/store', [HitungController::class, 'biayaProduksi'])->name('biayaProduksi.store');

        Route::post('/labaUsaha/store', [HitungController::class, 'labaUsaha'])->name('labaUsaha.store');
        Route::post('/labaKotor/store', [HitungController::class, 'labaKotor'])->name('labaKotor.store');
        Route::post('/bcRatio/store', [HitungController::class, 'bcRatio'])->name('bcRatio.store');
        Route::post('/netProfit/store', [HitungController::class, 'netProfit'])->name('netProfit.store');
        Route::post('/grosProfit/store', [HitungController::class, 'grosProfit'])->name('grosProfit.store');

        Route::post('/calculate/store', [HitungController::class, 'calculateAndStore'])->name('calculateAndStore.store');

        Route::get('/konsultasi', [KonsultasiSellerController::class, 'index'])->name('konsultasi');
    });

    Route::middleware('admin')->prefix('dashboard')->name('admin.')->group(function () {
        Route::get('/index', [AdminController::class, 'index'])->name('index');
        Route::get('/contact', [AdminController::class, 'contact'])->name('contact');

        Route::get('/information/index', [InformationController::class, 'index'])->name('information.index');
        Route::post('/information/store', [InformationController::class, 'store'])->name('information.store');
        Route::put('/information/{id}/update', [InformationController::class, 'update'])->name('information.update');
        Route::delete('/information/{id}/destroy', [InformationController::class, 'destroy'])->name('information.destroy');

        Route::get('/games/index', [GameController::class, 'index'])->name('games.index');
        Route::post('/games/store', [GameController::class, 'store'])->name('games.store');
        Route::put('/games/{id}/update', [GameController::class, 'update'])->name('games.update');
        Route::delete('/games/{id}/destroy', [GameController::class, 'destroy'])->name('games.destroy');

        Route::get('/konsultasi', [KonsultasiAdminController::class, 'index'])->name('konsultasi');
    });
});

Route::fallback(function () {
    return view('404');
});
