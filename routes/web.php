<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Category\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\POS\POSController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Role\RoleController;

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
/* Route::get('/pos/searchbyname', [POSController::class, 'searchbyname'])->name('pos.searchbyname');
Route::get('/pos', [POSController::class, 'index'])->name('admin.pos'); */
/*  */
Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
Route::get('/register', [AdminAuthController::class, 'register'])->name('register');
Route::post('/register', [AdminAuthController::class, 'register_process'])->name('register.process');
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->group(function(){

    /* Brands Management */
    Route::prefix('brand')->group(function() {
        Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index');
        Route::get('/add', [BrandController::class, 'add'])->name('admin.brand.add');
        Route::post('/store', [BrandController::class, 'store'])->name('admin.brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
        Route::post('/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
        Route::get('/search', [BrandController::class, 'search'])->name('admin.brand.search');
        Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');
    });
    
    /* Categories */
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/category/add', [CategoryController::class, 'add'])->name('admin.category.add');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/search', [CategoryController::class, 'search'])->name('admin.category.search');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');

    /*  */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    /* Point of Sale */
    Route::get('/pos/searchbyname', [POSController::class, 'searchbyname'])->name('admin.pos.searchbyname');
    Route::get('/pos/searchbybarcode', [POSController::class, 'searchbybarcode'])->name('admin.pos.searchbybarcode');
    Route::get('/pos', [POSController::class, 'index'])->name('admin.pos');
    Route::post('/pos', [POSController::class, 'process'])->name('admin.pos.process');
    
    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer');

    Route::prefix('product')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('/add', [ProductController::class, 'add'])->name('admin.product.add');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
    });
    /* Role  */
    Route::get('/role', [RoleController::class, 'index'])->name('admin.role.index');
    Route::get('/role/add', [RoleController::class, 'add'])->name('admin.role.add');
    Route::post('/role/store', [RoleController::class, 'store'])->name('admin.role.store');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
    Route::post('/role/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
    Route::get('/role/delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
    Route::get('/role/search', [RoleController::class, 'search'])->name('admin.role.search');

    Route::prefix('order')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
    });

});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
