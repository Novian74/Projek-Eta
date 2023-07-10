<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 ******* FUNCTION ********
 * function index :
 * function tampilTambahPrinter:
 * function store :
 * function tampilUbahPrinter :
 * function update :
 * function destroy :
 */

namespace App\Http\Controllers;

use App\Http\Requests\StorePrinterRequest;
use App\Models\Printer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PrinterController extends Controller
{
  // Function untuk menampilkan seluruh data printer
  public function index()
  {
    $printer = Printer::orderBy('idprint', 'asc')->get();
    return view('backend.printer', ['printers' => $printer]);
  }

  public function tampilTambahPrinter()
  {
    $judul = 'Tambah';
    $route = 'printer.store';
    $data = [
      (object) [
        'idprint' => '',
        'printer_name' => '',
        'model_tinta' => 'pilih',
      ],
    ];
    return view('backend.form.formprinter', ['judul' => $judul, 'route' => $route, 'data' => $data]);
  }

  public function store(Request $request)
  {
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

    Session::flash('success', 'Printer Berhasil Ditambahkan !');

    return redirect()->route('printer.home');
  }

  public function tampilUbahPrinter($id)
  {
    $judul = 'Ubah';
    $route = 'printer.update';
    $update = 'update';
    $data = Printer::where('idprint', $id)->get();
    return view('backend.form.formprinter', ['judul' => $judul, 'update' => $update, 'route' => $route, 'data' => $data]);
  }

  // Function untuk mengubah data printer
  public function update(Request $request)
  {
    $id = $request->input('idprint');
    $validatedData = $request->validate([
      'printer_name' => 'required',
      'model_tinta' => 'required|in:1,2',
    ]);
    Printer::where('idprint', $id)->update($validatedData);

    Session::flash('success', 'Printer Berhasil Diubah !');

    return redirect()->route('printer.home');
  }

  // Function untuk mengapus data printer sesuai id
  public function destroy($id)
  {
    Printer::where('idprint', $id)->delete();
    Session::flash('success', 'Printer Berhasil Dihapus !');
    return redirect()->route('printer.home');
  }
}
