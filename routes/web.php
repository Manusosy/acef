<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/programmes', [\App\Http\Controllers\HomeController::class, 'programmes'])->name('programmes');
Route::get('/projects', [\App\Http\Controllers\HomeController::class, 'projects'])->name('projects');
Route::get('/impact', [\App\Http\Controllers\HomeController::class, 'impact'])->name('impact');
Route::get('/resources', [\App\Http\Controllers\HomeController::class, 'resources'])->name('resources');
Route::get('/news', [\App\Http\Controllers\HomeController::class, 'news'])->name('news');
Route::get('/contact', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/donate', [\App\Http\Controllers\HomeController::class, 'donate'])->name('donate');
Route::get('/get-involved', [\App\Http\Controllers\HomeController::class, 'getInvolved'])->name('get-involved');
Route::get('/privacy', [\App\Http\Controllers\HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [\App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
Route::get('/gallery', [\App\Http\Controllers\HomeController::class, 'gallery'])->name('gallery');
Route::get('/team', [\App\Http\Controllers\HomeController::class, 'team'])->name('team');
Route::get('/partners', [\App\Http\Controllers\HomeController::class, 'partners'])->name('partners');
Route::get('/accreditations', [\App\Http\Controllers\HomeController::class, 'accreditations'])->name('accreditations');
Route::get('/cookies', [\App\Http\Controllers\HomeController::class, 'cookies'])->name('cookies');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isCoordinator()) {
            return redirect()->route('coordinator.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    });

    // Coordinator Routes
    Route::middleware(['role:country_coordinator'])->prefix('coordinator')->name('coordinator.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Coordinator\DashboardController::class, 'index'])->name('dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
