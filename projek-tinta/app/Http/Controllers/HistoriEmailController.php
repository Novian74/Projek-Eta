<?php

/**
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 *
 *
 ******* FUNCTION ********
 * function index : Untuk menampilkan tabel histori email
 * function downlaod : Untuk mendownload dokumen yang telah dikirim email
 *
 */

namespace App\Http\Controllers;

use App\Models\HistoriEmail;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class HistoriEmailController extends Controller
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

    // Mengambil data email dari database
    $historiEmail = HistoriEmail::orderBy('tgl_kirim', 'asc')->get();

    // Menampilkan ke halaman histori email
    return view('backend.historiemail', ['historis' => $historiEmail, "superadmin" => $superadmin]);
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
