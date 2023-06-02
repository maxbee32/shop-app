<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware'=>'api',
              'prefix'=>'v1'
],function($router){


Route::post("admin-signup","App\Http\Controllers\AdminController@adminSignUp");

Route::post("admin-login", "App\Http\Controllers\AdminController@adminLogin");

Route::post("add-product", "App\Http\Controllers\ProductController@productStore");

});



Route::group(['middleware'=>'api',
              'prefix'=>'user/v1'
],function($router){


    Route::post("list-product", "App\Http\Controllers\UserController@getProduct");

});
