<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 ******* FUNCTION ********
 * function index :
 * function tampilTambahTinta :
 * function store : 
 * function tampilUbahTinta :
 * function update :
 * function destroy :
 * 
 */

namespace App\Http\Controllers;

use App\Models\Tinta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TintaController extends Controller
{
  public function index()
  {
    $catridge = Tinta::where('TC', 2)->get();
    $toner = Tinta::where('TC', 1)->get();
    return view('backend.stoktinta', ['catridges' => $catridge, 'toners' => $toner]);
  }

  public function tampilTambahTinta()
  {
    $judul = 'Tambah';
    $route = 'tinta.store';
    $data = [
      (object) [
        'idcatridge' => '',
        'catridge_name' => '',
        'TC' => 'pilih',
        'warna' => 'pilih',
        'qty' => '',
        'stok' => '',
      ],
    ];
    return view('backend.form.formtinta', ['judul' => $judul, 'route' => $route, 'data' => $data]);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'catridge_name' => 'required',
      'TC' => 'required|in:1,2',
      'warna' => 'required',
      'qty' => 'required|numeric',
      'stok' => 'required|numeric',
    ]);

    // Mengambil idtinta terakhir dari database
    $lastIdTinta = Tinta::max('idcatridge');

    // Mengekstrak angka dari idtinta terakhir
    $lastNumber = (int) substr($lastIdTinta, 3);

    // Membuat idtinta baru dengan angka yang diincrement
    $newNumber = $lastNumber + 1;
    $newIdTinta = 'CT ' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    $validatedData['idcatridge'] = $newIdTinta;

    //Menyimpan data ke dalam database
    Tinta::create($validatedData);

    Session::flash('success', 'Tinta Berhasil Ditambahkan !');

    return redirect()->route('tinta.home');
  }

  public function tampilUbahTinta($id)
  {
    $judul = 'Ubah';
    $route = 'tinta.update';
    $update = "update";
    $data = Tinta::where('idcatridge', $id)->get();
    return view('backend.form.formtinta', ['judul' => $judul, 'update' => $update, 'route' => $route, 'data' => $data]);
  }

  public function update(Request $request)
  {
    $id = $request->input('idcatridge');
    $validatedData = $request->validate([
      'catridge_name' => 'required',
      'TC' => 'required|in:1,2',
      'warna' => 'required',
      'qty' => 'required|numeric',
      'stok' => 'required|numeric',
    ]);
    Tinta::where('idcatridge', $id)->update($validatedData);

    Session::flash('success', 'Tinta Berhasil Diubah !');

    return redirect()->route('tinta.home');
  }

  public function destroy($id)
  {
    Tinta::where('idcatridge', $id)->delete();
    Session::flash('success', 'Tinta Berhasil Dihapus !');
    return redirect()->route('tinta.home');
  }
}
