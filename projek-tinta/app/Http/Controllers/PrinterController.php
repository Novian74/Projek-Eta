<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 ******* FUNCTION ********
 * function index : Untuk menampilkan halaman printer
 * function tampilTambahPrinter: Untuk menampilkan form printer
 * function store : Untuk menambahkan printer
 * function tampilUbahPrinter : Untuk menampilkan form ubah
 * function update : Untuk mengubah data printer
 * function destroy : Untuk menghapus printer
 */

namespace App\Http\Controllers;

use App\Models\Printer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrinterController extends Controller
{
  public function index()
  {
    // Mengambil data printer diurutkan dari idorint pertama
    $printer = Printer::orderBy('idprint', 'asc')->get();

    // Menampilkan halaman printer
    return view('backend.printer', ['printers' => $printer]);
  }

  public function tampilTambahPrinter()
  {
    // Membuat format data untuk ditampilkan
    $judul = 'Tambah';
    $route = 'printer.store';
    $data = [
      (object) [
        'idprint' => '',
        'printer_name' => '',
        'model_tinta' => 'pilih',
      ],
    ];

    // Menampilkan form printer
    return view('backend.form.formprinter', ['judul' => $judul, 'route' => $route, 'data' => $data]);
  }

  public function store(Request $request)
  {

    // Membuat validasi dari form input
    $validatedData = $request->validate([
      'printer_name' => 'required',
      'model_tinta' => 'required|in:1,2',
    ]);

    // Mengambil idprinter terakhir dari database
    $lastIdPrinter = Printer::max('idprint');

    // Mengekstrak angka dari idtinta terakhir
    $lastNumber = (int) substr($lastIdPrinter, 3);

    // Membuat idtinta baru dengan angka yang diincrement
    $newNumber = $lastNumber + 1;
    $newIdPrinter = 'PR ' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    $validatedData['idprint'] = $newIdPrinter;

    // Menyimpan data ke dalam database
    Printer::create($validatedData);

    // Membuat pemberitahuan
    Session::flash('success', 'Printer Berhasil Ditambahkan !');

    // Mengembalikan ke halaman printer
    return redirect()->route('printer.home');
  }

  public function tampilUbahPrinter($id)
  {
    // Membuat format untuk menampilkan ke form
    $judul = 'Ubah';
    $route = 'printer.update';
    $update = 'update';

    // Mengambil data printer sesuai id
    $data = Printer::where('idprint', $id)->get();

    // Menampilkan form printer
    return view('backend.form.formprinter', ['judul' => $judul, 'update' => $update, 'route' => $route, 'data' => $data]);
  }

  public function update(Request $request)
  {
    // Mengambil id dari input
    $id = $request->input('idprint');

    // Membuat validasi data dari form
    $validatedData = $request->validate([
      'printer_name' => 'required',
      'model_tinta' => 'required|in:1,2',
    ]);

    // Mengubah data printer sesuai id
    Printer::where('idprint', $id)->update($validatedData);

    // Membuat pemberitahuan
    Session::flash('success', 'Printer Berhasil Diubah !');

    // Mengembalikan ke halaman printer
    return redirect()->route('printer.home');
  }

  public function destroy($id)
  {
    // Mencari data printer sesuai id dan menghapusnya
    Printer::where('idprint', $id)->delete();

    // Menambahkan pemberitahuan
    Session::flash('success', 'Printer Berhasil Dihapus !');

    // Mengembalikan ke halaman printer
    return redirect()->route('printer.home');
  }
}
