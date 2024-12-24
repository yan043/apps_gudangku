<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;

Route::get('/welcome', fn() => view('pages.welcome'));
Route::get('/blank', fn() => view('pages.blank'));

Route::get('/login', [AuthController::class, 'auth_login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('master')->name('master.')->middleware('role:administrator,warehouse')->group(function () {
        Route::get('categories', [MasterController::class, 'categories'])->name('categories');
        Route::post('categories/store', [MasterController::class, 'categories_store'])->name('categories.store');
        Route::get('categories/{id}', [MasterController::class, 'categories_destroy'])->name('categories.destroy');

        Route::get('products', [MasterController::class, 'products'])->name('products');
        Route::post('products/store', [MasterController::class, 'products_store'])->name('products.store');
        Route::get('products/{id}', [MasterController::class, 'products_destroy'])->name('products.destroy');
    });

    Route::prefix('transaction')->name('transaction.')->middleware('role:administrator,cashier')->group(function () {
        Route::get('purchase-goods', [TransactionController::class, 'purchase_goods'])->name('purchase');
        Route::post('purchase-goods/store', [TransactionController::class, 'purchase_goods_store'])->name('purchase.store');

        Route::get('goods-receipt', [TransactionController::class, 'goods_receipt'])->name('receipt');
        Route::post('goods-receipt/store', [TransactionController::class, 'goods_receipt_store'])->name('receipt.store');
    });

    Route::prefix('transaction')->name('transaction.')->middleware('role:administrator,cashier,warehouse')->group(function () {
        Route::get('stock-transactions', [TransactionController::class, 'stock_transactions'])->name('stock');
    });

    Route::prefix('report')->name('report.')->middleware('role:administrator,cashier,warehouse')->group(function () {
        Route::get('/stock', [ReportController::class, 'stock_report'])->name('stock');
        Route::get('/acceptance', [ReportController::class, 'acceptance_report'])->name('acceptance');
    });

    Route::prefix('report')->name('report.')->middleware('role:administrator,cashier')->group(function () {
        Route::get('/purchase', [ReportController::class, 'purchase_report'])->name('purchase');
    });

    Route::prefix('settings')->name('settings.')->middleware('role:administrator')->group(function () {
        Route::get('employee', [SettingsController::class, 'employee'])->name('employee');
        Route::post('employee/store', [SettingsController::class, 'employee_store'])->name('employee.store');
        Route::get('employee/{id}', [SettingsController::class, 'employee_destroy'])->name('employee.destroy');

        Route::get('level', [SettingsController::class, 'level'])->name('level');
        Route::post('level/store', [SettingsController::class, 'level_store'])->name('level.store');
        Route::get('level/{id}', [SettingsController::class, 'level_destroy'])->name('level.destroy');
    });

});
