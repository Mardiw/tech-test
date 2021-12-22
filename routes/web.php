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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resources([
        'produk' => App\Http\Controllers\ProdukController::class
    ]);
});

Route::get('/customer', '\App\Http\Controllers\CustomerController@index')->name('customer.index');
Route::resource('keranjang', App\Http\Controllers\KeranjangController::class);

require __DIR__.'/auth.php';
