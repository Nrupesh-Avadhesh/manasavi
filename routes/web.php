<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cleared!";
});

Route::get('/', [App\Http\Controllers\homeController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [App\Http\Controllers\homeController::class, 'dashboard']);
Route::get('/login', [App\Http\Controllers\homeController::class, 'login'])->name('login');
Route::get('/cpassword/{pas}', [App\Http\Controllers\homeController::class, 'cpassword'])->name('cpassword');
Route::post('/login/attempt', [App\Http\Controllers\homeController::class,'login_attempt'])->name('login.attempt');
Route::group(['middleware' => ['auth_user']], function(){
    Route::post('/logout', [App\Http\Controllers\homeController::class,'logout'])->name('logout');

    Route::resource('CompanyGroup', App\Http\Controllers\CompanyGroupsController::class);
    Route::post('/CompanyGroup/status', [App\Http\Controllers\CompanyGroupsController::class,'status']);

    Route::resource('company', App\Http\Controllers\CompanyController::class);
    Route::post('/company/status', [App\Http\Controllers\CompanyController::class,'status']);
    
    Route::resource('measure', App\Http\Controllers\MeasuresController::class);
    Route::post('/measure/status', [App\Http\Controllers\MeasuresController::class,'status']);

    Route::resource('bank', App\Http\Controllers\BanksController::class);
    Route::post('/bank/status', [App\Http\Controllers\BanksController::class,'status']);

    Route::resource('ExpenseType', App\Http\Controllers\ExpenseTypeController::class);
    Route::post('/ExpenseType/status', [App\Http\Controllers\ExpenseTypeController::class,'status']);

    Route::resource('tax', App\Http\Controllers\TaxController::class);
    Route::post('/tax/status', [App\Http\Controllers\TaxController::class,'status']);

    Route::resource('PaymentMode', App\Http\Controllers\PaymentModeController::class);
    Route::post('/PaymentMode/status', [App\Http\Controllers\PaymentModeController::class,'status']);

    Route::resource('vendor', App\Http\Controllers\VendorController::class);
    Route::post('/vendor/status', [App\Http\Controllers\VendorController::class,'status']);
    Route::get('/vendor/add_raw_material_vendor/{id}', [App\Http\Controllers\VendorController::class, 'add_raw_material_vendor'])->name('add_raw_material_vendor');
    Route::put('/vendor/store_raw_material_vendor/{id}', [App\Http\Controllers\VendorController::class, 'store_raw_material_vendor'])->name('store_raw_material_vendor');
    Route::post('/vendor/RawMateriallist',[App\Http\Controllers\VendorController::class, 'RawMateriallist']);
    Route::post('/vendor/RawMaterialdata',[App\Http\Controllers\VendorController::class, 'RawMaterialdata']);

    Route::resource('expense', App\Http\Controllers\ExpenseController::class);
    Route::post('/expense/status', [App\Http\Controllers\ExpenseController::class,'status']);

    Route::resource('product', App\Http\Controllers\ProductController::class);
    Route::post('/product/status', [App\Http\Controllers\ProductController::class,'status']);

    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::post('/customer/status', [App\Http\Controllers\CustomerController::class,'status']);
    
    Route::resource('RawMaterial', App\Http\Controllers\RawMaterialController::class);
    Route::post('/RawMaterial/status', [App\Http\Controllers\RawMaterialController::class,'status']);
    Route::get('/RawMaterial/add_raw_material_vendor/{id}', [App\Http\Controllers\RawMaterialController::class, 'add_raw_material_vendor'])->name('add_raw_material_vendor');
    Route::put('/RawMaterial/store_raw_material_vendor/{id}', [App\Http\Controllers\RawMaterialController::class, 'store_raw_material_vendor'])->name('store_raw_material_vendor');
    Route::post('/RawMaterial/vendorlist',[App\Http\Controllers\RawMaterialController::class, 'vendorlist']);
    Route::post('/RawMaterial/vendordata',[App\Http\Controllers\RawMaterialController::class, 'vendordata']);

    Route::resource('Raw-Material', App\Http\Controllers\RawMaterialStockController::class);
    Route::post('Raw-Material/product_list',[App\Http\Controllers\RawMaterialStockController::class, 'product_list']);
    
    Route::resource('proforma', App\Http\Controllers\ProformaController::class);
    Route::post('proforma/bank_list',[App\Http\Controllers\ProformaController::class, 'bank_list']);
    Route::post('proforma/product_list',[App\Http\Controllers\ProformaController::class, 'product_list']);
    Route::post('proforma/tax_list',[App\Http\Controllers\ProformaController::class, 'tax_list']);
    Route::post('proforma/customer_terms',[App\Http\Controllers\ProformaController::class, 'customer_terms']);

    Route::resource('invoice', App\Http\Controllers\InvoiceController::class);
    Route::post('invoice/bank_list',[App\Http\Controllers\InvoiceController::class, 'bank_list']);
    Route::post('invoice/product_list',[App\Http\Controllers\InvoiceController::class, 'product_list']);
    Route::post('invoice/tax_list',[App\Http\Controllers\InvoiceController::class, 'tax_list']);
    Route::post('invoice/customer_terms',[App\Http\Controllers\InvoiceController::class, 'customer_terms']);
    
    Route::resource('receipt', App\Http\Controllers\ReceiptController::class);
    Route::post('receipt/invoice_list',[App\Http\Controllers\ReceiptController::class, 'invoice_list']);
    
    Route::resource('credit_note', App\Http\Controllers\CreditNoteController::class);
    Route::post('credit_note/invoice_list',[App\Http\Controllers\CreditNoteController::class, 'invoice_list']);
});