<?php

use App\Http\Controllers\MasterProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\IsoController;
use App\Http\Controllers\SupplierDataController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('supplier', SupplierController::class)->name('supplier');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('suppliers', SupplierController::class);
Route::resource('products', MasterProduct::class);
Route::resource('iso', IsoController::class);
Route::get('get_district', [SupplierDataController::class, 'get_district'])->name('get_district');
Route::get('get_regency', [SupplierDataController::class, 'get_regency'])->name('get_regency');
Route::get('get_village', [SupplierDataController::class, 'get_village'])->name('get_village');
Route::get('supplierDetail', [SupplierDataController::class, 'supplierDetail'])->name('supplierDetail');
Route::post('post_supplier', [SupplierDataController::class, 'post_supplier'])->name('post_supplier');


require __DIR__.'/auth.php';
