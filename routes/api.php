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

Route::group(['prefix' => 'v1'], function(){
    
    /**
     * Public routes
     */
    // Register/Login User
    Route::post('/register', [App\Http\Controllers\Api\V1\Auth\AuthController::class, 'register']);
    Route::post('/login', [App\Http\Controllers\Api\V1\Auth\AuthController::class, 'login']);

    // Show all products
    Route::get('/products', [App\Http\Controllers\Api\V1\ProductController::class, 'index']);
    // Show one product
    Route::get('/products/{id}', [App\Http\Controllers\Api\V1\ProductController::class, 'show']);

    /**
     * Protected routes
     */
    Route::group(['middleware' => ['auth:sanctum']], function(){
        
        // Products
        Route::post('/products', [App\Http\Controllers\Api\V1\ProductController::class, 'store']);
        Route::put('/products/{id}', [App\Http\Controllers\Api\V1\ProductController::class, 'update']);
        Route::delete('/products/{id}', [App\Http\Controllers\Api\V1\ProductController::class, 'destroy']);    

        // Logout
        Route::post('/logout', [App\Http\Controllers\Api\V1\Auth\AuthController::class, 'logout']);
    });
    
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
