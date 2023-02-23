<?php


use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\User\UserController;
use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\Admin\TagController;
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
    Route::resource('tag', TagController::class);
});

Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>['auth:sanctum',config('jetstream.auth_session'),'verified','role:admin']],function () {
    Route::resource('tag', TagController::class);
});



// Route::controller(CategoryController::class)->group(function(){
//     Route::get('/category/create','create')->name('category-create');
//     Route::post('/category/store', 'store')->name('category-store');
//     // Route::get('/categories','index')->name('category-manage');
//     Route::get('/category/delete/{cat_id}',  'delete')->name('category-delete');
//     Route::get('/category/edit/{cat_id}',  'edit')->name('category-edit');
//     Route::post('/category/update/{cat_id}',  'update')->name('category-update');
    
// });
