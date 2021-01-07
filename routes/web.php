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

    // Route for Group
    Route::get('group',[GroupController::class,'group']);
    Route::get('add-group',[GroupController::class,'add_group']);
    Route::post('adding_group',[GroupController::class,'adding_group']);
    Route::get('edit_group/{id}',[GroupController::class,'edit_group']);
    Route::post('update_group/{id}',[GroupController::class,'update_group']);
    Route::get('delete_group/{id}',[GroupController::class,'delete_group']);

    // Route for Category
    Route::get('category',[GroupController::class,'category']);
    Route::get('add-category',[GroupController::class,'add_category']);
    Route::post('adding_category',[GroupController::class,'adding_category']);
    Route::get('edit_category/{id}',[GroupController::class,'edit_category']);
    Route::post('update_category/{id}',[GroupController::class,'update_category']);
    Route::get('delete_category/{id}',[GroupController::class,'delete_category']);

    // Route for Sub_Category
    Route::get('sub_category',[GroupController::class,'sub_category']);
    Route::get('add-sub_category',[GroupController::class,'add_sub_category']);
    Route::post('adding_sub_category',[GroupController::class,'adding_sub_category']);
    Route::get('edit_sub_category/{id}',[GroupController::class,'edit_sub_category']);
    Route::post('update_sub_category/{id}',[GroupController::class,'update_sub_category']);
    Route::get('delete_sub_category/{id}',[GroupController::class,'delete_sub_category']);

    // Route for Item
    Route::get('item',[GroupController::class,'item']);
    Route::get('add-item',[GroupController::class,'add_item']);
    Route::post('adding_item',[GroupController::class,'adding_item']);
    Route::get('edit_item/{id}',[GroupController::class,'edit_item']);
    Route::post('update_item/{id}',[GroupController::class,'update_item']);
    Route::get('delete_item/{id}',[GroupController::class,'delete_item']);

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

    // Showing Sub Category Item
    Route::get('show_sub/{id}',[GroupController::class,'show_sub']);
    Route::get('show_sub/items/{id}',[GroupController::class,'show_items']);
    Route::get('product/{id}',[GroupController::class,'product']);

});