<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 * 
 ******* FUNCTION ********
 * function index :
 * fucntion store :
 * function delete :
 * 
 */

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;

class PelangganController extends Controller
{
  // Function untuk menampilkan semua data pelanggan
  public function index()
  {
    $pelanggan = Pelanggan::orderBy("iduser", "asc")->get();
    return view('backend.pelanggan', ['pelanggans' => $pelanggan]);
  }

  // Function untuk menambah data pelanggan
  public function store(StorePelangganRequest $request)
  {
    Pelanggan::create($request->validated());
  }

  // Function untuk menghapus data pelanggan
  public function delete($id)
  {
    Pelanggan::where("iduser", $id)->delete();
  }
}
