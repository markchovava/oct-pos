<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Info\BasicInfoController;
use App\Http\Controllers\Operation\OperationController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\OrderItem\OrderItemController;
use App\Http\Controllers\PDF\PDFController;
use App\Http\Controllers\POS\POSController;
use App\Http\Controllers\Price\PriceController;
use App\Http\Controllers\Print\PrintController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Stock\StockController;
use App\Http\Controllers\Tax\TaxController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserStatusController;


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

Route::get('/', function(){
    if( auth()->check() ){
        return redirect()->route('admin.dashboard');
    }
    else{
        return redirect()->route('login');
    }
});

Route::get('/admin', function(){ 
    return redirect()->route('admin.dashboard');
});


Route::get('/print', [PrintController::class, 'print']);

/*  */
if( auth()->check() ){
    return redirect()->route('admin.dashboard');
}
else{
    Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
}

Route::get('/register', [AdminAuthController::class, 'register'])->name('register');
Route::post('/register', [AdminAuthController::class, 'register_process'])->name('register.process');
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'isOperator'])->prefix('admin')->group(function(){

    Route::get('/test', function(){
        $order = DB::table('orders')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as daily_orders'))
            ->groupBy('date')
            ->get();
        
        dd($order);
        //return $order;
    });

    
    Route::get('/print/html', [PrintController::class, 'print_html'])->name('admin.print.html');
    Route::get('/print/text', [PrintController::class, 'print_text'])->name('admin.print.text');
    /* PDF */
    Route::middleware(['isOperator'])->prefix('pdf')->group(function() {
        Route::get('/', [PDFController::class, 'reciept'])->name('admin.pdf.reciept');
    });
    Route::get('/user/status', [UserStatusController::class, 'status'])->name('admin.user.status');

    /* Brands Management */
    Route::middleware(['isEditor'])->prefix('brand')->group(function() {
        Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index');
        Route::get('/add', [BrandController::class, 'add'])->name('admin.brand.add');
        Route::post('/store', [BrandController::class, 'store'])->name('admin.brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
        Route::post('/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
        Route::get('/search', [BrandController::class, 'search'])->name('admin.brand.search');
        Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');
    });
    
    /* Categories */
    Route::middleware(['isEditor'])->prefix('category')->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/add', [CategoryController::class, 'add'])->name('admin.category.add');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/search', [CategoryController::class, 'search'])->name('admin.category.search');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    Route::middleware(['isEditor'])->prefix('info')->group(function() {
        Route::get('/', [BasicInfoController::class, 'index'])->name('admin.info.index');
        Route::get('/add', [BasicInfoController::class, 'add'])->name('admin.info.add');
        Route::post('/store', [BasicInfoController::class, 'store'])->name('admin.info.store');
        Route::get('/view/{id}', [BasicInfoController::class, 'view'])->name('admin.info.view');
        Route::get('/edit/{id}', [BasicInfoController::class, 'edit'])->name('admin.info.edit');
        Route::post('/update/{id}', [BasicInfoController::class, 'update'])->name('admin.info.update');
        Route::get('/search', [BasicInfoController::class, 'search'])->name('admin.info.search');
        Route::get('/delete/{id}', [BasicInfoController::class, 'delete'])->name('admin.info.delete');
    });

    /* Dashboard */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    /* Point of Sale */
    Route::middleware(['isOperator'])->prefix('pos')->group(function() {
        Route::get('/searchbyname', [POSController::class, 'searchbyname'])->name('admin.pos.searchbyname');
        Route::get('/searchbybarcode', [POSController::class, 'searchbybarcode'])->name('admin.pos.searchbybarcode');
        Route::get('/', [POSController::class, 'index'])->name('admin.pos');
        Route::post('/', [POSController::class, 'process'])->name('admin.pos.process');
    });
    /* Customer */
    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer');
    /* Price */

    /**
     *  Operator  
     **/
    Route::middleware(['isOperator'])->prefix('operation')->group(function() {
        Route::get('/', [OperationController::class, 'index'])->name('admin.operation.index');
        Route::get('/search', [OperationController::class, 'search'])->name('admin.operation.search');
        Route::get('/add', [OperationController::class, 'add'])->name('admin.operation.add');
        Route::post('/store', [OperationController::class, 'store'])->name('admin.operation.store');
        Route::get('/edit/{id}', [OperationController::class, 'edit'])->name('admin.operation.edit');
        Route::post('/update/{id}', [OperationController::class, 'update'])->name('admin.operation.update');
        Route::get('/view/{id}', [OperationController::class, 'view'])->name('admin.operation.view');
        Route::get('/delete/{id}', [OperationController::class, 'delete'])->name('admin.operation.delete');
        Route::get('/list', [OperationController::class, 'list'])->name('admin.operation.list');
        Route::get('/deletelist/{id}', [OperationController::class, 'deletelist'])->name('admin.operation.deletelist');
        Route::get('/searchlist', [OperationController::class, 'searchlist'])->name('admin.operation.searchlist');
    });

    Route::middleware(['isModerator'])->prefix('order')->group(function() {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
        Route::get('/view/{id}', [OrderController::class, 'view'])->name('admin.order.view');
        Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('admin.order.delete');
        Route::get('/searchview', [OrderController::class, 'searchview'])->name('admin.order.searchview');
        Route::get('/search', [OrderController::class, 'search'])->name('admin.order.search');
        Route::get('/daily', [OrderController::class, 'daily'])->name('admin.order.daily');
        Route::get('/daily/view/{date}', [OrderController::class, 'daily_view'])->name('admin.order.daily.view');
        Route::get('/daily/view/search', [OrderController::class, 'daily_search'])->name('admin.order.daily.search');
        Route::prefix('item')->group(function(){
            Route::get('/list/{id}', [OrderItemController::class, 'list'])->name('admin.item.list');
            Route::get('/searchlist', [OrderItemController::class, 'searchlist'])->name('admin.item.searchlist');
            Route::get('/delete/{id}', [OrderItemController::class, 'searchlist'])->name('admin.item.delete');
        });
    });
    

    Route::middleware(['isEditor'])->prefix('price')->group(function() {
        Route::get('/', [PriceController::class, 'index'])->name('admin.price.index');
        Route::get('/edit/{id}', [PriceController::class, 'edit'])->name('admin.price.edit');
        Route::post('/update/{id}', [PriceController::class, 'update'])->name('admin.price.update');
        Route::get('/search', [PriceController::class, 'search'])->name('admin.price.search');
    });
    /**
     *  Product 
     **/
    Route::middleware(['isEditor'])->prefix('product')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('/view/{id}', [ProductController::class, 'view'])->name('admin.product.view');
        Route::get('/add', [ProductController::class, 'add'])->name('admin.product.add');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
    });
    /**
     *  Role
     **/
    Route::middleware(['isModerator'])->prefix('role')->group(function() {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('/add', [RoleController::class, 'add'])->name('admin.role.add');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('admin.role.delete');
        Route::get('/search', [RoleController::class, 'search'])->name('admin.role.search');
    });
    
    Route::middleware(['isModerator'])->prefix('tax')->group(function() {
        Route::get('/', [TaxController::class, 'edit'])->name('admin.tax.edit');
        Route::post('/', [TaxController::class, 'update'])->name('admin.tax.update');
    });
    /** 
     *  User 
     **/
    Route::middleware(['isModerator'])->prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/search', [UserController::class, 'search'])->name('admin.user.search');
        Route::get('/add', [UserController::class, 'add'])->name('admin.user.add');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::get('/view/{id}', [UserController::class, 'view'])->name('admin.user.view');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
    });

     /* Profile */
     Route::middleware(['isOperator'])->prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'view'])->name('admin.profile.view');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::get('/password', [ProfileController::class, 'password'])->name('admin.profile.password');
        Route::post('/password/update', [ProfileController::class, 'password_update'])->name('admin.profile.password.update');
    });

    /* Sales */
    Route::prefix('sale')->group(function() {
        Route::get('/', [SaleController::class, 'index'])->name('admin.sale.index');
        Route::get('/add', [SaleController::class, 'add'])->name('admin.sale.add');
        Route::get('/view', [SaleController::class, 'view'])->name('admin.sale.view');
        Route::get('/search', [SaleController::class, 'search'])->name('admin.sale.search');
        Route::get('/daily', [SaleController::class, 'daily'])->name('admin.sale.daily');
        Route::get('/daily/list/{date}', [SaleController::class, 'daily_list'])->name('admin.sale.daily.list');
    });
    /** 
     *  Stock 
     **/
    Route::prefix('stock')->group(function() {
        Route::get('/', [StockController::class, 'index'])->name('admin.stock.index');
        Route::get('/search', [StockController::class, 'search'])->name('admin.stock.search');
        Route::get('/edit/{id}', [StockController::class, 'edit'])->name('admin.stock.edit');
        Route::post('/update/{id}', [StockController::class, 'update'])->name('admin.stock.update');
    });


});

Route::get('/show', function(){
    $a = 2;
    return $a >= 2;
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
