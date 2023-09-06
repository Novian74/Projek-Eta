<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 * 
 ******* FUNCTION ********
 * function index : Untuk menampilkan halaman pelanggan
 * fucntion store : Untuk menambah pelanggan
 * function delete : Untuk menghapus pelanggan
 * 
 */

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;

class PelangganController extends Controller
{
  public function index()
  {
    // Melakukan pengecekan jika yang login superadmin
    $level = session('level');
    if ($level === 'superadmin') {
      $superadmin = "superadmin";
    } else {
      $superadmin = "";
    }
    // Mengambil data dari database yang diurutkan sesuai iduser pertama
    $pelanggan = Pelanggan::orderBy("iduser", "asc")->get();

    // Menampilkan halaman pelanggan
    return view('backend.pelanggan', ['pelanggans' => $pelanggan, "superadmin" => $superadmin]);
  }

  public function store(StorePelangganRequest $request)
  {
    // Menambahkan data pelanggan
    Pelanggan::create($request->validated());
  }

  public function delete($id)
  {
    // Menghapus data pelanggan
    Pelanggan::where("iduser", $id)->delete();
  }
}
