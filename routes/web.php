<?php

use App\Http\Controllers\MasterProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\IsoController;
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

require __DIR__.'/auth.php';
