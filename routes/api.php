<?php

use App\Http\Controllers\Api\MpesaCallbackController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// M-Pesa Payment Gateway Callbacks
// These routes are exempt from CSRF protection (API middleware group)
Route::post('/mpesa/callback', [MpesaCallbackController::class, 'callback'])
    ->name('api.mpesa.callback');
