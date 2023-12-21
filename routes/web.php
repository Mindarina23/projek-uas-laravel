<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PembeliController;
use App\Http\Controllers\Admin\PenjualController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('admin')->group(function() {
    // route untuk auth
    Route::group(['middleware' => 'auth'], function(){
        // buat route untuk dashboard
        Route::get('/dashboard', [DashboardController::class,'index'])->name('admin.dashboard.index');

        Route::resource('/pembeli', PembeliController::class,['as' => 'admin']);
        Route::resource('/barang', BarangController::class,['as' => 'admin']);
        Route::resource('/transaksi', TransaksiController::class,['as' => 'admin']);















        // Route::resource('/category', CategoryController::class,['as' => 'admin']); 
        //  //buat route untuk data penjual
        //  Route::resource('/penjual', PenjualController::class,['as' => 'admin']); 
        
    });
});