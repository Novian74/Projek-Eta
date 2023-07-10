<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 * 
 ******* FUNCTION ********
 * function index :
 * function cekPrinter :
 * function pesanTinta :
 * function home :
 * function lacak :
 * 
 */

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Pelanggan;
use App\Models\Printer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FrontController extends Controller
{
  public function index()
  {
    $printer = Printer::all();
    return view('frontend.pesan', ['printers' => $printer, 'id' => '']);
  }

  public function cekPrinter(Request $request)
  {
    $id = $request->input('printer');
    $printer = Printer::all();
    $model = Printer::where('idprint', $id)
      ->select('model_tinta')
      ->get();
    $angka = $model[0]['model_tinta'];

    return view('frontend.pesan', ['id' => $id, 'printers' => $printer, 'model' => $angka]);
  }

  public function pesanTinta(Request $request)
  {
    $validatedData = $request->validate([
      'nama' => 'required',
      'departemen' => 'required',
      'gedung' => 'required',
      'area' => 'required',
      'idprint' => 'required',
      'warna' => 'required',
    ]);

    $lastIdUser = Pelanggan::max('iduser');

    // Mengekstrak angka dari idtinta terakhir
    $lastNumber = (int) substr($lastIdUser, 5);

    // Membuat idtinta baru dengan angka yang diincrement
    $newNumber = $lastNumber + 1;
    $newIdUser = 'USER ' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    $dataP = [
      'iduser' => $newIdUser,
      'nama' => $validatedData['nama'],
      'gedung' => $validatedData['gedung'],
      'area' => $validatedData['area'],
      'departemen' => $validatedData['departemen'],
    ];

    $cek = DB::table('print_catridges')
      ->join('printers', 'print_catridges.idprint', '=', 'printers.idprint')
      ->join('tintas', 'print_catridges.idcatridge', '=', 'tintas.idcatridge')
      ->where('printers.idprint', '=', $validatedData['idprint'])
      ->where('tintas.warna', '=', $validatedData['warna'])
      ->select('tintas.idcatridge')
      ->get();
    $data = json_decode($cek, true);
    $idcatridge = $data[0]['idcatridge'];
    $no = mt_rand(100000, 999999);

    $dataB = [
      'nomornota' => "$no",
      'iduser' => $dataP['iduser'],
      'idprint' => $validatedData['idprint'],
      'idcatridge' => $idcatridge,
      'status' => '1',
      'batasW' => 'not',
    ];

    Pelanggan::create($dataP);
    Booking::create($dataB);

    // Pesan yang ingin dikirim
    $pesan = 'Ada Pesanan Tinta !';

    // Membuat variabel berisi token bot telegram
    $token = '6007053333:AAHN_tUHbVie6AR2P6wrXChGae-JeOcRiLY';

    // Membuat variabel berisi chat id telegram tujuan
    $chat_id = '6127290706';

    // Membuat variabel berisi link mengirim notifikasi
    $url = "https://api.telegram.org/bot{$token}/sendMessage";

    // Mengirim pesan ke telegram
    Http::get($url, [
      'chat_id' => $chat_id,
      'text' => $pesan,
    ]);

    return view('frontend.nota', ['nomornota' => $dataB['nomornota'], 'tinta' => $validatedData['warna']]);
  }

  public function home()
  {
    return view('frontend.lacak', ['datas' => '']);
  }

  public function lacak(Request $request)
  {
    $nomornota = $request->input('lacak');

    $lacak = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->where('bookings.nomornota', '=', $nomornota)
      ->select('bookings.*', 'pelanggans.nama', 'printers.printer_name', 'tintas.warna')
      ->get();

    return view('frontend.lacak', ['datas' => $lacak]);
  }
}
