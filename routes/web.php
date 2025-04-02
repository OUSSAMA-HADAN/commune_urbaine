<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContableController;
use App\Http\Controllers\FonctionnaireController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::get("/", [loginController::class, 'index']);


Route::get("/login", [loginController::class, 'index'])->name('login.show');
Route::post('/login', [loginController::class, 'login'])->name('login');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');



Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [OrderController::class, 'index'])->name('admin.dashboard');
    Route::get('/order/create', [OrderController::class, 'create'])->name('admin.order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('admin.order.store');

    Route::get('/order/edit/{id}', [OrderController::class, 'edit'])->name('admin.order.edit');
    Route::post('/users/update', [OrderController::class, 'update'])->name('admin.order.update');
    Route::post('/users/delete', [OrderController::class, 'destroy'])->name('admin.order.destroy');

    Route::get('/users', [UsersController::class, 'index'])->name('admin.users.show');

    Route::get('/rapport', [RapportController::class, 'index'])->name('admin.rapport.show');

    Route::get('/users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [UsersController::class, 'store'])->name('admin.users.store');
    Route::delete('/users/delete/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');


    Route::get('/users/reset-password/{id}', [UsersController::class, 'showResetForm'])->name('admin.users.showResetForm');
    Route::post('/users/reset-password/{id}', [UsersController::class, 'updatePassword'])->name('admin.updatePassword');

    Route::get('/admin/statistics', [StatisticsController::class, 'index'])->name('admin.statistics');
});




// Fonctionnaire routes
Route::prefix('fonctionnaire')->middleware(['auth', 'fonctionnaire'])->group(function () {
    Route::get('/dashboard', [FonctionnaireController::class, 'dashboard'])->name('fonctionnaire.dashboard');
    Route::get('/missions', [FonctionnaireController::class, 'missions'])->name('fonctionnaire.missions');
    Route::get('/rapports', [FonctionnaireController::class, 'rapports'])->name('fonctionnaire.rapports');

    Route::get('/mission/{id}', [FonctionnaireController::class, 'showMission'])->name('fonctionnaire.mission.show');
    Route::get('/mission/{missionId}/rapport/create', [FonctionnaireController::class, 'createRapport'])->name('fonctionnaire.rapport.create');
    Route::post('/mission/{missionId}/rapport', [FonctionnaireController::class, 'storeRapport'])->name('fonctionnaire.rapport.store');
});



// contable routes
Route::prefix('contable')->middleware(['auth', 'contable'])->group(function () {
    Route::get('/dashboard', [ContableController::class, 'dashboard'])->name('contable.dashboard');
    Route::get('/reimbursement-history', [ContableController::class, 'reimbursementHistory'])->name('contable.reimbursement.history');
    Route::post('/process-reimbursement/{id}', [ContableController::class, 'processReimbursement'])->name('contable.reimbursement.process');
    Route::get('/reimbursement/{id}', [ContableController::class, 'processReimbursementDetail'])
        ->name('contable.reimbursement.detail');
    Route::post('/reimbursement/validate/{id}', [ContableController::class, 'validateReimbursement'])
        ->name('contable.reimbursement.validate');
});
