<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\admin;

class AdminController extends Controller
{
  // Function untuk menampilkan isi tabel admin
  public function index()
  {
    return admin::all();
  }

  // Function merubah tanggal & waktu kirim email
  public function update(UpdateAdminRequest $request, $id)
  {
    // Merubah data sesuai id yang ada dari $id
    admin::where("id", $id)->update([
      'tgl_kirim_email' => $request->input('tgl_kirim_email'),
      'waktu_kirim_email' => $request->input('waktu_kirim_email')
    ]);
  }

  public function login(LoginAdminRequest $request)
  {
    // Mendapat kiriman data dari form login
    $username = $request->input('username');
    $password = $request->input('password');

    // Mencari data yang sesuai username
    $admin = admin::where('username', '=', $username)->first();

    // Memeriksa kiriman data sesuai dengan data admin
    if ($admin && $admin->username === $username && $admin->password === $password) {
      // Jika sesuai akan mengirim jawaban benar
      return response()->json('bener');
    } else {
      // Jika tidak sesuai akan mengirim jawaban salah
      return response()->json('salah');
    }
  }
}
