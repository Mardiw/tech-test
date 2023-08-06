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
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('produk', App\Http\Controllers\ProdukController::class)
        ->middleware('checkRole:0');

    Route::resource('keranjang', App\Http\Controllers\KeranjangController::class)
        ->middleware('checkRole:1');
    Route::patch('/keranjang_update_all', [App\Http\Controllers\KeranjangController::class, 'update_all'])->name('keranjang.update_all')->middleware('checkRole:1');
});

Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])
    ->name('customer.index');

require __DIR__ . '/auth.php';
