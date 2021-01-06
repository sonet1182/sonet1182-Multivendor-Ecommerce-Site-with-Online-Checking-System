<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Http\Controllers\GroupController;

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

    Route::get('group',[GroupController::class,'group']);
    Route::get('add-group',[GroupController::class,'add_group']);
    Route::post('adding_group',[GroupController::class,'adding_group']);
    Route::get('edit_group/{id}',[GroupController::class,'edit_group']);
    Route::post('update_group/{id}',[GroupController::class,'update_group']);
    Route::get('delete_group/{id}',[GroupController::class,'delete_group']);

    Route::get('category',[GroupController::class,'category']);
    Route::get('add-category',[GroupController::class,'add_category']);
    Route::post('adding_category',[GroupController::class,'adding_category']);
    Route::get('edit_category/{id}',[GroupController::class,'edit_category']);
    Route::post('update_category/{id}',[GroupController::class,'update_category']);
    Route::get('delete_category/{id}',[GroupController::class,'delete_category']);


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