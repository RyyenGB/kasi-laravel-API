<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangClientController;
use App\Http\Controllers\SupplierClientController;
use App\Http\Controllers\TransaksiClientController;
use App\Http\Controllers\BarangServerController;
use App\Http\Controllers\SupplierServerController;
use App\Http\Controllers\TransaksiServerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('client')->group(function () {
    Route::prefix('barang')->group(function () {
        Route::get('/', [BarangClientController::class, 'index']);
        Route::post('/', [BarangClientController::class, 'store']);
        Route::get('/{id}', [BarangClientController::class, 'show']);
        Route::put('/{id}', [BarangClientController::class, 'update']);
        Route::delete('/{id}/delete', [BarangClientController::class, 'destroy']);
    });

    Route::prefix('supplier')->group(function () {
        Route::get('/', [SupplierClientController::class, 'index']);
        Route::post('/', [SupplierClientController::class, 'store']);
        Route::get('/{id}', [SupplierClientController::class, 'show']);
        Route::put('/{id}', [SupplierClientController::class, 'update']);
        Route::delete('/{id}/delete', [SupplierClientController::class, 'destroy']);
    });

    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiClientController::class, 'index']);
        Route::post('/', [TransaksiClientController::class, 'store']);
        Route::get('/{id}', [TransaksiClientController::class, 'show']);
        Route::put('/{id}', [TransaksiClientController::class, 'update']);
        Route::delete('/{id}/delete', [TransaksiClientController::class, 'destroy']);
    });
});

Route::prefix('server')->group(function () {
    Route::prefix('barang')->group(function () {
        Route::get('/', [BarangServerController::class, 'index']);
        Route::post('/', [BarangServerController::class, 'store']);
        Route::get('/{id}', [BarangServerController::class, 'show']);
        Route::put('/{id}', [BarangServerController::class, 'update']);
        Route::delete('/{id}/delete', [BarangServerController::class, 'destroy']);
    });

    Route::prefix('supplier')->group(function () {
        Route::get('/', [SupplierServerController::class, 'index']);
        Route::post('/', [SupplierServerController::class, 'store']);
        Route::get('/{id}', [SupplierServerController::class, 'show']);
        Route::put('/{id}', [SupplierServerController::class, 'update']);
        Route::delete('/{id}/delete', [SupplierServerController::class, 'destroy']);
    });

    Route::prefix('transaksi')->group(function () {
        Route::get('/', [TransaksiServerController::class, 'index']);
        Route::post('/', [TransaksiServerController::class, 'store']);
        Route::get('/{id}', [TransaksiServerController::class, 'show']);
        Route::put('/{id}', [TransaksiServerController::class, 'update']);
        Route::delete('/{id}/delete', [TransaksiServerController::class, 'destroy']);
    });
});
