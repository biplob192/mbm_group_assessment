<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\IssuedItemController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\ReceivedItemController;



Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');


Route::group(['middleware' => ['auth:api', 'role:Admin']], function () {
    Route::apiResource('suppliers', SupplierController::class, ['names' => 'suppliers']);

    Route::put('requisitions/approve/{id}', [RequisitionController::class, 'approve'])->name('requisitions.approve');
    Route::put('requisitions/reject/{id}', [RequisitionController::class, 'reject'])->name('requisitions.reject');
});


Route::group(['middleware' => ['auth:api', 'role:Employee']], function () {
    Route::post('requisitions', [RequisitionController::class, 'store'])->name('requisitions.store');
    Route::get('requisitions/{id}', [RequisitionController::class, 'show'])->name('requisitions.show');
    Route::put('requisitions/{id}', [RequisitionController::class, 'update'])->name('requisitions.update')->middleware(['requisitionCanDelete']);
    Route::delete('requisitions/{id}', [RequisitionController::class, 'destroy'])->name('requisitions.destroy')->middleware(['requisitionCanDelete']);
});


Route::group(['middleware' => ['auth:api', 'role:Admin|Store_Executive']], function () {
    Route::apiResource('issue_items', IssuedItemController::class, ['names' => 'issue_items']);
    Route::apiResource('stocks', StockController::class, ['names' => 'stocks']);
});


Route::group(['middleware' => ['auth:api', 'role:Admin|Employee|Store_Executive']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh')->middleware(['scopes:refresh']);

    Route::apiResource('items', ItemController::class, ['names' => 'items']);
    Route::apiResource('receive_items', ReceivedItemController::class, ['names' => 'receive_items']);
    Route::post('receive_multiple_items', [ReceivedItemController::class, 'multipleStore'])->name('receive_items.multiple');

    Route::get('requisitions', [RequisitionController::class, 'index'])->name('requisitions.index');
});
