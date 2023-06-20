<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
  // Function untuk menampilkan data pesanan 
  public function index()
  {
    $index = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->select('bookings.*', 'pelanggans.nama', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->get();
    return response()->json($index);
  }

  // Function untuk menampilkan data pesanan yang sedang pending
  public function pending()
  {
    $pending = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->where('bookings.status', '=', '1')
      ->select('bookings.*', 'pelanggans.nama', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->get();
    return response()->json($pending);
  }

  // Function untuk menampilkan data pesanan yang sedang pickup
  public function pickup()
  {
    $pickup = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->where('bookings.status', '=', '2')
      ->select('bookings.*', 'pelanggans.nama', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->get();
    return response()->json($pickup);
  }

  // Function untuk menampilkan data pesanan yang sudah selesai
  public function history()
  {
    $history = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->where('bookings.status', '=', '3')
      ->select('bookings.*', 'pelanggans.nama', 'pelanggans.departemen', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->get();
    return response()->json($history);
  }

  // Function untuk menampilkan data pesanan satu sesuai nomor nota
  public function show($id)
  {
    $show = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->where('bookings.nomornota', '=', $id)
      ->select('bookings.*', 'pelanggans.nama', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->get();
    if ($show->isEmpty()) {
      // Jika tidak ditemukan mengirim jawaban hangus
      return response()->json("Hangus");
    } else {
      // Jika ditemukan mengirim isi pesanan tersebut
      return response()->json($show);
    }
  }

  // Function untuk mencari data pesanan dari tanggal dipesan
  public function report($tanggalawal, $tanggalakhir)
  {
    $report = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->whereBetween('bookings.created_at', [$tanggalawal, $tanggalakhir])
      ->where('bookings.status', '=', '3')
      ->select('bookings.*', 'pelanggans.nama', 'pelanggans.departemen', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->orderBy('bookings.created_at', 'asc')
      ->get();
    return response()->json($report);
  }

  // Function untuk menambah pesanan
  public function store(StoreBookingRequest $request)
  {
    Booking::create($request->validated());
  }

  // Function untuk mengubah status pesanan & batas waktu pesanan
  public function update(UpdateBookingRequest $request, $id)
  {
    Booking::where("nomornota", $id)->update([
      'status' => $request->input('status'),
      'batasW' => $request->input('batasW')
    ]);
  }

  // Function untuk menghapus pesanan
  public function destroy($id)
  {
    Booking::where("nomornota", $id)->delete();
  }

  // Function untuk mengubah status pesanan
  public function status(Request $request, $id)
  {
    Booking::where("nomornota", $id)->update([
      'status' => $request->input('status'),
    ]);
  }
}
