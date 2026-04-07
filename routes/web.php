<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard (home)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/search', [DashboardController::class, 'search'])->name('search');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/image/{imageId}', [ProductController::class, 'destroyImage'])->name('products.image.destroy');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Sales / Orders
    Route::get('/sales', [SalesController::class, 'index'])->name('sales');
    Route::get('/orders/create', [SalesController::class, 'create'])->name('orders.create');
    Route::post('/orders', [SalesController::class, 'store'])->name('orders.store');
    Route::get('/sales/{id}', [SalesController::class, 'show'])->name('sales.show');
    Route::post('/sales/{id}/feedback', [SalesController::class, 'saveFeedback'])->name('sales.feedback');
    Route::get('/orders/{id}/edit', [SalesController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}', [SalesController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [SalesController::class, 'destroy'])->name('orders.destroy');

    // Customers / Clients
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::get('/clients/create', [CustomerController::class, 'create'])->name('clients.create');
    Route::post('/clients', [CustomerController::class, 'store'])->name('clients.store');
    Route::get('/clients/{id}', [CustomerController::class, 'show'])->name('clients.show');
    Route::get('/clients/{id}/edit', [CustomerController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}', [CustomerController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}', [CustomerController::class, 'destroy'])->name('clients.destroy');

    // Export
    Route::get('/export', [ExportController::class, 'export'])->name('export');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

    // Schedule
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');

    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/{id}/feedback', [ProjectController::class, 'saveFeedback'])->name('projects.feedback');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/projects/{id}/track', [ProjectController::class, 'track'])->name('projects.track');

    // Profile & Settings
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('settings.password');

    // Cloudinary
    Route::resource('images', ImageController::class);
});
