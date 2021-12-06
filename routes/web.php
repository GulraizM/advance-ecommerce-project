<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\SellerController;
use App\Models\User;
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


/* ---------------Admin Route Starts----------------------------*/

Route::prefix('admin')->group(function ()
{
    Route::get('/login', [AdminController::class, 'Index'])
        ->name('login.form');

    Route::post('/login/owner', [AdminController::class, 'Login'])
        ->name('admin.login');

    Route::get('/dashboard', [AdminController::class, 'Dashboard'])
        ->name('admin.dashboard')
        ->middleware('admin');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])
        ->name('admin.logout')
        ->middleware('admin');
        
    Route::get('/register', [AdminController::class, 'AdminRegister'])
        ->name('admin.register');

    
    Route::post('/register/create', [AdminController::class, 'AdminRegisterCreate'])
        ->name('admin.register.create');


    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])
    ->name('admin.profile');


    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])
    ->name('admin.profile.edit');


    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])
    ->name('admin.profile.store');


    Route::get('/admin/change/password', [AdminProfileController::class, 'AdminchangePassword'])
    ->name('admin.change.password');

    Route::post('/admin/password/update', [AdminProfileController::class, 'AdminPasswordUpdate'])
    ->name('admin.password.update');
        

});
/* ---------------Admin Route Ends ----------------------------*/


/* ---------------Seller Route Starts----------------------------*/
Route::prefix('seller')->group(function ()
{
    Route::get('/login', [SellerController::class, 'Index'])
        ->name('seller.login.form');

    Route::post('/login/owner', [SellerController::class, 'Login'])
        ->name('seller.login');

    Route::get('/dashboard', [SellerController::class, 'Dashboard'])
        ->name('seller.dashboard')
        ->middleware('seller');

    Route::get('/logout', [SellerController::class, 'SellerLogout'])
        ->name('seller.logout')
        ->middleware('seller');
        
    Route::get('/register', [SellerController::class, 'SellerRegister'])
        ->name('seller.register');

    
    Route::post('/register/create', [SellerController::class, 'SellerRegisterCreate'])
        ->name('seller.register.create');

});
/* ---------------Seller Route Ends ----------------------------*/




/* ---------------Frontend Route Starts ----------------------------*/

Route::get('/', [IndexController::class, 'Index']);

Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');

Route::get('/user/profile', [IndexController::class, 'userProfile'])->name('user.profile');

Route::post('/user/profile/update', [IndexController::class, 'userProfileUpdate'])->name('user.profile.update');

Route::get('/user/change/password',  [IndexController::class, 'userChangePassword'])
    ->name('user.change.password');

Route::post('/user/password/update', [IndexController::class, 'userPasswordUpdate'])
->name('user.password.update');    



Route::get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
