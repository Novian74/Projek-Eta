<?php

/**
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 *
 *
 ******* FUNCTION ********
 * function index : Untuk menampilkan halaman relasi
 * function tampilTambahRelasi : Untuk menampilkan form relasi
 * function store : Untuk menambah relasi
 * function destroy : Untuk menghapus relasi
 */

namespace App\Http\Controllers;

use App\Models\PrintCatridge;
use App\Models\Printer;
use App\Models\Tinta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PrintCatridgeController extends Controller
{
  public function index()
  {
    // Melakukan pengecekan jika yang login superadmin
    $level = session('level');
    if ($level === 'superadmin') {
      $superadmin = 'superadmin';
    } else {
      $superadmin = '';
    }

    // Membuat relasi antara printer dan tinta dari database
    $printcat = DB::table('print_catridges')
      ->join('printers', 'print_catridges.idprint', '=', 'printers.idprint')
      ->join('tintas', 'print_catridges.idcatridge', '=', 'tintas.idcatridge')
      ->select('print_catridges.*', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->orderBy('idprint', 'asc')
      ->get();

    // Menampilkan halaman relasi
    return view('backend.printcat', ['princats' => $printcat, 'superadmin' => $superadmin]);
  }

  public function tampilTambahRelasi()
  {
    // Mengambil data printer dan data tinta
    $printer = Printer::all();
    $catridge = Tinta::all();

    // Menampilkan form relasi
    return view('backend.form.formprintcat', ['printers' => $printer, 'catridges' => $catridge]);
  }

  public function store(Request $request)
  {
    // Membuat validasi pada form yang diinputkan
    $validatedData = $request->validate([
      'idprint' => 'required',
      'idcatridge' => 'required',
    ]);

    // Menambahkan data ke database
    PrintCatridge::create($validatedData);

    // Membuat pemberitahuan
    Session::flash('success', 'Relasi Berhasil Ditambahkan !');

    // Mengembalikan ke menu relasi
    return redirect()->route('princat.home');
  }

  public function destroy($id)
  {
    // Mencari data yang ingin dihapus sesuai id
    PrintCatridge::where('PrCt', $id)->delete();

    // Membuat pemberitahuan
    Session::flash('success', 'Relasi Berhasil Dihapus !');

    // Mengembalikan ke menu relasi
    return redirect()->route('princat.home');
  }
}
