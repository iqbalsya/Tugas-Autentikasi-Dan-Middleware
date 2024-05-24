<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/checkout/{id}', [ProductController::class, 'checkout'])->name('checkout');

Route::post('/process-checkout/{id}', [ProductController::class, 'processCheckout'])->name('processCheckout');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');

Route::get('/form', [FormController::class, 'index'])->name('form.index');

Route::get('/tambah-produk', [ProductController::class, 'create'])->name('product.create');

Route::get('/form/{id}', [ProductController::class, 'edit'])->name('product.edit');

Route::put('/form/{id}', [ProductController::class, 'update'])->name('product.update');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register-user', [UserController::class, 'registerUser'])->name('register_user');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginUser'])->name('login_user');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');

Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::post('/products/import', [ProductController::class, 'import'])->name('product.import');

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::post('/admin/list-product', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/admin/list-product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/{id}/tambah_product', [ProductController::class, 'create'])->name('product.create');
    Route::post('/admin/list-product', [ProductController::class, 'store'])->name('product.create');
});
