<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

/*------------------------------------------
All Normal Users Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
All Admin Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::view('/admin/index', 'admin.index');
    Route::resource('/admin/products', ProductController::class);
    Route::delete('/admin/products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::put('/admin/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::resource('/admin/categories', CategoriesController::class);
    Route::delete('/admin/categories/destroy/{id}', [CategoriesController::class, 'destroy'])->name('products.destroy');
    Route::put('/admin/categories/update/{id}', [CategoriesController::class, 'update'])->name('products.update');
    Route::resource('/admin/pos', PosController::class);
    Route::resource('/admin/users', UsersController::class);
    Route::put('/admin/users/update/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/admin/users/destroy/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/sales-history', [OrderController::class, 'salesHistory'])->name('sales.history');
    Route::get('/admin/sales-history/{id}', [OrderController::class, 'salesDetail'])->name('sales.detail');
    Route::get('/admin/stock', [StockController::class, 'index'])->name('admin.stock');
    Route::post('/admin/stock/{id}/add', [StockController::class, 'addStock'])->name('stock.add');
    Route::post('/admin/stock/{id}/reduce', [StockController::class, 'reduceStock'])->name('stock.reduce');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // POS
    Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
    Route::post('/pos/add-to-cart', [POSController::class, 'addToCart'])->name('pos.addToCart');
    Route::get('/pos/calculate-total', [POSController::class, 'calculateTotal'])->name('pos.calculateTotal');
    Route::post('/pos/checkout', [POSController::class, 'checkout'])->name('pos.checkout');

});

/*------------------------------------------
All Member Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:member'])->group(function () {
  
    Route::get('/member/home', [HomeController::class, 'memberHome'])->name('member.home');
});


/*------------------------------------------
All API Routes List
--------------------------------------------*/
Route::post('/api/orders', [OrderController::class, 'store']);
