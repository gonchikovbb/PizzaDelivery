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

// Аутентификация
Route::post('/auth/sign-in', [AuthController::class, 'signIn']); // Вход пользователя
Route::post('/auth/sign-up', [AuthController::class, 'signUp']); // Регистрация пользователя
Route::post('/auth/sign-out', [AuthController::class, 'signOut']); // Выход пользователя
Route::get('/auth/refresh', [AuthController::class, 'refresh']); // Обновление токена
Route::get('/auth/user-info', [AuthController::class, 'userInfo']); // Получение информации о пользователе

// Ресурсные маршруты для пользователей, адресов, корзин и заказов
Route::resources([
    'users' => UserController::class, // Управление пользователями
    'addresses' => AddressController::class, // Управление адресами
    'carts' => CartController::class, // Управление корзинами
    'orders' => OrderController::class, // Управление заказами
]);

// Роут для получения продуктов по категориям
Route::get('/products', [ProductController::class, 'index'])->name('api.products.index'); // Получить список товаров
Route::get('/products/{product}', [ProductController::class, 'show'])->name('api.products.show'); // Получить товар по ID
Route::get('/products/category/{categoryId}', [ProductController::class, 'getByCategory'])->name('api.products.getByCategory'); // Получить товары по категории

// Роуты для управления корзиной
Route::post('/carts/{cart}/addItem', [CartController::class, 'addItem'])->name('api.carts.addItem'); // Добавить товар в корзину
Route::get('/carts/{cart}/getCurrentItems', [CartController::class, 'getCurrentItems'])->name('api.carts.getCurrentItems'); // Получить текущие товары в корзине

// Роуты для управления заказами для пользователя
Route::middleware(['auth:api'])->prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('api.admin.orders.index'); // Получить список заказов
    Route::post('/', [OrderController::class, 'store'])->name('api.admin.orders.store'); // Создать новый заказ
    Route::get('/{order}', [OrderController::class, 'show'])->name('api.admin.orders.show'); // Получить заказ по ID
});

// Ресурсные маршруты админа
Route::prefix('admin')->middleware(['auth:api', 'admin'])->group(function () {
    Route::apiResource('products', ProductController::class); // Управление товарами
    Route::apiResource('roles', RoleController::class); // Управление ролями
    Route::apiResource('categories', CategoryController::class); // Управление категориями
    Route::apiResource('orders', OrderController::class); // Управление заказами
});





