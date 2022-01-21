<?php

use App\Http\Controllers\api\v1\AdvertiseController;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\SettingController;
use App\Http\Controllers\api\v1\UserController;
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


Route::prefix('v1')->group(function ()
{
    Route::prefix('auth')->group(function ()
    {
        Route::post('login', [AuthController::class, 'login'])->middleware('throttle:otp');
        Route::post('verify', [AuthController::class, 'verify']);
        Route::post('passwordLogin', [AuthController::class, 'passwordLogin'])->middleware('throttle:password');
        Route::post('resetPassword', [AuthController::class, 'resetPassword']);
    });
    
    Route::prefix('advertise')->group(function ()
    {
        Route::get('categories', [AdvertiseController::class, 'categories']);
        Route::get('cities', [AdvertiseController::class, 'cities']);
        Route::get('regions', [AdvertiseController::class, 'regions']);
        Route::get('advertises', [AdvertiseController::class, 'advertises']);
        Route::get('advertise', [AdvertiseController::class, 'advertise']);
    });
    Route::prefix('setting')->group(function ()
    {
        Route::get('sliders', [SettingController::class, 'sliders']);
        Route::get('general', [SettingController::class, 'general']);
        Route::get('patchNote', [SettingController::class, 'patchNote']);
        Route::get('rules', [SettingController::class, 'rules']);
        Route::get('privacy', [SettingController::class, 'privacy']);
        Route::get('warning', [SettingController::class, 'warning']);
    });
    
    Route::middleware('auth:sanctum')->group(function ()
    {
        Route::prefix('user')->group(function ()
        {
            Route::post('logout', [UserController::class, 'logout']);
            Route::post('update', [UserController::class, 'update']);
            Route::post('setPassword', [UserController::class, 'setPassword']);
            Route::get('user', [UserController::class, 'user']);
        });
    
        Route::prefix('advertise')->group(function ()
        {
            Route::post('store', [AdvertiseController::class, 'store']);
            Route::post('update', [AdvertiseController::class, 'update']);
            Route::post('bookmark', [AdvertiseController::class, 'bookmark']);
            Route::get('bookmarks', [AdvertiseController::class, 'bookmarks']);
            Route::get('lastseens', [AdvertiseController::class, 'lastseens']);
        });
        
    });
    
});


