/**
 * Dokumentasi Route
 *
 * Di bawah ini adalah daftar route yang tersedia dalam folder 'route':
 * API.PHP
 * 
 */
/** Web route
 * Route::get('/', function () {
//     return view('welcome');
// });

/**
 * API Routes
 *
 * Digunakan untuk menyediakan antarmuka pemrograman aplikasi (API).
 */

// Route::get untuk mengambil data
// Route::get('/printcat', [PrintCatridgeController::class, 'index']);
// Route::get('/printcat/{print}/{warna}', [PrintCatridgeController::class, 'test']);
// Route::get('/tintas', [TintaController::class, 'index']);
// Route::get('/tintas/{id}', [TintaController::class, 'show']);
// Route::get('/printer', [PrinterController::class, 'index']);
// Route::get("/pelanggan", [PelangganController::class, 'index']);
// Route::get("/booking", [BookingController::class, 'index']);
// Route::get("/booking/lacak/{id}", [BookingController::class, 'show']);
// Route::get("/booking/pending", [BookingController::class, 'pending']);
// Route::get("/booking/pickup", [BookingController::class, 'pickup']);
// Route::get("/booking/history", [BookingController::class, 'history']);
// Route::get("/booking/report/{tanggalAwal}/{tanggalAkhir}", [BookingController::class, 'report']);
// Route::get('/admin', [AdminController::class, 'index']);
// Route::get('/historiemail', [HistoriEmailController::class, 'index']);


// Route::post untuk menambah data
// Route::post('/printcat', [PrintCatridgeController::class, 'store']);
// Route::post('/tintas', [TintaController::class, 'store']);
// Route::post('/printer', [PrinterController::class, 'store']);
// Route::post("/pelanggan", [PelangganController::class, 'store']);
// Route::post("/booking", [BookingController::class, 'store']);
// Route::post('/login', [AdminController::class, 'login']);


// Route::put untuk mengubah data
// Route::put('/tintas/{id}', [TintaController::class, 'update']);
// Route::put('/tintas/stok/{id}', [TintaController::class, 'stok']);
// Route::put("/booking/{id}", [BookingController::class, 'update']);
// Route::put("/booking/pickup/{id}", [BookingController::class, 'status']);
// Route::put('/admin/{id}', [AdminController::class, 'update']);


// Route::delete untuk menghapus data
// Route::delete('/printcat/{id}', [PrintCatridgeController::class, 'destroy']);
// Route::delete('/tintas/{id}', [TintaController::class, 'destroy']);
// Route::delete('/printer/{id}', [PrinterController::class, 'destroy']);
// Route::delete("/pelanggan/{id}", [PelangganController::class, 'delete']);
// Route:: delete ("/booking/{id}", [BookingController:: class, 'destroy']);

/**
 * console routes
 *
 * Digunakan untuk menangani console.
 */

// Artisan::command('inspire', function () {
  //     $this->comment(Inspiring::quote());
  // })->purpose('Display an inspiring quote');

  /**
 * channel routes
 *
 * Digunakan untuk menangani request channel.
 */

//   Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

  
/**
 * Export Routes
 *
 * Ekspor semua route yang telah didefinisikan.
 */
module.exports = {
  webRoutes,
  apiRoutes,
  adminRoutes,
};
