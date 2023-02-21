<?php


use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\User\UserController;
use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\User\UserDashboardController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/categories',[HomeController::class, 'categories'])->name('categories');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard',[HomeController::class,'redirectUser'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['as'=>'user.','prefix'=>'user','namespace'=>'user','middleware'=>['auth:sanctum',config('jetstream.auth_session'),'verified','role:user']],function () {
    Route::get('/dashboard', [UserDashboardController::class,'index'])->name('dashboard');
});

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'admin','middleware'=>['auth:sanctum',config('jetstream.auth_session'),'verified','role:admin']],function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
});