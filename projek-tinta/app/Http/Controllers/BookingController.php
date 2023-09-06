<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 * 
 ******* FUNCTION ********
 * function index : Untuk menampilkan halaman booking
 * function pendingToReady : Untuk mengubah status pending menjadi ready
 * function pickup : Untuk menampilkan halaman pickup
 * function pickupToFinish : Untuk mengubah status ready menjadi finish
 * function history : Untuk menampilkan halaman histori 
 * function report : Untuk menampilkan halaman report
 * function tampilData : Untuk menampilkan data yang sudah dicari
 * function cetak : Untuk mencetak data 
 */

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tinta;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{

  public function index()
  {
    // Melakukan pengecekan jika yang login superadmin
    $level = session('level');
    if ($level === 'superadmin') {
      $superadmin = "superadmin";
    } else {
      $superadmin = "";
    }

    // Mengambil data dari database yang berstatus pending
    $index = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->where('bookings.status', '=', '1')
      ->select('bookings.*', 'pelanggans.nama', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->orderBy('created_at', 'asc')
      ->get();

    // Menampilkan data booking & mengirimkan data booking
    return view('backend.booking', ['bookings' => $index, "superadmin" => $superadmin]);
  }

  // Parameter nommornota untuk mengetahui pesanan yang akan ready, parameter idcatridge untuk mengurangi stok tinta yang akan digunakan
  public function pendingToReady($nomornota, $idcatridge)
  {
    // Mengambil data tinta dari database
    $tinta = Tinta::where('idcatridge', $idcatridge)->firstOrFail();

    // Membuat format tanggal sekarang dan menambah satu hari untuk batas waktu pesanan
    $now = Carbon::now(new DateTimeZone('Asia/Jakarta'));
    $tomorrow = $now->copy()->addDay();
    $batasW = $tomorrow;

    // Melakukan pengecekan stok tinta
    if ($tinta->stok > 0) {
      // Jika stok tinta tersedia akan mengurangi stok tinta 1 , membuat pesanan ready , dan menambahkan batas waktu
      $stok = $tinta->stok - 1;
      Tinta::where('idcatridge', $idcatridge)->update(['stok' => $stok]);
      Booking::where('nomornota', $nomornota)->update(['status' => 2, 'batasW' => $batasW]);
      Session::flash('success', 'Barang Ready !');
    } else {
      // Jika stok tinta dibawah 0 akan mengeluarkan peringatan dan pesanan tidak bisa menjadi ready
      Session::flash('err', 'Stok Tinta Habis !');
    }

    // Kembali ke halaman booking
    return redirect()->route('booking.home');
  }

  public function pickup()
  {
    // Melakukan pengecekan jika yang login superadmin
    $level = session('level');
    if ($level === 'superadmin') {
      $superadmin = "superadmin";
    } else {
      $superadmin = "";
    }

    // Mengambil data dari database yang berstatus ready
    $pending = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->where('bookings.status', '=', '2')
      ->select('bookings.*', 'pelanggans.nama', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->orderBy('updated_at', 'asc')
      ->get();

    // Menampilkan data pickup dan mengirim data
    return view('backend.pickup', ['pickups' => $pending, "superadmin" => $superadmin]);
  }

  public function pickupToFinish($nomornota)
  {
    // Mengganti status ready menjadi finish dan menghapus batas waktu
    Booking::where('nomornota', $nomornota)->update(['status' => 3, 'batasW' => 'not']);

    // Menampilkan pemberitahuan jika pesanan sudah selesai 
    Session::flash('success', 'Pesanan Selesai !');

    // Mengembalikan ke halaman pickup
    return redirect()->route('pickup.home');
  }

  public function history()
  {
    // Melakukan pengecekan jika yang login superadmin
    $level = session('level');
    if ($level === 'superadmin') {
      $superadmin = "superadmin";
    } else {
      $superadmin = "";
    }

    // Mengambil data pesanan dari database yang berstatus finish
    $history = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->where('bookings.status', '=', '3')
      ->select('bookings.*', 'pelanggans.nama', 'pelanggans.departemen', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->orderBy('created_at', 'asc')
      ->get();

    // Mengambil data printer dari database untuk membuat dropdown
    $printer = DB::table('printers')->get();

    // Menampilkan halaman histori & mengirim data data
    return view('backend.history', ['historys' => $history, 'printers' => $printer, "superadmin" => $superadmin]);
  }

  public function report()
  {
    // Melakukan pengecekan jika yang login superadmin
    $level = session('level');
    if ($level === 'superadmin') {
      $superadmin = "superadmin";
    } else {
      $superadmin = "";
    }

    // Menampilkan halaman report
    return view('backend.report', ['datas' => '', 'superadmin' => $superadmin]);
  }

  public function tampilData(Request $request)
  {
    // Mengambil data dari formulir
    $tanggalawal = $request->input('tanggalAw');
    $tanggalakhir = $request->input('tanggakAkh');

    // Membuat variabel periode untuk ditampilkan
    $periode = $tanggalawal . ' - ' . $tanggalakhir;

    // Mengambil data dari database yang berada dalam range tanggal yang diminta
    $report = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->whereBetween('bookings.created_at', [$tanggalawal, $tanggalakhir])
      ->where('bookings.status', '=', '3')
      ->select('bookings.*', 'pelanggans.nama', 'pelanggans.departemen', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->orderBy('bookings.created_at', 'asc')
      ->get();

    // Menampilkan data ke halaman report
    return view('backend.report', ['datas' => $report, 'periode' => $periode]);
  }

  public function cetak(Request $request)
  {
    // Mengambil data yang dikirimkan dari url
    $data = json_decode(urldecode($request->query('data')));

    // Mengambil data tanggal yang dikririmkan dari url
    $periode = $request->query('periode');

    // Menampilkan halaman cetak / simpan ke pdf
    return view('backend.cetak', ['datas' => $data, 'periode' => $periode]);
  }
}
