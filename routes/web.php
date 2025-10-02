<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Admin\AdminOrdersController;
use App\Http\Controllers\Admin\CustomerOrdersController as AdminCustomerOrdersController;
use App\Http\Controllers\Customer\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public homepage
Route::get('/', function () {
    return view('welcome');
});

// Customer Dashboard (requires login)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Profile Status (for logged in users)
Route::get('/profile-status', function () {
    return view('auth.profile-status');
})->middleware(['auth'])->name('profile.status');



//Single dashboard route without /admin prefix 
Route::get('/admindashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admindashboard');

// The rest of admin routes under /admin/*
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // Profile
    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('profile');

    // Products
    Route::resource('products', ProductController::class);

    // Orders (Admin OrdersController)
    Route::get('/orders', [AdminOrdersController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrdersController::class, 'show'])->name('orders.show');


    Route::patch('/orders/{id}/status', [AdminCustomerOrdersController::class, 'updateStatus'])
        ->name('orders.updateStatus');


    Route::get('/customer-orders', [AdminCustomerOrdersController::class, 'index'])->name('customerOrders.index');
    Route::get('/customer-orders/{id}', [AdminCustomerOrdersController::class, 'show'])->name('customerOrders.show');
    Route::patch('/customer-orders/{id}/status', [AdminCustomerOrdersController::class, 'updateStatus'])->name('customerOrders.updateStatus');

    // Contact Messages
    Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{id}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
});

/*
|--------------------------------------------------------------------------
| Customer shop / cart / checkout
|--------------------------------------------------------------------------
*/

// Customer Shop
Route::get('/shop', [CustomerProductController::class, 'index'])->name('shop.index');

// Product details only for logged-in users
Route::get('/shop/{product}', [CustomerProductController::class, 'show'])
    ->middleware('auth')
    ->name('shop.show');

// Category-specific shop pages
Route::get('/skincare', [CustomerProductController::class, 'skincare'])->name('shop.skincare');
Route::get('/haircare', [CustomerProductController::class, 'haircare'])->name('shop.haircare');
Route::get('/cosmetics', [CustomerProductController::class, 'cosmetics'])->name('shop.cosmetics');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/confirmation/{id}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

// Customer Orders
Route::middleware(['auth'])->group(function () {
    Route::get('/account/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/account/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// Contact Us (Customer Side)
Route::get('/contact', function () {
    return view('customer.contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// About Us (Public Page)
Route::get('/about', function () {
    return view('about');
})->name('about');


