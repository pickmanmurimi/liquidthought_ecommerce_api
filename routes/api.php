<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Authentication
Route::group(['prefix' => 'authentication'], function () {

    Route::post('register', [RegistrationController::class, 'register'])->name('auth::register');

    Route::post('login', [AuthenticationController::class, 'login'])->name('auth::login');

    //logout
    Route::get('logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum')
        ->name('auth::logout');

    // email verification
    Route::get('verify-email/{token}/{uuid}', [EmailVerificationController::class, 'verifyEmail'])
        ->name('auth::verifyEmail');

    Route::get('resend-verification', [EmailVerificationController::class, 'resendVerifyEmail'])
        ->name('auth::resendVerifyEmail')->middleware('auth:sanctum');
});

//items
Route::group(['prefix' => 'items'], function () {
    Route::get('items', [ItemsController::class, 'index'])->name('items::getAll');

    Route::get('items/{uuid}', [ItemsController::class, 'show'])->name('items::getAll');

    Route::get('items/related-items/{uuid}', [ItemsController::class, 'getRelatedItems'])
        ->name('items::getRelatedItems');

    Route::post('checkout', [CheckoutController::class, 'checkout'])->name('items::checkout')
    ->middleware('auth:sanctum');

    Route::get('orders', [CheckoutController::class, 'getOrders'])->name('items::getOrders')
    ->middleware('auth:sanctum');
});

//user
Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    //get currently logged in user
    Route::get('me', [UserController::class, 'me'])->name('auth::me');

    Route::post('address', [AddressesController::class, 'store'])->name('address::store');

    Route::get('address', [AddressesController::class, 'index'])->name('address::index');
});
