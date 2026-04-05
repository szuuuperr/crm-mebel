<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "web" middleware group. Make something great! | */

// Dashboard (home)
Route::get('/', function () {
    return view('pages.dashboard', ['activePage' => 'dashboard']);
})->name('dashboard');

// Products
Route::get('/products', function () {
    return view('pages.products', ['activePage' => 'products']);
})->name('products');

// Sales
Route::get('/sales', function () {
    return view('pages.sales', ['activePage' => 'sales']);
})->name('sales');

// Customers
Route::get('/customers', function () {
    return view('pages.customers', ['activePage' => 'customers']);
})->name('customers');

// Analytics
Route::get('/analytics', function () {
    return view('pages.analytics', ['activePage' => 'analytics']);
})->name('analytics');

// Settings
Route::get('/settings', function () {
    return view('pages.settings', ['activePage' => 'settings']);
})->name('settings');

// Login
Route::get('/login', function () {
    return view('pages.login');
})->name('login');

// ===== Supporting Pages =====

// Product Detail
Route::get('/products/create', function () {
    return view('pages.products.create', ['activePage' => 'products']);
})->name('products.create');

Route::get('/products/{id}', function ($id) {
    return view('pages.products.show', ['activePage' => 'products', 'id' => $id]);
})->name('products.show');

Route::get('/products/{id}/edit', function ($id) {
    return view('pages.products.edit', ['activePage' => 'products', 'id' => $id]);
})->name('products.edit');

// Orders
Route::get('/orders/create', function () {
    return view('pages.orders.create', ['activePage' => 'sales']);
})->name('orders.create');

// Projects
Route::get('/projects/create', function () {
    return view('pages.projects.create', ['activePage' => 'dashboard']);
})->name('projects.create');

Route::get('/projects/{id}/track', function ($id) {
    return view('pages.projects.track', ['activePage' => 'dashboard', 'id' => $id]);
})->name('projects.track');

// Clients
Route::get('/clients/create', function () {
    return view('pages.clients.create', ['activePage' => 'customers']);
})->name('clients.create');

Route::get('/clients/{id}/edit', function ($id) {
    return view('pages.clients.edit', ['activePage' => 'customers', 'id' => $id]);
})->name('clients.edit');

// ===== Tahap 3 - Supporting Pages =====

// Sales Detail
Route::get('/sales/{id}', function ($id) {
    return view('pages.sales.show', ['activePage' => 'sales', 'id' => $id]);
})->name('sales.show');

// Profile
Route::get('/profile', function () {
    return view('pages.profile', ['activePage' => 'settings']);
})->name('profile');

// Client Detail
Route::get('/clients/{id}', function ($id) {
    return view('pages.clients.show', ['activePage' => 'customers', 'id' => $id]);
})->name('clients.show');

// Notifications
Route::get('/notifications', function () {
    return view('pages.notifications', ['activePage' => 'dashboard']);
})->name('notifications');

// Schedule
Route::get('/schedule', function () {
    return view('pages.schedule', ['activePage' => 'dashboard']);
})->name('schedule');
