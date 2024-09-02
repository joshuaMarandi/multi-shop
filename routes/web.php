<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendantController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

// Product and Order routes
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);

// Public routes for shops
Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shops.show');

// Authentication routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes for user profile
Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');

// Middleware groups for authenticated users
Route::middleware(['auth'])->group(function () {
    // General route for creating shops (accessible to both admins and attendants)
    Route::get('/shops/create', [ShopController::class, 'create'])->name('shops.create');
    Route::post('/shops', [ShopController::class, 'store'])->name('shops.store');
});

// Middleware groups for admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Admin-specific routes for managing shops
    Route::get('/admin/shops/create', [ShopController::class, 'create'])->name('admin.shops.create');
    Route::post('/admin/shops', [ShopController::class, 'store'])->name('admin.shops.store');
    Route::get('/admin/shops/{shop}/edit', [ShopController::class, 'edit'])->name('admin.shops.edit');
    Route::put('/admin/shops/{shop}', [ShopController::class, 'update'])->name('admin.shops.update');
    Route::delete('/admin/shops/{shop}', [ShopController::class, 'destroy'])->name('admin.shops.destroy');

    // Admin routes for managing attendants
    Route::get('/admin/attendants/create', [AdminController::class, 'createAttendant'])->name('admin.attendants.create');
    Route::post('/admin/attendants', [AdminController::class, 'storeAttendant'])->name('admin.attendants.store');
});

// Middleware groups for attendants
Route::middleware(['auth', 'role:attendant'])->group(function () {
    Route::get('/shop/{shop}/attendant', [AttendantController::class, 'index'])->name('attendant.dashboard');

    // Routes for attendants to create a shop
    Route::get('/attendant/shops/create', [ShopController::class, 'create'])->name('attendant.shops.create');
    Route::post('/attendant/shops', [ShopController::class, 'store'])->name('attendant.shops.store');
});

// Resource routes for shops (excluding public and create/store routes)
Route::resource('shops', ShopController::class)->except(['index', 'show', 'create', 'store']);



// routes/web.php

// Routes for attendants to manage products
Route::middleware(['auth', 'role:attendant'])->group(function () {
    Route::get('/attendant/products/create', [ProductController::class, 'create'])->name('attendant.products.create');
    Route::post('/attendant/products', [ProductController::class, 'store'])->name('attendant.products.store');
});


// Route to display the form (GET request)
Route::get('/attendant/products/create', [ProductController::class, 'create'])->name('attendant.products.create');

// Route to handle the form submission (POST request)
Route::post('/attendant/products', [ProductController::class, 'store'])->name('attendant.products.store');


Route::resource('categories', CategoryController::class);



