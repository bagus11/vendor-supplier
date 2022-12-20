<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\IsoController;
use App\Http\Controllers\SupplierDataController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MasterAspekController;
use App\Http\Controllers\MasterBobotController;
use App\Http\Controllers\MasterJabatanController;
use App\Http\Controllers\MasterPenilaianController;
use App\Http\Controllers\MasterPertanyaanController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingUserController;
use App\Http\Controllers\SupplierImportController;
use App\Http\Controllers\SurveySupplierController;
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
Route::group(['middleware' => ['auth']], function() {

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
    Route::group(['middleware' => ['permission:view-menus']], function () {
        //
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
    });
    // End Menus
    Route::group(['middleware' => ['permission:view-role']], function () {
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
    
    });
    Route::group(['middleware' => ['permission:view-user_access']], function () {
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
    });
    Route::group(['middleware' => ['permission:view-master_aspek']], function () {
        // Master Aspek
        Route::get('master_aspek', [MasterAspekController::class, 'index'])->name('master_aspek');
        Route::get('get_aspek', [MasterAspekController::class, 'get_aspek'])->name('get_aspek');
        Route::post('add_aspek', [MasterAspekController::class, 'add_aspek'])->name('add_aspek');
        Route::post('update_aspek', [MasterAspekController::class, 'update_aspek'])->name('update_aspek');
        Route::get('get_departement', [MasterAspekController::class, 'get_departement'])->name('get_departement');
        Route::post('add_departement', [MasterAspekController::class, 'add_departement'])->name('add_departement');
        Route::get('delete_aspek', [MasterAspekController::class, 'delete_aspek'])->name('delete_aspek');
        Route::get('detail_departement', [MasterAspekController::class, 'detail_departement'])->name('detail_departement');
        Route::post('update_departement', [MasterAspekController::class, 'update_departement'])->name('update_departement');
        Route::get('delete_departement', [MasterAspekController::class, 'delete_departement'])->name('delete_departement');
        //End Master Aspek
    });
    Route::group(['middleware' => ['permission:view-master_pertanyaan']], function () {
        // Master Pertanyaan
        Route::get('master_pertanyaan', [MasterPertanyaanController::class, 'index'])->name('master_pertanyaan');
        Route::get('get_data_pertanyaan', [MasterPertanyaanController::class, 'get_data_pertanyaan'])->name('get_data_pertanyaan');
        Route::get('get_aspek_name', [MasterPertanyaanController::class, 'get_aspek_name'])->name('get_aspek_name');
        Route::post('save_pertanyaan', [MasterPertanyaanController::class, 'save_pertanyaan'])->name('save_pertanyaan');
        Route::post('update_status_pertanyaan', [MasterPertanyaanController::class, 'update_status_pertanyaan'])->name('update_status_pertanyaan');
        Route::get('detail_pertanyaan', [MasterPertanyaanController::class, 'detail_pertanyaan'])->name('detail_pertanyaan');
        Route::post('update_pertanyaan', [MasterPertanyaanController::class, 'update_pertanyaan'])->name('update_pertanyaan');
        Route::get('delete_pertanyaan', [MasterPertanyaanController::class, 'delete_pertanyaan'])->name('delete_pertanyaan');
        // End Master Pertanyaan
    });
    Route::group(['middleware' => ['permission:view-form_penilaian']], function () {
        // Penilaian 
        Route::get('form_penilaian', [MasterPenilaianController::class, 'index'])->name('form_penilaian');
        Route::get('get_supplier_name', [MasterPenilaianController::class, 'get_supplier_name'])->name('get_supplier_name');
        Route::get('get_pertanyaan', [MasterPenilaianController::class, 'get_pertanyaan'])->name('get_pertanyaan');
        Route::post('save_form_penilaian', [MasterPenilaianController::class, 'save_form_penilaian'])->name('save_form_penilaian');
        Route::get('get_penilaian_headers', [MasterPenilaianController::class, 'get_penilaian_headers'])->name('get_penilaian_headers');
        Route::post('update_status_penilaian_header', [MasterPenilaianController::class, 'update_status_penilaian_header'])->name('update_status_penilaian_header');
        Route::get('get_penilaian_log', [MasterPenilaianController::class, 'get_penilaian_log'])->name('get_penilaian_log');
        // End Penilaian
        // Form Survey
        Route::get('survey_supplier/{number}/{userId}', [SurveySupplierController::class, 'index'])->name('survey_supplier');
        Route::post('save_survey', [SurveySupplierController::class, 'save_survey'])->name('save_survey');
        Route::get('report_survey_supplier/{number}', [SurveySupplierController::class, 'report_survey_supplier'])->name('report_survey_supplier');
        Route::get('report_evaluasi_supplier/{number}/{tgl_laporan}', [SurveySupplierController::class, 'report_evaluasi_supplier'])->name('report_evaluasi_supplier');
        // End Form Survey
    });
    Route::group(['middleware' => ['permission:view-master_bobot']], function () {
        // Master Bobot
        Route::get('master_bobot', [MasterBobotController::class, 'index'])->name('master_bobot');
        Route::get('get_bobot', [MasterBobotController::class, 'get_bobot'])->name('get_bobot');
        Route::post('save_bobot', [MasterBobotController::class, 'save_bobot'])->name('save_bobot');
        Route::get('get_detail_bobot', [MasterBobotController::class, 'get_detail_bobot'])->name('get_detail_bobot');
        Route::post('udpate_bobot', [MasterBobotController::class, 'udpate_bobot'])->name('udpate_bobot');
        Route::get('delete_bobot', [MasterBobotController::class, 'delete_bobot'])->name('delete_bobot');
        //End Master Bobot
    });
    Route::group(['middleware' => ['permission:view-setting_user']], function () {
        // User
        Route::get('setting_user', [SettingUserController::class, 'index'])->name('setting_user');
        Route::get('get_user', [SettingUserController::class, 'get_user'])->name('get_user');
        Route::post('update_status_user', [SettingUserController::class, 'update_status_user'])->name('update_status_user');
        Route::get('detail_user', [SettingUserController::class, 'detail_user'])->name('detail_user');
        Route::post('update_user', [SettingUserController::class, 'update_user'])->name('update_user');
        // End User
    });
    Route::group(['middleware' => ['permission:view-master_jabatan']], function () {
        // Jabatan
        Route::get('master_jabatan', [MasterJabatanController::class, 'index'])->name('master_jabatan');
        Route::get('get_kantor', [MasterJabatanController::class, 'get_kantor'])->name('get_kantor');
        Route::post('save_kantor', [MasterJabatanController::class, 'save_kantor'])->name('save_kantor');
        Route::post('update_status_kantor', [MasterJabatanController::class, 'update_status_kantor'])->name('update_status_kantor');
        Route::get('detail_kantor', [MasterJabatanController::class, 'detail_kantor'])->name('detail_kantor');
        Route::get('get_jabatan', [MasterJabatanController::class, 'get_jabatan'])->name('get_jabatan');
        Route::post('save_jabatan', [MasterJabatanController::class, 'save_jabatan'])->name('save_jabatan');
        Route::post('update_status_jabatan', [MasterJabatanController::class, 'update_status_jabatan'])->name('update_status_jabatan');
        Route::post('update_kantor', [MasterJabatanController::class, 'update_kantor'])->name('update_kantor');
        Route::get('detail_jabatan', [MasterJabatanController::class, 'detail_jabatan'])->name('detail_jabatan');
        Route::post('update_jabatan', [MasterJabatanController::class, 'update_jabatan'])->name('update_jabatan');
        // End Jabatan
    });
});

// report
Route::get('reportSupplier', [SupplierDataController::class, 'reportSupplier'])->name('reportSupplier');


require __DIR__.'/auth.php';
