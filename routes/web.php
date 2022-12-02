<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\IsoController;
use App\Http\Controllers\SupplierDataController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MasterAspek;
use App\Http\Controllers\MasterAspekController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierImportController;
use App\Http\Controllers\UserAccess;

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
Route::get('supplier_import', [SupplierImportController::class, 'index'])->name('supplier_import');
Route::post('import_supplier', [SupplierImportController::class, 'import_supplier'])->name('import_supplier');

// testing email
Route::get('sendMail', [MailController::class, 'sendMail'])->name('sendMail');
// Menus
Route::get('menus', [MenusController::class, 'index'])->name('menus');
Route::get('get_submenus', [MenusController::class, 'get_submenus'])->name('get_submenus');
Route::post('save_menus', [MenusController::class, 'save_menus'])->name('save_menus');
Route::get('menus_name', [MenusController::class, 'menus_name'])->name('menus_name');
Route::post('save_submenus', [MenusController::class, 'save_submenus'])->name('save_submenus');
Route::get('getDetailMenus', [MenusController::class, 'getDetailMenus'])->name('getDetailMenus');
Route::get('deleteMenus', [MenusController::class, 'deleteMenus'])->name('deleteMenus');
Route::get('getDetailSubmenus', [MenusController::class, 'getDetailSubmenus'])->name('getDetailSubmenus');
Route::get('deleteSubmenus', [MenusController::class, 'deleteSubmenus'])->name('deleteSubmenus');
Route::post('update_menus', [MenusController::class, 'update_menus'])->name('update_menus');
Route::post('update_submenus', [MenusController::class, 'update_submenus'])->name('update_submenus');
// End Menus

// Role
Route::get('role', [RoleController::class, 'index'])->name('role');
Route::post('save_roles', [RoleController::class, 'save_roles'])->name('save_roles');
Route::get('get_premission', [RoleController::class, 'get_premission'])->name('get_premission');
Route::get('permission_menus_name', [RoleController::class, 'permission_menus_name'])->name('permission_menus_name');
Route::post('save_permission', [RoleController::class, 'save_permission'])->name('save_permission');
Route::get('delete_roles', [RoleController::class, 'delete_roles'])->name('delete_roles');
Route::get('detail_roles', [RoleController::class, 'detail_roles'])->name('detail_roles');
Route::post('update_roles', [RoleController::class, 'update_roles'])->name('update_roles');
Route::get('delete_permission', [RoleController::class, 'delete_permission'])->name('delete_permission');
// End Role

//User Access 
Route::get('user_access', [UserAccess::class, 'index'])->name('user_access');
Route::get('get_data_role_user', [UserAccess::class, 'get_data_role_user'])->name('get_data_role_user');
Route::get('get_username', [UserAccess::class, 'get_username'])->name('get_username');
Route::post('add_roles_user', [UserAccess::class, 'add_roles_user'])->name('add_roles_user');
Route::get('get_permisssion', [UserAccess::class, 'get_permisssion'])->name('get_permisssion');
Route::post('add_role_permission', [UserAccess::class, 'add_role_permission'])->name('add_role_permission');
Route::get('delete_role_permission', [UserAccess::class, 'delete_role_permission'])->name('delete_role_permission');
Route::get('detail_role_user', [UserAccess::class, 'detail_role_user'])->name('detail_role_user');
Route::post('update_roles_user', [UserAccess::class, 'update_roles_user'])->name('update_roles_user');
//End User Access 

// Master Aspek
Route::get('master_aspek', [MasterAspekController::class, 'index'])->name('master_aspek');

//End Master Aspek

// report
Route::get('reportSupplier', [SupplierDataController::class, 'reportSupplier'])->name('reportSupplier');


require __DIR__.'/auth.php';
