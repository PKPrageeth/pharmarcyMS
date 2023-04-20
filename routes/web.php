<?php

use Illuminate\Support\Facades\Route;

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
    return view('Backend.Dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->middleware('auth')->group(function () {

    Route::get("upload/prescription", [\App\Http\Controllers\PrescriptionController::class, 'prescription'])->name('user.prescription.page');
    Route::post("upload/prescription", [\App\Http\Controllers\PrescriptionController::class, 'UploadPrescription'])->name('upload.prescription.page');
    Route::get("list/prescription", [\App\Http\Controllers\PrescriptionController::class, 'prescriptionsList'])->name('list.prescription.page');
    Route::get("view/prescription/{id}", [\App\Http\Controllers\PrescriptionController::class, 'prescriptionsView'])->name('view.prescription.page');
    Route::post("approveorreject/quotation", [\App\Http\Controllers\QuotationController::class, 'ApproveOrRejectQuotation'])->name('user.approve.reject.quotation');
    Route::get("quotations/list", [\App\Http\Controllers\QuotationController::class, 'QuotationList'])->name('user.quotations.list');


});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get("list/prescription", [\App\Http\Controllers\PrescriptionController::class, 'prescriptionsAllList'])->name('admin.list.prescription.page');
    Route::get("send/prescription/{id}", [\App\Http\Controllers\QuotationController::class, 'QuotationSendPage'])->name('admin.send.quotation.page');
    Route::post("add/drugs", [\App\Http\Controllers\QuotationController::class, 'AddDrugs'])->name('admin.add.drugs');
    Route::post("list/drugs", [\App\Http\Controllers\QuotationController::class, 'ListDrugs'])->name('admin.list.drugs');
    Route::post("remove/drugs", [\App\Http\Controllers\QuotationController::class, 'RemoveDrugs'])->name('admin.remove.drugs');
    Route::post("submit/quotation", [\App\Http\Controllers\QuotationController::class, 'SubmitQuotation'])->name('admin.submit.quotation');
    Route::get("approved/list", [\App\Http\Controllers\QuotationController::class, 'ApproveList'])->name('admin.approve.quotation');
    Route::get("rejected/list", [\App\Http\Controllers\QuotationController::class, 'RejectedList'])->name('admin.reject.quotation');
    Route::get("create/user", [\App\Http\Controllers\UserController::class, 'createuserpage'])->name('admin.create.user.page');
    Route::post("create/user", [\App\Http\Controllers\UserController::class, 'createuser'])->name('admin.create.user');
    Route::get("list/user", [\App\Http\Controllers\UserController::class, 'listuser'])->name('admin.list.user');


});
