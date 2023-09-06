<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 * 
 ******* FUNCTION ********
 * function index : Menampilkan dropdown printer pada halaman utama
 * function cekPrinter : Mengecek model tinta pada printer yang dipilih
 * function pesanTinta : Membuat pesanan tinta
 * function home : Menampilkan halaman lacak pesanan
 * function lacak : Mencari pesanan sesuai yang diinputkan
 * 
 */

namespace App\Http\Controllers;

use App\Models\admin;
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
    // Mengambil data printer dari database
    $printer = DB::table('printers')->orderBy("printer_name", 'asc')->get();

    // Menampilkan tampilan halaman awal
    return view('frontend.pesan', ['printers' => $printer, 'id' => '']);
  }

  public function cekPrinter(Request $request)
  {
    // Mengambil id dari kolom dropdown
    $id = $request->input('printer');

    // Mencari data printer 
    $printer = DB::table('printers')->orderBy("printer_name", 'asc')->get();
    $model = Printer::where('idprint', $id)
      ->select('model_tinta')
      ->get();

    // Membuat variabel untuk menampung model printer 
    $angka = $model[0]['model_tinta'];

    // Menampilkan form pesanan
    return view('frontend.pesan', ['id' => $id, 'printers' => $printer, 'model' => $angka]);
  }

  public function pesanTinta(Request $request)
  {
    // Membuat validasi dari form pesan
    $validatedData = $request->validate([
      'nama' => 'required',
      'departemen' => 'required',
      'gedung' => 'required',
      'area' => 'required',
      'idprint' => 'required',
      'warna' => 'required',
    ]);

    // Mencari iduser pada database yang paling akhir
    $lastIdUser = Pelanggan::max('iduser');

    // Mengekstrak angka dari idtinta terakhir
    $lastNumber = (int) substr($lastIdUser, 5);

    // Membuat idtinta baru dengan angka yang diincrement
    $newNumber = $lastNumber + 1;
    $newIdUser = 'USER ' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    // Membuat variabel yang berisi data pelanggan
    $dataP = [
      'iduser' => $newIdUser,
      'nama' => $validatedData['nama'],
      'gedung' => $validatedData['gedung'],
      'area' => $validatedData['area'],
      'departemen' => $validatedData['departemen'],
    ];

    // Mencari tinta yang sesuai dengan printer dan warna yang dipilih
    $cek = DB::table('print_catridges')
      ->join('printers', 'print_catridges.idprint', '=', 'printers.idprint')
      ->join('tintas', 'print_catridges.idcatridge', '=', 'tintas.idcatridge')
      ->where('printers.idprint', '=', $validatedData['idprint'])
      ->where('tintas.warna', '=', $validatedData['warna'])
      ->select('tintas.idcatridge')
      ->get();
    $data = json_decode($cek, true);
    $idcatridge = $data[0]['idcatridge'];

    // Membuat nomor random untuk nomor nota
    $no = mt_rand(100000, 999999);

    // Membuat variabel berisi data pesanan
    $dataB = [
      'nomornota' => "$no",
      'iduser' => $dataP['iduser'],
      'idprint' => $validatedData['idprint'],
      'idcatridge' => $idcatridge,
      'status' => '1',
      'batasW' => 'not',
    ];

    // Memasukkan data pelanggan dan data pesanan ke database
    Pelanggan::create($dataP);
    Booking::create($dataB);

    // Mendapatkan semua data pengguna dengan chat ID dari database
    $usersWithChatID = admin::whereNotNull('telegram')->get();

    // Membuat variabel berisi token bot telegram
    $token = '6007053333:AAHN_tUHbVie6AR2P6wrXChGae-JeOcRiLY';

    // Membuat variabel berisi link untuk mengirim notifikasi
    $url = "https://api.telegram.org/bot{$token}/sendMessage";

    // Pesan yang ingin dikirim
    $pesan = 'Ada Pesanan Tinta !';

    // Melakukan pengulangan sesuai chat id admin
    foreach ($usersWithChatID as $user) {
      // Mendapatkan chat ID pengguna saat ini
      $chat_id = $user->telegram;

      // Mengirim pesan ke telegram pengguna saat ini
      Http::get($url, [
        'chat_id' => $chat_id,
        'text' => $pesan,
      ]);
    }

    // Menampilkan halaman nota
    return view('frontend.nota', ['nomornota' => $dataB['nomornota'], 'tinta' => $validatedData['warna']]);
  }

  public function home()
  {
    // Menampilkan halaman lacak
    return view('frontend.lacak', ['datas' => '']);
  }

  public function lacak(Request $request)
  {
    // Mengambil data form nomornota
    $nomornota = $request->input('lacak');

    // Mencari data sesuai nomornota
    $lacak = DB::table('bookings')
      ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
      ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
      ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
      ->where('bookings.nomornota', '=', $nomornota)
      ->select('bookings.*', 'pelanggans.nama', 'printers.printer_name', 'tintas.warna')
      ->get();

    // Menampilkan datanya
    return view('frontend.lacak', ['datas' => $lacak]);
  }
}
