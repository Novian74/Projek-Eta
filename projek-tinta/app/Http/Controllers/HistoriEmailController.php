<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 * 
 ******* FUNCTION ********
 * function index : Untuk menampilkan tabel histori email
 * function tglKirim : Untuk mengubah tanggal pengiriman email
 * function downlaod : Untuk mendownload dokumen yang telah dikirim email
 * 
 */

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\HistoriEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class HistoriEmailController extends Controller
{
  // Function untuk menampilkan data histori pengiriman email tiap bulan
  public function index()
  {
    // Mengambil data dari database
    $email = HistoriEmail::select('id', 'tgl_kirim')->get();

    // Menampilkan ke halaman setting
    return view('backend.setting', ['emails' => $email]);
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

    // Mengubah data pengiriman email otomatis
    admin::where('id', 1)->update(['tgl_kirim_email' => $tanggalBerikutnya->toDateString()]);

    // Menambahkan pemberitahuan
    Session::flash('success', 'Pengiriman email akan dikirim pada ' . $tanggalBerikutnya->toDateString());

    // Kembali ke halaman setting
    return redirect()->route('setting.home');
  }

  public function download($id)
  {
    // Mengambil data pdf sesuai id
    $historiEmail = HistoriEmail::find($id);

    // Melakukan pengecekan ada filenya atau tidak
    if ($historiEmail) {
      // Menggambil file pdf dari database
      $fileData = $historiEmail->pdf;

      // Tipe konten yang akan dikirim
      $headers = [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="pdf_' . $id . '.pdf"',
        'Content-Length' => strlen($fileData),
      ];

      // Mengirimkan file
      return response($fileData, Response::HTTP_OK, $headers);
    } else {
      // Jika data tidak ditemukan
      abort(Response::HTTP_NOT_FOUND);
    }
  }
}
