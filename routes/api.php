<?php

use App\Http\Controllers\Address\AddressController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\User\UserController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});

//Route::post('/register', [AuthController::class, 'signUp']);
//Route::post('/login', [AuthController::class, 'login']);
//Route::post('/logout', [AuthController::class, 'logout']);

// Защита маршрутов для корзины
Route::middleware(['auth.sanctum'])->group(function () {
    Route::post('/carts/{cart}/addItem', [CartController::class, 'addItem']);
    Route::get('/carts/{cart}/getCurrentItems', [CartController::class, 'getCurrentItems']);
});

Route::resources([
    'addresses' => AddressController::class,
    'carts' => CartController::class,
    'categories' => CategoryController::class,
    'orders' => OrderController::class,
    'products' => ProductController::class,
    'roles' => RoleController::class,
    'users' => UserController::class,
]);

// Роут для получения продуктов по категориям
Route::get('/products/category/{categoryId}', [ProductController::class, 'getByCategory']);

// Роут для добавления товара в корзину
Route::post('/carts/{cart}/addItem', [CartController::class, 'addItem']);
Route::get('/carts/{cart}/getCurrentItems', [CartController::class, 'getCurrentItems']);

// Защита маршрутов для корзины
Route::middleware(['auth'])->group(function () {
    Route::post('/orders/{order}/addItem', [OrderController::class, 'addOrder']);
    Route::get('/orders/{order}/getCurrentItems', [OrderController::class, 'getCurrentOrder']);
});
