<?php

use App\Http\Controllers\main\MainController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/dashboard', function () {
    return view(view: 'dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about');
    Route::get('/blog', 'blog');
    Route::get('/contact', 'contact');
    Route::get('/feature', 'feature');
    Route::get('/pricing', 'pricing');
    Route::get('/service', 'service');
    Route::get('/testimonial', 'testimonial');
    Route::get('/login2', 'login');
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->prefix('dashboard')->name('admin.')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'form')->name('form');
        });
    });
});


Route::fallback(function () {
    return view('404');
});

require __DIR__.'/auth.php';