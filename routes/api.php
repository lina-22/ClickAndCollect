<?php

use App\Http\Models\Category;

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/demo',function(){
//     return "From Lina's Api";
// });

                       // Routes for categoris
Route::get('categories', [CategoryController::class, 'showAll']);
Route::get('categories/{id}', [CategoryController::class, 'showSingle']);
Route::post('categories', [CategoryController::class, 'store']);
Route::put('categories/{id}', [CategoryController::class, 'update']);
Route::delete('categories/{id}', [CategoryController::class, 'destroy']);

                        // Routes for products
Route::get('products', [ProductController::class, 'showAll']);
Route::get('products/{id}', [ProductController::class, 'showSingle']); 
Route::post('products', [ProductController::class, 'store']);
Route::put('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy']);
