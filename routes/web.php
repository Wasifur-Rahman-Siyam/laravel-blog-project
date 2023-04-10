<?php

use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\User\UserController;
use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\Admin\PostController;
use App\Http\Controllers\Backend\Admin\ProfileSettingsController;
Use App\Http\Controllers\Backend\User\UserPostController;
use App\Http\Controllers\Backend\Admin\TagController;
use App\Http\Controllers\Backend\NotificationsController;
use App\Http\Controllers\Backend\User\UserDashboardController;
use App\Http\Controllers\LikeController;
use GuzzleHttp\Middleware;
use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;

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
| User Routes
|--------------------------------------------------------------------------
*/

Route::group(['as'=>'user.','prefix'=>'user','middleware'=>['auth:sanctum',config('jetstream.auth_session'),'verified','role:user']],function () {
    Route::get('/dashboard', [UserDashboardController::class,'index'])->name('dashboard');
    Route::resource('post', UserPostController::class);

    // profile settings
    Route::get('/settings',[UserController::class,'index'])->name('profile.settings');
    Route::put('/profile-update',[UserController::class,'updateProfile'])->name('profile.update');
    Route::put('/password-update',[UserController::class,'updatePassword'])->name('password.update');

    // notification routes
    Route::get('/notifications',[NotificationsController::class, 'show'])->name('notifications');
    Route::get('/markasread/{id}',[NotificationsController::class, 'markasread'])->name('markasread');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>['auth:sanctum',config('jetstream.auth_session'),'verified','role:admin']],function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('tag', TagController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('post', PostController::class);

    // profile settings
    Route::get('/settings',[ProfileSettingsController::class,'index'])->name('profile.settings');
    Route::put('/profile-update',[ProfileSettingsController::class,'updateProfile'])->name('profile.update');
    Route::put('/password-update',[ProfileSettingsController::class,'updatePassword'])->name('password.update');    
    // User post approval routes
    Route::get('pending/post',[PostController::class,'pending'])->name('post.pending');
    Route::put('/post/{id}/approve',[PostController::class,'approval'])->name('post.approve');

    // notification routes
    Route::get('/notifications',[NotificationsController::class, 'show'])->name('notifications');
    Route::get('/markasread/{id}',[NotificationsController::class, 'markasread'])->name('markasread');
});


/*
|--------------------------------------------------------------------------
| Admin & User Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware'=>['auth:sanctum',config('jetstream.auth_session'),'verified']],function () {
    
    //Like routes
    Route::post('/like/{post_id}/add',[LikeController::class, 'like'])->name('post.like');
    Route::get('/liked-post',[LikeController::class, 'index'])->name('post.liked');
});
