<?php

/** 
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 * 
 * 
 ******* FUNCTION ********
 * function index :
 * function tglKirim :
 * function downlaod :
 * 
 */

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\HistoriEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HistoriEmailController extends Controller
{
  // Function untuk menampilkan data histori pengiriman email tiap bulan
  public function index()
  {
    $email = HistoriEmail::select('id', 'tgl_kirim')->get();
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

    admin::where('id', 1)->update(['tgl_kirim_email' => $tanggalBerikutnya->toDateString()]);

    Session::flash('success', 'Pengiriman email akan dikirim pada ' . $tanggalBerikutnya->toDateString());

    return redirect()->route('setting.home');
  }

  public function download($id)
  {
    $historiEmail = HistoriEmail::find($id);

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
