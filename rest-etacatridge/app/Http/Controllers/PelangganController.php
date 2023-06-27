<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;

class PelangganController extends Controller
{
  // Function untuk menampilkan semua data pelanggan
  public function index()
  {
    return Pelanggan::orderBy("iduser", "asc")->get();
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
