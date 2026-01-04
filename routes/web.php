<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('lang/{locale}', [\App\Http\Controllers\LanguageController::class, 'switch'])->name('lang.switch');

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/donate', [\App\Http\Controllers\DonationController::class, 'index'])->name('donate');
Route::middleware(['throttle:10,1'])->group(function () {
    Route::post('/donate/process-paypal', [\App\Http\Controllers\DonationController::class, 'processPaypal'])->name('donate.paypal');
    Route::post('/donate/process-mpesa', [\App\Http\Controllers\DonationController::class, 'processMpesa'])->name('donate.mpesa');
});
Route::get('/search', [\App\Http\Controllers\GlobalSearchController::class, 'index'])->name('search');
Route::get('/programmes', [\App\Http\Controllers\HomeController::class, 'programmes'])->name('programmes');
Route::get('/programmes/{programme:slug}', [\App\Http\Controllers\HomeController::class, 'showProgramme'])->name('programmes.show');
Route::get('/projects', [\App\Http\Controllers\HomeController::class, 'projects'])->name('projects');
Route::get('/projects/{project:slug}', [\App\Http\Controllers\HomeController::class, 'showProject'])->name('projects.show');
Route::get('/impact', [\App\Http\Controllers\HomeController::class, 'impact'])->name('impact');
Route::get('/resources', [\App\Http\Controllers\HomeController::class, 'resources'])->name('resources');
Route::get('/news', [\App\Http\Controllers\HomeController::class, 'news'])->name('news');
Route::get('/news/{article:slug}', [\App\Http\Controllers\HomeController::class, 'showNews'])->name('news.show');
Route::get('/contact', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
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
    // Shared Content Management (Admin & Coordinator)
    Route::middleware(['role:admin,coordinator'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
        Route::resource('programmes', \App\Http\Controllers\Admin\ProgrammeController::class);
        Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
    });

    // Admin-Only Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class);
        
        // Organization
        Route::resource('team', \App\Http\Controllers\Admin\TeamMemberController::class);
        Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
        Route::resource('accreditations', \App\Http\Controllers\Admin\AccreditationController::class);
        Route::resource('resources', \App\Http\Controllers\Admin\ResourceController::class);
        
        // Users
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        
        // Settings
        Route::get('/settings/general', [\App\Http\Controllers\Admin\SettingsController::class, 'general'])->name('settings.general');
        Route::post('/settings/general', [\App\Http\Controllers\Admin\SettingsController::class, 'updateGeneral'])->name('settings.general.update');
        Route::get('/settings/payments', [\App\Http\Controllers\Admin\SettingsController::class, 'payments'])->name('settings.payments');
        Route::post('/settings/payments', [\App\Http\Controllers\Admin\SettingsController::class, 'updatePayments'])->name('settings.payments.update');
        Route::get('/settings/apis', [\App\Http\Controllers\Admin\SettingsController::class, 'apis'])->name('settings.apis');
        Route::post('/settings/apis', [\App\Http\Controllers\Admin\SettingsController::class, 'updateApis'])->name('settings.apis.update');
        
        // Donations
        Route::get('/donations', [\App\Http\Controllers\Admin\DonationController::class, 'index'])->name('donations.index');
        Route::get('/donations/{donation}', [\App\Http\Controllers\Admin\DonationController::class, 'show'])->name('donations.show');

        // Media Library
        Route::resource('media', \App\Http\Controllers\Admin\MediaController::class)->except(['create', 'edit']);
        Route::post('/media/folders', [\App\Http\Controllers\Admin\MediaController::class, 'storeFolder'])->name('media.folders.store');
        Route::put('/media/folders/{folder}', [\App\Http\Controllers\Admin\MediaController::class, 'updateFolder'])->name('media.folders.update');
        Route::delete('/media/folders/{folder}', [\App\Http\Controllers\Admin\MediaController::class, 'destroyFolder'])->name('media.folders.destroy');
        Route::post('/media/bulk', [\App\Http\Controllers\Admin\MediaController::class, 'bulkUpdate'])->name('media.bulk');
        
        // Pages CMS
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
        
        // Hero Sections
        Route::get('/heroes/{page}', [\App\Http\Controllers\Admin\HeroController::class, 'edit'])->name('heroes.edit');
        Route::put('/heroes/{page}', [\App\Http\Controllers\Admin\HeroController::class, 'update'])->name('heroes.update');
        Route::post('/heroes/{page}/slides', [\App\Http\Controllers\Admin\HeroController::class, 'storeSlide'])->name('heroes.slides.store');
        Route::put('/heroes/slides/{slide}', [\App\Http\Controllers\Admin\HeroController::class, 'updateSlide'])->name('heroes.slides.update');
        Route::delete('/heroes/slides/{slide}', [\App\Http\Controllers\Admin\HeroController::class, 'destroySlide'])->name('heroes.slides.destroy');
        Route::post('/heroes/{page}/reorder', [\App\Http\Controllers\Admin\HeroController::class, 'reorderSlides'])->name('heroes.slides.reorder');
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
