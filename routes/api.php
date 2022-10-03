<?php

use App\Http\Controllers\AccountApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogApiController;
use App\Http\Controllers\CheckoutApiController;
use App\Http\Controllers\OrderApiController;
use App\Http\Controllers\ProductsApiController;
use App\Models\User;
use GrahamCampbell\ResultType\Success;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>'api','prefix'=>'auth'], function($router){
    Route::post('/register',[AuthController::class, 'register']);
    Route::post('/login',[AuthController::class, 'login']);
    Route::get('/profile',[AuthController::class, 'profile']);
    Route::post('/logout',[AuthController::class, 'logout']);
    
});
//Product
Route::get('/products',[ProductsApiController::class,'index']); 
Route::post('/products',[ProductsApiController::class,'store']);
Route::put('/products/{id}',[ProductsApiController::class,'update']);
Route::delete('/products/{id}',[ProductsApiController::class,'destroy']);
Route::get('/search',[ProductsApiController::class,'search']);
Route::get('/products/{product}',[ProductsApiController::class,'getProductByID']);
//Account
Route::get('/user',[AccountApiController::class,'getUserAccount']);
Route::put('/user',[AccountApiController::class,'update']);
//Checkout
Route::post('checkout',[CheckoutApiController::class,'store']);

//Order
Route::get('orders',[OrderApiController::class,'getAllOrderByAdmin']);
Route::put('change-order-status',[OrderApiController::class,'changeStatus']);

//Blog
Route::get('blogs',[BlogApiController::class,'index']);
Route::post('blogs',[BlogApiController::class,'store']);
Route::put('blogs/{id}',[BlogApiController::class,'update']);
Route::delete('blogs/{id}',[BlogApiController::class,'destroy']);





