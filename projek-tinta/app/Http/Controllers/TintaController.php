<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 ******* FUNCTION ********
 * function index : Untuk menampilkan halaman tinta
 * function tampilTambahTinta : Untuk menampilkan form tambah tinta
 * function store : Untuk menambah data tinta
 * function tampilUbahTinta : Untuk menampilkan form ubah tinta
 * function update : Untuk mengubah data tinta
 * function destroy : Untuk mengapus data tinta
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
    // Mengambil data catridge dari database
    $catridge = Tinta::where('TC', 2)->get();

    // Mengambil data toner dari database
    $toner = Tinta::where('TC', 1)->get();

    // Menampilkan halaman tinta
    return view('backend.stoktinta', ['catridges' => $catridge, 'toners' => $toner]);
  }

  public function tampilTambahTinta()
  {
    // Membuat format untuk ditampilkan
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

    // Menampilkan form tinta
    return view('backend.form.formtinta', ['judul' => $judul, 'route' => $route, 'data' => $data]);
  }

  public function store(Request $request)
  {
    // Membuat validasi dari input form
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

    // Menambahkan pada kolom validated
    $validatedData['idcatridge'] = $newIdTinta;

    //Menyimpan data ke dalam database
    Tinta::create($validatedData);

    // Membuat pemberitahuan
    Session::flash('success', 'Tinta Berhasil Ditambahkan !');

    // Mengembalikan ke halaman tinta
    return redirect()->route('tinta.home');
  }

  public function tampilUbahTinta($id)
  {
    // Mmembuat format untuk menampilkan form
    $judul = 'Ubah';
    $route = 'tinta.update';
    $update = "update";

    // Mengambil data sesuai id
    $data = Tinta::where('idcatridge', $id)->get();

    // Menampilkan form
    return view('backend.form.formtinta', ['judul' => $judul, 'update' => $update, 'route' => $route, 'data' => $data]);
  }

  public function update(Request $request)
  {
    // Mengambil id dari form
    $id = $request->input('idcatridge');

    // Membuat validasi dari form
    $validatedData = $request->validate([
      'catridge_name' => 'required',
      'TC' => 'required|in:1,2',
      'warna' => 'required',
      'qty' => 'required|numeric',
      'stok' => 'required|numeric',
    ]);

    // Mengubah data tinta ke database
    Tinta::where('idcatridge', $id)->update($validatedData);

    // Membuat pemberitahuan
    Session::flash('success', 'Tinta Berhasil Diubah !');

    // Mengembalikan ke halaman tinta
    return redirect()->route('tinta.home');
  }

  public function destroy($id)
  {
    // Mencari data sesuai id dan menghapus data
    Tinta::where('idcatridge', $id)->delete();

    // Membuat pemberitahuan
    Session::flash('success', 'Tinta Berhasil Dihapus !');

    // Mengembalikan ke halaman tinta
    return redirect()->route('tinta.home');
  }
}
