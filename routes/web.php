<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    //category
    Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/save', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');

    //Product
    Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/save', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/{id}/delete', [ProductController::class, 'delete'])->name('product.delete');
});

   //cart
   Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
   Route::get('/product-view/{id}', [CartController::class, 'productView'])->name('product-view');
   Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
   Route::get('/show-cart', [CartController::class, 'showCart'])->name('show-cart');
   Route::get('/place-oder', [CartController::class, 'placeOrder'])->name('place-order');
   Route::post('/add-shipping', [CartController::class, 'addShippingData'])->name('add-shippng');
   Route::get('/payment-view', [CartController::class, 'paymentView'])->name('payment.view');
   Route::get('/payment', [CartController::class, 'payment'])->name('payment');
