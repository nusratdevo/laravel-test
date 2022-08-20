<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Rest Api with ecom
   Route::post('register', [Api\RegisterController::class, 'register']);
   Route::post('login', [Api\RegisterContrller::class, 'login']);
   Route::apiResource('/product', [ProductController::class]);
   Route::group(['prefix'=>'products'], function(){
       Route::apiResource('/{product}/reviews', [ReviewController::class]);
   });

//////



Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::get('blogs', [BlogController::class, 'index']);
Route::post('add-blog', [BlogConteoller::class, 'store']);
Route::get('edit-blog/{id}', [BlogController::class, 'edit']);
Route::post('update-blog/{id}', [BlogController::class, 'update']);
Route::delete('delete-blog/{id}', [Blogcontroller::class, 'destroy']);


