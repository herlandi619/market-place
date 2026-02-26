<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
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
    
    //  USER Manajement START
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');

    // Toogle Status
    Route::patch('/users/{user}/toggle-status',
            [UserController::class, 'toggleStatus'])
            ->name('admin.users.toggleStatus');

    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');

    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');

    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');

    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    //  USER Manajement END

    // Manajemen Kategori Produk START
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');

    Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');

    Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');

    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/{category:name}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');

    Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');

    // Manajemen Kategori Produk END

    // Manajemen Transaksi START
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');

    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
        ->name('admin.orders.updateStatus');

    // Manajemen Transaksi END

    // Payment START
    Route::get('/payments', [PaymentsController::class, 'index'])->name('admin.payments.index');

    Route::put('/payments/{payment}/approve', [PaymentsController::class, 'approve'])
        ->name('admin.payments.approve');

    Route::put('/payments/{payment}/reject', [PaymentsController::class, 'reject'])
        ->name('admin.payments.reject');

    // Payment END
});


// ADMIN END--------------------------------------------------------------------------------
require __DIR__.'/auth.php';
