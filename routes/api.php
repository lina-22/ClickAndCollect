<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductAvailableController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ProductLineController;
use App\Http\Controllers\api\ReservationController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\UserController;
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

Route::get('/demo', function () {
    return "From Api";
});

// Route::get('test', function(){
//     $user = User::create([
//         'first_name' =>'Something',
//         'last_name' =>'new Something',
//         'password' =>'123456789',
//         'email' =>'new Somehjj@hk.com'

//     ])
// });


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Category Routes
Route::get('categories', [CategoryController::class, 'showAll']);
Route::get('categories/{id}', [CategoryController::class, 'showSingle']);

// Routes for products
Route::get('products', [ProductController::class, 'showAll']);
Route::get('products/{id}', [ProductController::class, 'showSingle']);


// Routes for productAvailable
Route::get('productsAvailable', [ProductAvailableController::class, 'showAll']);
Route::get('productsAvailable/{id}', [ProductAvailableController::class, 'showSingle']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/{id}', [CategoryController::class, 'destroy']);

    Route::put('updateprofile', [UserController::class, 'updateProfile']);
    Route::put('updatepassword', [UserController::class, 'updatePassword']);
    Route::put('updateemail', [UserController::class, 'updateEmail']);

    // Route for productLine
    Route::get('productsLine', [ProductLineController::class, 'showAll']);
    Route::post('productsLine', [ProductLineController::class, 'store']);

    Route::post('productsLine/increment', [ProductLineController::class, 'quantityincrement']);
    Route::post('productsLine/decrement', [ProductLineController::class, 'quantitydecrement']);

    Route::get('productsLine/{id}', [ProductLineController::class, 'showSingle']);
    Route::put('productsLine/{id}', [ProductLineController::class, 'update']);
    Route::delete('productsLine/{id}', [ProductLineController::class, 'destroy']);

    // Routes for products
    Route::post('products/{id}/attach_category', [ProductController::class, 'attachCategory']);
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    Route::post('productsAvailable', [ProductAvailableController::class, 'store']);
    Route::put('productsAvailable/{id}', [ProductAvailableController::class, 'update']);
    Route::delete('productsAvailable/{id}', [ProductAvailableController::class, 'destroy']);


    // Route for reservation
    Route::get('reservations', [ReservationController::class, 'showAll']);
    Route::get('reservations/{id}', [ReservationController::class, 'showSingle']);
    Route::post('reservations', [ReservationController::class, 'store']);
    Route::put('reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('reservations/{id}', [ReservationController::class, 'destroy']);

    // Route for users
    Route::get('users', [UserController::class, 'showAll']);
    Route::get('users/{id}', [UserController::class, 'showSingle']);

    Route::post('users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);

    Route::delete('users/{id}', [UserController::class, 'destroy']);

    // Route for roles
    Route::get('roles', [RoleController::class, 'showAll']);
    Route::get('roles/{id}', [RoleController::class, 'showSingle']);
    Route::post('roles', [RoleController::class, 'store']);
    Route::put('roles/{id}', [RoleController::class, 'update']);
    Route::delete('roles/{id}', [RoleController::class, 'destroy']);

    // end****
});
// Routes for categoris











// // Route for passwordsResets
// Route::get('passwordsResets', [PasswordResetController::class, 'showAll']);
// Route::get('passwordsResets/{id}', [PasswordResetController::class, 'showSingle']);
// Route::post('passwordsResets', [PasswordResetController::class, 'store']);
// Route::put('passwordsResets/{id}', [PasswordResetController::class, 'update']);
// Route::delete('passwordsResets/{id}', [PasswordResetController::class, 'destroy']);
