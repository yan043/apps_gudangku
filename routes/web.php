<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;

Route::get('/welcome', fn() => view('welcome'));
Route::get('/login', [AuthController::class, 'auth_login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('master')->name('master.')->middleware('role:administrator,warehouse')->group(function () {
        Route::resource('categories', MasterController::class)->only(['index', 'store', 'destroy']);
        Route::resource('products', MasterController::class)->only(['index', 'store', 'destroy']);
    });

    Route::prefix('transaction')->name('transaction.')->group(function () {
        Route::middleware('role:administrator,cashier')->group(function () {
            Route::resource('goods-receipt', TransactionController::class)->only(['index', 'store', 'destroy']);
            Route::resource('purchase-goods', TransactionController::class)->only(['index', 'store', 'destroy']);
        });

        Route::middleware('role:administrator,cashier,warehouse')->group(function () {
            Route::resource('stock-transactions', TransactionController::class)->only(['index', 'store', 'destroy']);
        });
    });

    Route::prefix('report')->name('report.')->middleware('role:administrator,cashier,warehouse')->group(function () {
        Route::get('/stock', [ReportController::class, 'stock_report'])->name('stock');
        Route::get('/acceptance', [ReportController::class, 'acceptance_report'])->name('acceptance');
    });

    Route::prefix('report')->name('report.')->middleware('role:administrator,cashier')->group(function () {
        Route::get('/purchase', [ReportController::class, 'purchase_report'])->name('purchase');
    });

    Route::prefix('settings')->name('settings.')->middleware('role:administrator')->group(function () {
        Route::resource('employee', SettingsController::class)->only(['index', 'store', 'destroy']);
        Route::resource('level', SettingsController::class)->only(['index', 'store', 'destroy']);
    });

});
