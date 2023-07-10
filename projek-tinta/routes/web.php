<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HistoriEmailController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PrintCatridgeController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\TintaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('pesan.home');
Route::post('/cek', [FrontController::class, 'cekPrinter'])->name('pesan.cek');
Route::post('/pesan', [FrontController::class, 'pesanTinta'])->name('pesan.kirim');
Route::get('/lacak', [FrontController::class, 'home'])->name('lacak.home');
Route::post('/lacak/pesanan', [FrontController::class, 'lacak'])->name('pesan.lacak');
Route::get('/test', [FrontController::class, 'test'])->name('test');

Route::get('/admin', [AdminController::class, 'formLogin'])->name('login');
Route::post('/admin/login/berhasil', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'admin'], function () {
  Route::get('/admin/homepage', [AdminController::class, 'adminPage'])->name('admin');

  Route::get('/admin/tinta', [TintaController::class, 'index'])->name('tinta.home');
  Route::get('/admin/tinta/tambah', [TintaController::class, 'tampilTambahTinta'])->name('tinta.tambah');
  Route::post('/admin/tinta/store', [TintaController::class, 'store'])->name('tinta.store');
  Route::get('/admin/tinta/ubah/{id}', [TintaController::class, 'tampilUbahTinta'])->name('tinta.ubah');
  Route::put('/admin/tinta/update', [TintaController::class, 'update'])->name('tinta.update');
  Route::delete('/admin/tinta/{id}', [TintaController::class, 'destroy'])->name('tinta.destroy');

  Route::get('/admin/printer', [PrinterController::class, 'index'])->name('printer.home');
  Route::get('/admin/printer/tambah', [PrinterController::class, 'tampilTambahPrinter'])->name('printer.tambah');
  Route::post('/admin/printer/store', [PrinterController::class, 'store'])->name('printer.store');
  Route::get('/admin/printer/ubah/{id}', [PrinterController::class, 'tampilUbahPrinter'])->name('printer.ubah');
  Route::put('/admin/printer/update', [PrinterController::class, 'update'])->name('printer.update');
  Route::delete('/admin/printer/{id}', [PrinterController::class, 'destroy'])->name('printer.destroy');

  Route::get('/admin/printcat', [PrintCatridgeController::class, 'index'])->name('princat.home');
  Route::get('/admin/printcat/tambah', [PrintCatridgeController::class, 'tampilTambahRelasi'])->name('princat.tambah');
  Route::post('/admin/printcat/store', [PrintCatridgeController::class, 'store'])->name('printcat.store');
  Route::delete('/admin/printcat/{id}', [PrintCatridgeController::class, 'destroy'])->name('princat.destroy');

  Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.home');

  Route::get('/admin/booking', [BookingController::class, 'index'])->name('booking.home');
  Route::put('/admin/booking/ready/{nomornota}/{idcatridge}', [BookingController::class, 'pendingToReady'])->name('booking.ready');

  Route::get('/admin/pickup', [BookingController::class, 'pickup'])->name('pickup.home');
  Route::put('/admin/pickup/finish/{nomornota}', [BookingController::class, 'pickupToFinish'])->name('pickup.finish');

  Route::get('/admin/history', [BookingController::class, 'history'])->name('history.home');

  Route::get('/admin/report', [BookingController::class, 'report'])->name('report.home');
  Route::post('/admin/report/tampil', [BookingController::class, 'tampilData'])->name('report.tampil');
  Route::get('/admin/report/cetak', [BookingController::class, 'cetak'])->name('report.cetak');

  Route::get('/admin/setting', [HistoriEmailController::class, 'index'])->name('setting.home');
  Route::put('/admin/setting/tglkirim', [HistoriEmailController::class, 'tglKirim'])->name('setting.kirim');
  Route::get('/admin/setting/download/{id}', [HistoriEmailController::class, 'download'])->name('setting.download');
});
