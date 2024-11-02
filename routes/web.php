<?php

use App\Http\Controllers\admin\information\InformationController;
use App\Http\Controllers\admin\game\GameController;
use App\Http\Controllers\ai\GeminiController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\main\MainController;
use App\Http\Controllers\main\ContactController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\seller\SellerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;


Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

// Route::get('/gemini', [GeminiController::class, 'generateContent']);

require __DIR__.'/auth.php';

Route::middleware('guest')->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/about', 'about');
        Route::get('/blog', 'blog');
        Route::get('/feature', 'feature');
        Route::get('/pricing', 'pricing');
        Route::get('/service', 'service');
        Route::get('/testimonial', 'testimonial');
        Route::get('/login2', 'login');
    });

    Route::controller(GuestController::class)->group(function () {
        Route::get('/{name}', 'index')->name('usaha');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact', 'contact')->name('contact.view');
        Route::post('/contact', 'send')->name('contact.send');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('seller')->prefix('seller')->name('seller.')->group(function () {
        Route::controller(SellerController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/custom', 'custom')->name('custom');
            Route::get('/chat', 'chat')->name('chat');
            Route::post('/custom/name/store', 'nameStore')->name('custom.name.store');
            Route::post('/custom/link/store', 'linkStore')->name('custom.link.store');

            Route::controller(GeminiController::class)->group(function () {
                Route::post('/generate-content', 'generateContent')->name('generateContent');
            });
        });
    });

    Route::middleware('admin')->prefix('dashboard')->name('admin.')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::get('/contact', 'contact')->name('contact');
        });

        Route::controller(InformationController::class)->prefix('information')->name('information.')->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/{id}/update', 'update')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        });

        Route::controller(GameController::class)->prefix('games')->name('games.')->group(function () {
            Route::get('/index', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/{id}/update', 'update')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        });
    });
});

Route::fallback(function () {
    return view('404');
});

