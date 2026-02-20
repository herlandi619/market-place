<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');




// BUYERRR --------------------------------------------------------------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // CART
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.remove');


    // CHECKOUT
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');


    // PAYMENT
    Route::get('/payment/{order}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/{order}', [PaymentController::class, 'store'])->name('payment.store');

    // ORDER
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');


});

// BUYERRR --------------------------------------------------------------------------------

// ADMIN START --------------------------------------------------------------------------------
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // List
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');

    // Toogle Status
    Route::patch('/users/{user}/toggle-status',
            [UserController::class, 'toggleStatus'])
            ->name('admin.users.toggleStatus');

});


// ADMIN END--------------------------------------------------------------------------------
require __DIR__.'/auth.php';
