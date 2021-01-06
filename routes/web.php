<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;

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

Route::get('/check', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('frontend.home');
});

Route::view('/product','frontend.product');


// Admin Panel

Route::group(['middleware' => ['auth','isAdmin']], function () {

        Route::get('/dashboard', function () {
        return view('backend.home');
    });

    Route::get('/registered-user',[AdminController::class,'index']);

    Route::get('roll-edit/{id}',[AdminController::class,'edit']);
    Route::get('roll-delete/{id}',[AdminController::class,'delete']);

    Route::post('roll-update/{id}',[AdminController::class,'update']);

});

// Vendor Panel

Route::group(['middleware' => ['auth','isVendor']], function () {

        Route::get('/vendor-dashboard', function () {
        return view('vendor.home');
    });

});


// Auth
Auth::routes();


Route::group(['middleware' => ['auth','isUser']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/update-user-profile', [UserController::class, 'updateUserProfile']);

    Route::post('/edit_profile', [UserController::class, 'edit_profile']);

});