<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\IsoController;
use App\Http\Controllers\SupplierDataController;
use App\Http\Controllers\MailController;

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


Route::get('/', [DashboardController::class, 'index'])->name('/');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Route::get('supplier', SupplierController::class)->name('supplier');

Route::resource('suppliers', SupplierController::class);
Route::resource('products', MasterProduct::class);
Route::resource('iso', IsoController::class);
Route::get('get_district', [SupplierDataController::class, 'get_district'])->name('get_district');
Route::get('get_regency', [SupplierDataController::class, 'get_regency'])->name('get_regency');
Route::get('get_village', [SupplierDataController::class, 'get_village'])->name('get_village');
Route::get('supplierDetail', [SupplierDataController::class, 'supplierDetail'])->name('supplierDetail');
Route::get('get_kdpos', [SupplierDataController::class, 'get_kdpos'])->name('get_kdpos');
Route::post('post_supplier', [SupplierDataController::class, 'post_supplier'])->name('post_supplier');
Route::get('report_supplier/{number}',[SupplierDataController::class, 'report_supplier']);
// testing email
Route::get('sendMail', [MailController::class, 'sendMail'])->name('sendMail');

// repost
Route::get('reportSupplier', [SupplierDataController::class, 'reportSupplier'])->name('reportSupplier');


require __DIR__.'/auth.php';
