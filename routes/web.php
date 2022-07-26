<?php

use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\POS\POSController;
use App\Http\Controllers\Product\ProductController;


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
Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::get('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
/* Point of Sale */
Route::get('/admin/pos', [POSController::class, 'index'])->name('admin.pos');
Route::get('/admin/pos/searchbyname', [POSController::class, 'searchbyname'])->name('admin.pos.searchbyname');
Route::get('/admin/customer', [CustomerController::class, 'index'])->name('admin.customer');

Route::get('/admin/product/add', [ProductController::class, 'add'])->name('admin.product.add');
Route::post('/admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');
Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product.index');
Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
Route::post('/admin/product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
Route::get('/admin/product/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');

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
