<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 * 
 ******* FUNCTION ********
 * function index :
 * function tampilTambahRelasi :
 * function store :
 * function destroy :
 */


namespace App\Http\Controllers;

use App\Models\PrintCatridge;
use App\Models\Printer;
use App\Models\Tinta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PrintCatridgeController extends Controller
{
  // Function untuk menampilkan data printer dan catridge setelah di relasikan
  public function index()
  {
    $printcat = DB::table('print_catridges')
      ->join('printers', 'print_catridges.idprint', '=', 'printers.idprint')
      ->join('tintas', 'print_catridges.idcatridge', '=', 'tintas.idcatridge')
      ->select('print_catridges.*', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->orderBy('idprint', 'asc')
      ->get();
    return view('backend.printcat', ['princats' => $printcat]);
  }

  public function tampilTambahRelasi()
  {
    $printer = Printer::all();
    $catridge = Tinta::all();
    return view('backend.form.formprintcat', ['printers' => $printer, 'catridges' => $catridge]);
  }

  // Function untuk menambah relasi printer dan catridge
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'idprint' => 'required',
      'idcatridge' => 'required',
    ]);

    PrintCatridge::create($validatedData);

    Session::flash('success', 'Relasi Berhasil Ditambahkan !');

    return redirect()->route('princat.home');
  }

  public function destroy($id)
  {
    PrintCatridge::where('PrCt', $id)->delete();
    Session::flash('success', 'Relasi Berhasil Dihapus !');
    return redirect()->route('princat.home');
  }
}
