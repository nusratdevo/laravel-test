<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LaracrudController;
use App\Http\Controllers\CompanyConroller;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Auth')->group(function(){
Route::get('/login', 'LoginController@show_login')->name('login');
});
Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart-product', [CartController::class, 'cartProduct'])->name('cart');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-cart', [CartController::class, 'remove'])->name('remove.from.cart');


Route::get('/laracrud', [LaracrudController::class, 'view'])->name('crud.index');
Route::get('/laracrud-getdata', [LaracrudController::class, 'data'])->name('crud.data');
Route::get('/laracrud-add', [LaracrudController::class, 'add'])->name('crud.add');
Route::post('/laracrud-store', [LaracrudController::class, 'store'])->name('crud.store');
Route::get('/laracrud-edit/{id}', [LaracrudController::class, 'update'])->name('crud.update');
Route::delete('/laracrud-delele/{id}', [LaracrudController::class, 'destroy'])->name('crud.destroy');


// Compan routes for Ajax crud
Route::get('/company', [CompanyController::class, 'view'])->name('company.index');
Route::get('/companies', [CompanyController::class, 'get_company_data'])->name('data');
Route::get('addcompany', [CompanyController::class, 'view'])->name('company.view');
Route::post('/addcompany', [CompanyController::class, 'Store'])->name('company.store');
Route::delete('/addcompany/{id}', [CompanyController::class, 'destroy']);
Route::get('/addcompany/{id}/edit', [CompanyController::class, 'update'])->name('company.update');


///Repository Route
Route::get('/user', 'UserController@showUser')->name('user.list');
Route::get('/users', 'UserController@showUsers')->name('user.list');
Route::get('/user/create', 'UserController@createUser')->name('user.create');
Route::post('/user/create', 'UserController@saveUser');
Route::get('/user/edit/{id}', 'UserController@getUser')->name('user.edit');
Route::put('/user/edit/{id}', 'UserController@saveUser')->name('user.update');
Route::get('/user/delete/{id}', 'UserController@deleteUser')->name('user.delete');