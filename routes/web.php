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
    return view('auth.login');
});

Auth::routes();
//Dashboard
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Search Pesan
Route::post('/pesan/search', [App\Http\Controllers\PesanController::class, 'search']);
// Search Produk
Route::post('/produk/search', [App\Http\Controllers\ProdukController::class, 'search']);
// Search profit
Route::post('/profit/search', [App\Http\Controllers\ProfitController::class, 'search']);
// Search penagihan
Route::post('/penagihan/search', [App\Http\Controllers\PenagihanController::class, 'search']);


// MAIN VIEW
Route::get('/pesan', [App\Http\Controllers\PesanController::class, 'index'])->name('pesan');
Route::get('/produk', [App\Http\Controllers\ProdukController::class, 'index'])->name('produk');
Route::get('/profit', [App\Http\Controllers\ProfitController::class, 'index'])->name('profit');
Route::get('/export', [App\Http\Controllers\ProfitController::class, 'export']);
Route::get('/penagihan', [App\Http\Controllers\PenagihanController::class, 'index'])->name('penagihan');


Route::middleware(['adminAccess'])->group(function () {
    // Pesan

    Route::post('/pesan/insert', [App\Http\Controllers\PesanController::class, 'store'])->name('insert');
    Route::get('/pesan/{id}', [App\Http\Controllers\PesanController::class, 'getPesanById']);
    Route::put('/pesan', [App\Http\Controllers\PesanController::class, 'update'])->name("pesan.update");
    Route::delete('/pesan/{id}', [App\Http\Controllers\PesanController::class, 'destroy']);


    // Produk


    Route::post('/produk/insert', [App\Http\Controllers\ProdukController::class, 'store'])->name('insert.produk');
    Route::get('/produk/edit/{id}', [App\Http\Controllers\ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/update', [App\Http\Controllers\ProdukController::class, 'update'])->name("produk.update");
    Route::delete('/produk/{id}', [App\Http\Controllers\ProdukController::class, 'destroy']);


    // Profit

    Route::get('/profit/create', [App\Http\Controllers\ProfitController::class, 'create'])->name('profit.create');
    Route::post('/profit/insert', [App\Http\Controllers\ProfitController::class, 'store'])->name('profit.store');
    Route::put('/profit/update', [App\Http\Controllers\ProfitController::class, 'update'])->name('profit.update');
    Route::get('/profit/edit/{id}', [App\Http\Controllers\ProfitController::class, 'edit'])->name('profit.edit');
    Route::delete('/profit/delete/{id}', [App\Http\Controllers\ProfitController::class, 'destroy'])->name('profit.delete');


    // Penagihan
    Route::post('/penagihan', [App\Http\Controllers\PenagihanController::class, 'update'])->name('penagihan.update');
});
