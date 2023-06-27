<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRequest;
use App\Models\PrintCatridge;
use Illuminate\Support\Facades\DB;

class PrintCatridgeController extends Controller
{
  // Function untuk menampilkan data printer dan catridge setelah di relasikan
  public function index()
  {
    $user = DB::table('print_catridges')
      ->join('printers', 'print_catridges.idprint', '=', 'printers.idprint')
      ->join('tintas', 'print_catridges.idcatridge', '=', 'tintas.idcatridge')
      ->select('print_catridges.*', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->orderBy("idprint", "asc")
      ->get();
    return response()->json($user);
  }

  // Function untuk menambah relasi printer dan catridge
  public function store(StoreTestRequest $request)
  {
    PrintCatridge::create($request->validated());
  }

  // Function untuk menghapus relasi printer dan catridge sesuai id
  public function destroy($id)
  {
    PrintCatridge::where("PrCt", $id)->delete();
  }

  // Function untuk mencari printer dan catridge sesuai permintaan
  public function test($print, $warna)
  {
    $cek = DB::table('print_catridges')
      ->join('printers', 'print_catridges.idprint', '=', 'printers.idprint')
      ->join('tintas', 'print_catridges.idcatridge', '=', 'tintas.idcatridge')
      ->where('printers.printer_name', '=', $print)
      ->where('tintas.warna', '=', $warna)
      ->select('print_catridges.*', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
      ->orderBy("idprint", "asc")
      ->get();
    return response()->json($cek);
  }
}
