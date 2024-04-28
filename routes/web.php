<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [IndexController::class, 'index'])->name('front.index');
Route::get('/contact', [IndexController::class, 'contact']);
Route::get('/shop', [IndexController::class, 'shop']);

Route::post('cart', [CartController::class, 'store']);
Route::delete('cart/{id}', [CartController::class, 'destroy']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'permission:back'])->group(function () {

    Route::resource('admin/brand', BrandController::class);

    Route::resource('admin/category', CategoryController::class);

    Route::resource('admin/supplier', SupplierController::class);

    Route::resource('admin/product', ProductController::class);

    Route::get('admin/permission', [PermissionController::class, 'index']);
    Route::post('admin/permission', [PermissionController::class, 'store']);
    Route::get('/admin/permission/{id}/edit', [PermissionController::class, 'edit']);
    Route::patch('/admin/permission/{id}', [PermissionController::class, 'update']);
    Route::delete('/admin/permission/{id}', [PermissionController::class, 'destroy']);

    Route::get('admin/role', [RoleController::class, 'index']);
    Route::post('admin/role', [RoleController::class, 'store']);
    Route::get('/admin/role/{id}/edit', [RoleController::class, 'edit']);
    Route::patch('/admin/role/{id}', [RoleController::class, 'update']);
    Route::delete('/admin/role/{id}', [RoleController::class, 'destroy']);

    Route::get('admin/user', [UserController::class, 'index']);
    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit']);
    Route::patch('/admin/user/{id}', [UserController::class, 'update']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
