<?php

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

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/pos', [POSController::class, 'index'])->name('admin.pos');
Route::get('/admin/customer', [CustomerController::class, 'index'])->name('admin.customer');
Route::get('/admin/product/add', [ProductController::class, 'add'])->name('admin.product.add');
Route::post('/admin/product/store', [ProductController::class, 'store'])->name('admin.product.store');

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
