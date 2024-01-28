<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentGateway;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'index']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/admin',[HomeController::class,'admin'])->middleware(['auth']);

Route::get('/view-category',[AdminController::class,'view_category'])->middleware(['adminAuth']);

Route::get('/fetch-category',[AdminController::class,'fetch_category'])->middleware(['adminAuth']);

Route::post('/add-category',[AdminController::class,'add_category'])->middleware(['adminAuth']);

Route::delete('/delete-cat/{id}',[AdminController::class,'delete_category'])->middleware(['adminAuth']);

/** For product **/

Route::get('/add-product',[AdminController::class,'form_product'])->middleware(['adminAuth']);

Route::post('/adds-product',[AdminController::class,'add_product'])->middleware(['adminAuth']);

Route::get('/view-product',[AdminController::class,'view_prod'])->middleware(['adminAuth']);

Route::get('/view-ajax-product',[AdminController::class,'view_ajax_prod'])->middleware(['adminAuth']);

Route::delete('/delete-product/{id}',[AdminController::class,'delete_product'])->middleware(['adminAuth']);

Route::get('/edit-product/{id}',[AdminController::class,'edit_product'])->middleware(['adminAuth']);

Route::post('/update-product/{id}',[AdminController::class,'update_product'])->middleware(['adminAuth']);

/** Product frontend **/

Route::get('/product-detail/{id}',[HomeController::class,'product_detail']);

/** cart page**/

Route::get('/cart-page',[HomeController::class,'view_carts'])->middleware(['auth']);

Route::post('/cart-page/{id}',[HomeController::class,'add_carts'])->middleware(['auth']);

Route::post('/cart-update',[HomeController::class,'cart_update'])->middleware(['auth']);

Route::get('/fetch-cart',[HomeController::class,'fetch_cart'])->middleware(['auth']);

Route::get('/cart-fetch',[HomeController::class,'fetch_cart'])->middleware(['auth']);

Route::delete('/delete-cart/{id}',[HomeController::class,'delete_cart'])->middleware(['auth']);

/** Checkout **/

Route::get('/checkout',[PaymentGateway::class,'checkout_view'])->name('checkout')->middleware(['auth']);
Route::post('/user-detail',[HomeController::class,'user_details'])->name('user.detail')->middleware(['auth']);

/** Payment Gateway **/

Route::post('/make-order',[PaymentGateway::class,'make_order'])->name('make.order')->middleware(['auth']);

Route::get('/order-success',[PaymentGateway::class,'order_success'])->name('order.success')->middleware(['auth']);


