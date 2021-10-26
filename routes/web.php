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
Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::post('absen', [App\Http\Controllers\IndexController::class, 'absen']);
Route::get('login', [App\Http\Controllers\AuthController::class, 'index']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'IsAdmin'], function () {
	Route::get('/', [App\Http\Controllers\Dashboard\PegawaiController::class, 'index']);
	Route::get('pegawai/list', [App\Http\Controllers\Dashboard\PegawaiController::class, 'getPegawai'])->name('pegawai.list');
	Route::get('pegawai/export', [App\Http\Controllers\Dashboard\PegawaiController::class, 'export']);
	Route::resource('pegawai', App\Http\Controllers\Dashboard\PegawaiController::class);

	Route::get('absensi', [App\Http\Controllers\Dashboard\AbsensiController::class, 'index']);
	Route::get('absensi/list', [App\Http\Controllers\Dashboard\AbsensiController::class, 'getAbsensi'])->name('absensi.list');
});