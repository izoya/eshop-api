<?php


use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\CategoryController;
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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);


Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product:id}', [ProductController::class, 'show']);
Route::get('/products/slug/{product:slug}', [ProductController::class, 'show']);

Route::post('/cart', [CartController::class, 'addToCart']);
Route::put('/cart', [CartController::class, 'updateCartItem']);
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart']);

Route::post('/orders', [OrderController::class, 'create']);


Route::middleware('auth:sanctum')->get('/orders', [OrderController::class, 'index']);
