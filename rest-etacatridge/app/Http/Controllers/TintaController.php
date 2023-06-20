<?php

namespace App\Http\Controllers;

use App\Models\Tinta;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTintaRequest;
use App\Http\Requests\UpdateTintaRequest;

class TintaController extends Controller
{
  // Function untuk menampilkan data catridge
  public function index()
  {
    return Tinta::orderBy('idcatridge', 'asc')->get();
  }

  // Function untuk menambah data catridge
  public function store(StoreTintaRequest $request)
  {
    Tinta::create($request->validated());
  }

  // Function untuk menampilkan satu data catridge sesuai id
  public function show($id)
  {
    $cari = Tinta::where("idcatridge", $id)->get();
    return response()->json($cari);
  }

  // Function untuk mengubah data catridge
  public function update(UpdateTintaRequest $request, $id)
  {
    Tinta::where("idcatridge", $id)->update([
      'catridge_name' => $request->input('catridge_name'),
      'stok' => $request->input('stok')
    ]);
  }

  // Function untuk mengahpus data catridge
  public function destroy($id)
  {
    Tinta::where("idcatridge", $id)->delete();
  }

  // Function untuk mengubah isi stok catridge
  public function stok(Request $request, $id)
  {
    Tinta::where("idcatridge", $id)->update([
      'stok' => $request->input('stok')
    ]);
  }
}
