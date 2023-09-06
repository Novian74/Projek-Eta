<?php

/**
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 *
 *
 ******* FUNCTION ********
 *listUser = untuk menampilkan tabel admin
 *formAdmin = untuk menampilkan form tambah admin
 *tambahAdmin = untuk melakukan penambahan data ke database
 *destroy = untuk menghapus admin
 *profile = untuk menampilkan halaman profile
 *tglkirim = untuk mengubah pengiriman email otomatis pada admin
 *email = untuk mengubah alamat email pada admin
 *telegram = untuk mengubah chat id telegram pada admin
 */

namespace App\Http\Controllers;

use App\Models\admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
  public function listUser()
  {
    // Melakukan pengecekan jika yang login superadmin
    $level = session('level');
    if ($level === 'superadmin') {
      $superadmin = "superadmin";
    } else {
      $superadmin = "";
    }

    // Mengambil data admin dari database
    $admin = admin::orderBy('id', 'asc')->get();

    // Menampilkan halaman list user 
    return view('backend.listuser', ['admins' => $admin, 'superadmin' => $superadmin]);
  }

  public function formAdmin()
  {
    // Menampilkan form admin
    return view('backend.form.formadmin');
  }

  public function tambahAdmin(Request $request)
  {
    // Melakukan validasi dari pengiriman form
    $validatedData = $request->validate([
      'username' => 'required',
      'password' => 'required',
      'level' => 'required'
    ]);

    // Membuat variabel untuk pengiriman ke database
    $dataKirim = [
      'username' => $validatedData['username'],
      'password' => $validatedData['password'],
      'tgl_kirim_email' => '',
      'email' => '',
      'telegram' => '',
      'level' => $validatedData['level']
    ];

    // Membuat data ke database
    admin::create($dataKirim);

    // Menambahkan pemberitahuan
    Session::flash('success', 'Admin Berhasil Ditambah !');

    // Mengembalikan ke halaman printer
    return redirect()->route('setting.listuser');
  }

  public function destroy($id)
  {
    // Menghapus admin sesuai id yang diminta
    admin::where('id', $id)->delete();

    // Menambahkan pemberitahuan
    Session::flash('success', 'Admin Berhasil Dihapus !');

    // Mengembalikan ke halaman printer
    return redirect()->route('setting.listuser');
  }


  public function profile()
  {
    // Melakukan pengecekan jika yang login superadmin
    $level = session('level');
    if ($level === 'superadmin') {
      $superadmin = "superadmin";
    } else {
      $superadmin = "";
    }

    // Mengambil session sesuai yang login
    $username = session('username');
    $level = session('level');

    // Menampilkan tampilan profile dan mengirim username
    return view('backend.profile', ['username' => $username, 'level' => $level, 'superadmin' => $superadmin]);
  }

  public function tglKirim(Request $request)
  {
    // Ambil input angka tanggal dari form
    $inputTanggal = $request->input('tgl');

    // Dapatkan tanggal saat ini
    $tanggalSaatIni = Carbon::now();

    // Tambahkan 1 bulan ke tanggal saat ini
    $tanggalBerikutnya = $tanggalSaatIni->addMonth();

    // Set tanggal pada bulan berikutnya dengan angka yang diinputkan
    $tanggalBerikutnya->day($inputTanggal);

    // Mengambil session sesuai yang login
    $username = session('username');

    // Mengubah data pengiriman email otomatis
    admin::where('username', $username)->update(['tgl_kirim_email' => $tanggalBerikutnya->toDateString()]);

    // Menambahkan pemberitahuan
    Session::flash('success', 'Pengiriman email akan dikirim pada ' . $tanggalBerikutnya->toDateString());

    // Kembali ke halaman profile
    return redirect()->route('setting.profile');
  }

  public function email(Request $request)
  {
    // Mengambil isi form
    $email = $request->input('email');

    // Mengambil session sesuai yang login
    $username = session('username');

    //   Mengubah alamat email di database
    admin::where('username', $username)->update(['email' => $email]);

    //   Menambahkan pemberitahuan
    Session::flash('success', 'Email akan terkirim kepada ' . $email);

    //   Kembali ke halaman profile
    return redirect()->route('setting.profile');
  }

  public function telegram(Request $request)
  {
    // Mengambil isi form
    $tele = $request->input('tele');

    // Mengambil session sesuai yang login
    $username = session('username');

    // Mengubah chat id di database
    admin::where('username', $username)->update(['telegram' => $tele]);

    // Menambahkan pemberitahuan
    Session::flash('success', 'Kirim start ke CATRIDGEBOT');

    // Kembali ke halaman profile
    return redirect()->route('setting.profile');
  }
}
