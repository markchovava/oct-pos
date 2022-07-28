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
/* Route::get('/pos/searchbyname', [POSController::class, 'searchbyname'])->name('pos.searchbyname');
Route::get('/pos', [POSController::class, 'index'])->name('admin.pos'); */
/*  */
Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
Route::get('/register', [AdminAuthController::class, 'register'])->name('register');
Route::post('/register', [AdminAuthController::class, 'register_process'])->name('register.process');

Route::middleware(['auth'])->prefix('admin')->group(function(){ 
    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::get('/register', [AdminAuthController::class, 'register'])->name('admin.register');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    /* Point of Sale */
    Route::get('/pos/searchbyname', [POSController::class, 'searchbyname'])->name('admin.pos.searchbyname');
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
