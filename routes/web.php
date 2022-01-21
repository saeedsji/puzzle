<?php

use App\Http\Controllers\admin\AdvertiseController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\MainController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RegionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('loginPost', [AuthController::class, 'loginPost'])->name('loginPost');


Route::prefix('admin')->middleware(['auth', 'checkAdmin'])->group(function ()
{
    Route::get('dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::group(['middleware' => ['permission:مدیریت کاربران']], function ()
    {
        Route::resource('user', UserController::class)->except(['show']);
        Route::post('user/resetPassword/{user}', [UserController::class, 'resetPassword'])->name('resetPassword');
    });
    
    Route::group(['middleware' => ['role:ادمین اصلی']], function ()
    {
        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);
    });
    
    Route::group(['middleware' => ['permission:مدیریت دسته بندی ها']], function ()
    {
        Route::resource('category', CategoryController::class)->except(['show']);
    });
    
    Route::group(['middleware' => ['permission:مدیریت شهر ها']], function ()
    {
        Route::resource('city', CityController::class)->except(['show']);
    });
    
    Route::group(['middleware' => ['permission:مدیریت منطقه ها']], function ()
    {
        Route::resource('region', RegionController::class)->except(['show']);
    });
    
    Route::group(['middleware' => ['permission:مدیریت آگهی ها']], function ()
    {
        Route::resource('advertise', AdvertiseController::class)->except(['show']);
        Route::post('getRegionByCity', [AdvertiseController::class, 'getRegionByCity'])->name('getRegionByCity');
    });
    
    Route::group(['middleware' => ['permission:مدیریت اسلایدر ها']], function ()
    {
        Route::resource('slider', SliderController::class)->except(['show']);
    });
    
    Route::group(['middleware' => ['permission:مدیریت تنظیمات عمومی']], function ()
    {
        Route::get('setting/general', [SettingController::class, 'general'])->name('setting.general');
        Route::post('setting/general/store', [SettingController::class, 'generalStore'])->name('setting.generalStore');
    });
    
    
});
