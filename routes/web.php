<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\superadmin\superadminController;
use App\Http\Controllers\Vindor\VindorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseSectionController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('view/categories/{id}', [HomeController::class, 'viewCategory'])->name('view.categories');
Route::get('view/products/{slug}', [HomeController::class, 'viewProduct'])->name('view.products');

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::post('/cart', [CartController::class, 'index'])->name('cart.add');
    Route::get('/viewcart', [CartController::class, 'viewcart'])->name('cart.index');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('order.place');
    Route::get('/payment/{order}', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('customer/orders', [OrderController::class, 'index'])->name('customer.orders');

});


Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/superadmin/dashboard', [superadminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('users/index', [superadminController::class, 'usersIndex'])->name('users.index');
    Route::get('vendors/index',[superadminController::class,'vindoer'])->name('vendors.index');
    Route::patch('/vendors/{id}/status',[superadminController::class,'updateStatus'])->name('vendors.status');
});


Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VindorController::class, 'index'])->name('vendor.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    Route::post('/ai/generate-description', [AIController::class, 'generateDescription'])->name('ai.generate.description');
    Route::get('/vendor/orders', [VindorController::class, 'orders'])->name('vendor.orders');
    Route::get('/orders/{id}', [VindorController::class, 'show'])->name('orders.show');

    // categories route

    Route::resource('categories',CourseCategoryController::class);
    //course
    Route::resource('course',CourseController::class);

    //course-sections
Route::resource(
    'sections',
    CourseSectionController::class
);

});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
