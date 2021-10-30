<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\RegistrationController;
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
    //get currently logged in user
    Route::get('me', [AuthenticationController::class, 'me'])->middleware('auth:sanctum')
        ->name('auth::me');
    //logout
    Route::get('logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum')
        ->name('auth::logout');

});

//items
Route::group(['prefix' => 'items'], function () {
    Route::get('items', [ItemsController::class, 'index'])->name('items::getAll');
    Route::get('items/{uuid}', [ItemsController::class, 'show'])->name('items::getAll');
});

//address
Route::group(['prefix' => 'address'], function () {
    Route::post('address', [AddressesController::class, 'store'])->name('address::store');
});
