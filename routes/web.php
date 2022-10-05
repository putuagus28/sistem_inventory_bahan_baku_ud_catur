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
    return redirect('login');
});


/** admin */
Route::middleware(['auth:user', 'ceklevel:admin'])->group(function () {
    /** user*/
    Route::get('general/{type}', 'UserController@index')->name('user');
    Route::post('general/{type}', 'UserController@index')->name('json.user');
    Route::post('user/insert', 'UserController@insert')->name('insert.user');
    Route::get('user/edit', 'UserController@edit')->name('edit.user');
    Route::post('user/delete', 'UserController@delete')->name('delete.user');
    Route::post('user/update', 'UserController@update')->name('update.user');
    /** supplier*/
    Route::get('supplier', 'SupplierController@index')->name('supplier');
    Route::post('supplier', 'SupplierController@index')->name('json.supplier');
    Route::post('supplier/insert', 'SupplierController@insert')->name('insert.supplier');
    Route::get('supplier/edit', 'SupplierController@edit')->name('edit.supplier');
    Route::post('supplier/delete', 'SupplierController@delete')->name('delete.supplier');
    Route::post('supplier/update', 'SupplierController@update')->name('update.supplier');
    /** periode*/
    Route::get('periode', 'PeriodeController@index')->name('periode');
    Route::post('periode', 'PeriodeController@index')->name('json.periode');
    Route::post('periode/insert', 'PeriodeController@insert')->name('insert.periode');
    Route::get('periode/edit', 'PeriodeController@edit')->name('edit.periode');
    Route::post('periode/delete', 'PeriodeController@delete')->name('delete.periode');
    Route::post('periode/update', 'PeriodeController@update')->name('update.periode');
    /** bahanbaku*/
    Route::get('bahanbaku', 'BahanbakuController@index')->name('bahanbaku');
    Route::get('kode/bahanbaku', 'BahanbakuController@generate')->name('bahanbaku.kode');
    Route::post('bahanbaku', 'BahanbakuController@index')->name('json.bahanbaku');
    Route::post('bahanbaku/insert', 'BahanbakuController@insert')->name('insert.bahanbaku');
    Route::get('bahanbaku/edit', 'BahanbakuController@edit')->name('edit.bahanbaku');
    Route::post('bahanbaku/delete', 'BahanbakuController@delete')->name('delete.bahanbaku');
    Route::post('bahanbaku/update', 'BahanbakuController@update')->name('update.bahanbaku');
    /** bahan baku masuk*/
    Route::get('bbm', 'BbmController@index')->name('bbm');
    Route::post('bbm', 'BbmController@index')->name('json.bbm');
    Route::post('bbm/insert', 'BbmController@insert')->name('insert.bbm');
    Route::get('bbm/edit', 'BbmController@edit')->name('edit.bbm');
    Route::post('bbm/delete', 'BbmController@delete')->name('delete.bbm');
    Route::post('bbm/update', 'BbmController@update')->name('update.bbm');
    /** bahan baku keluar*/
    Route::get('bbk', 'BbkController@index')->name('bbk');
    Route::post('bbk', 'BbkController@index')->name('json.bbk');
    Route::post('bbk/insert', 'BbkController@insert')->name('insert.bbk');
    Route::get('bbk/edit', 'BbkController@edit')->name('edit.bbk');
    Route::post('bbk/delete', 'BbkController@delete')->name('delete.bbk');
    Route::post('bbk/update', 'BbkController@update')->name('update.bbk');
});

/** semua */
Route::middleware(['auth:user', 'ceklevel:admin,pegawai'])->group(function () {
    /** dashboard */
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('chart', 'DashboardController@chart')->name('chart');
    /** produksi*/
    Route::get('produksi', 'ProduksiController@index')->name('produksi');
    Route::post('produksi', 'ProduksiController@index')->name('json.produksi');
    Route::post('produksi/insert', 'ProduksiController@insert')->name('insert.produksi');
    Route::get('produksi/edit', 'ProduksiController@edit')->name('edit.produksi');
    Route::post('produksi/delete', 'ProduksiController@delete')->name('delete.produksi');
    Route::post('produksi/update', 'ProduksiController@update')->name('update.produksi');
    /** bahan baku sisa*/
    Route::get('bbs', 'BbsController@index')->name('bbs');
    Route::post('bbs', 'BbsController@index')->name('json.bbs');
    Route::post('bbs/insert', 'BbsController@insert')->name('insert.bbs');
    Route::get('bbs/edit', 'BbsController@edit')->name('edit.bbs');
    Route::post('bbs/delete', 'BbsController@delete')->name('delete.bbs');
    Route::post('bbs/update', 'BbsController@update')->name('update.bbs');
    /** laporan */
    Route::get('laporan/{jenis}', 'LaporanController@index')->name('laporan');
    Route::post('laporan/', 'LaporanController@getLaporan')->name('post.laporan');
});


// Login
Route::middleware(['guest'])->group(function () {
    Route::get('login', 'LoginController@getLogin')->name('login');
    Route::post('login', 'LoginController@postLogin');
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('logout', 'LoginController@logout')->name('logout');
});
