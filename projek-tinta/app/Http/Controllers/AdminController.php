<?php

/**  DOMPDF /
 * name     : dompdf/dompdf
 * descrip. : DOMPDF is a CSS 2.1 compliant HTML to PDF converter
 * keywords :
 * versions : * v2.0.3
 * type     : library
 * license  : GNU Lesser General Public License v2.1 only (LGPL-2.1) (OSI approved) https://spdx.org/licenses/LGPL-2.1.html#licenseText
 * homepage : https://github.com/dompdf/dompdf
 * source   : [git] https://github.com/dompdf/dompdf.git e8d2d5e37e8b0b30f0732a011295ab80680d7e85
 *
 * Visual Studio Code v1.79.2
 * Laravel Framework v10.10.1
 * Xampp Control Panel v3.3.0
 *
 ****** FUNCTION ********
 * function formLogin : Untuk menampilkan formulir login & melakukan pengiriman email otomatis
 * function login : Untuk memvalidasi jawaban formulir dan melakukan login ke admin
 * function adminPage : Untuk menampilkan halaman utama admin
 * function logout : Untuk mengeluarkan admin dari halaman admin
 *
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\admin;
use App\Models\Tinta;
use App\Models\Booking;
use App\Mail\kirimEmail;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
  public function formLogin()
  {
    // Mengambil alamat email dari database
    $usersWithEmail = admin::whereNotNull('email')->get();

    // Mengambil tanggal pengiriman email di database Admin
    $tgl = admin::select('tgl_kirim_email')->get();
    $data = json_decode($tgl, true);
    $tglKirimEmail = $data[0]['tgl_kirim_email'];
    $tanggalPengiriman = Carbon::parse($tglKirimEmail)->format('Y-m-d');

    // Membuat tanggal hari ini
    $date = Carbon::now('Asia/Jakarta');
    $formattedDate = $date->format('Y-m-d');

    // Melakukan pengecekan pada tanggal
    if ($tanggalPengiriman === $formattedDate) {
      // Membuat format tanggal kirim email
      $tanggalkirim = Carbon::parse($tglKirimEmail);

      // Menambahkan 1 bulan pada tanggal saat ini
      $tanggalSebelumnya = $tanggalkirim->copy()->subMonth();

      // Mendapatkan tanggal awal dan akhir pada bulan berikutnya
      $tanggalAwal = $tanggalSebelumnya->copy()->startOfMonth();
      $tanggalAkhir = $tanggalSebelumnya->copy()->endOfMonth();

      // Format tanggal
      $tanggalAwalFormatted = $tanggalAwal->format('Y-m-d');
      $tanggalAkhirFormatted = $tanggalAkhir->format('Y-m-d');

      // Mengambil data dari database sesuai tanggal sebelum pengiriman
      $datas = DB::table('bookings')
        ->join('pelanggans', 'bookings.iduser', '=', 'pelanggans.iduser')
        ->join('printers', 'bookings.idprint', '=', 'printers.idprint')
        ->join('tintas', 'bookings.idcatridge', '=', 'tintas.idcatridge')
        ->whereBetween('bookings.created_at', [$tanggalAwalFormatted, $tanggalAkhirFormatted])
        ->where('bookings.status', '=', '3')
        ->select('bookings.*', 'pelanggans.nama', 'pelanggans.departemen', 'printers.printer_name', 'tintas.catridge_name', 'tintas.warna')
        ->orderBy('bookings.created_at', 'asc')
        ->get();

      // Inisialisasi objek Dompdf
      $pdf = new Dompdf();

      // Menambahkan judul untuk periode
      $periode = $tanggalAwalFormatted . ' - ' . $tanggalAkhirFormatted;

      // Render view blade ke HTML
      $html = view('email', compact('datas', 'periode'))->render();

      // Mengambil file logo
      $gambarPath = public_path('images/logo.png');

      // Muat HTML ke objek Dompdf
      $pdf->loadHtml($html);

      // Atur opsi-opsi Dompdf
      $pdf->setPaper('A4', 'landscape');

      // Render PDF
      $pdf->render();

      // Menambahkan logo di pdf
      $canvas = $pdf->getCanvas();
      $canvas->image($gambarPath, 615, 30, 190, 80);

      // Simpan PDF ke variable
      $pdfContent = $pdf->output();

      // Membuat format tanggal untuk histori pengiriman
      $tgl_kirim = Carbon::now('Asia/Jakarta')->format('d-m-Y');

      foreach ($usersWithEmail as $user) {
        $email = $user->email;

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          // Memasukan ke database file pdf & tanggal pengiriman
          DB::table('histori_emails')->insert([
            'email_penerima' => $email,
            'tgl_kirim' => $tgl_kirim,
            'pdf' => $pdfContent,
          ]);

          // Kirim PDF melalui email
          $mail = new kirimEmail($pdfContent);
          $mail->to($email);
          $mail->subject('Laporan Bulanan');
          Mail::send($mail);
        }
      }
    }

    // Menampilkan formulir login
    return view('backend.login');
  }

  public function login(Request $request)
  {
    // Mengambil data dari formulir
    $username = $request->input('username');
    $password = $request->input('password');

    // Mencari data yang sesuai username
    $admin = Admin::where('username', '=', $username)->first();
    $level = $admin->level;

    // Memeriksa kiriman data sesuai dengan data admin
    if ($admin && $admin->username === $username && $admin->password === $password) {
      // Jika sesuai, set session dan redirect ke halaman admin
      session(['username' => $username]);
      session(['level' => $level]);
      return redirect()->route('admin');
    } else {
      // Jika tidak sesuai, kembali ke halaman login dengan pesan error
      return redirect()
        ->back()
        ->with('error', 'Username atau password salah.');
    }
  }

  public function adminPage()
  {
    // Melakukan pengecekan jika yang login superadmin
    $level = session('level');
    if ($level === 'superadmin') {
      $superadmin = "superadmin";
    } else {
      $superadmin = "";
    }

    // Inisialisasi array pesan peringatan
    $warnings = [];

    // Mengambil data printer dari database
    $data = Tinta::select('catridge_name', 'stok', 'qty')->get();
    foreach ($data as $item) {
      // Jika stok sudah melewati batas minimum akan mengeluarkan peringatan
      if ($item->stok <= $item->qty) {
        $warnings[] = 'Stok tinta ' . $item->catridge_name . ' Menipis !';
      }
    }

    // Simpan pesan-pesan peringatan dalam session flash
    if (!empty($warnings)) {
      Session::flash('errors', $warnings);
    }

    // Mengambil data booking & membuat format tanggal hari ini
    $bookings = Booking::all();
    $batas = Carbon::now('Asia/Jakarta');

    foreach ($bookings as $booking) {
      // Jika pada kolom batas waktu not batas waktu akan random agar tidak terjadi pesanan hangus
      if ($booking->batasW === 'not') {
        $batasFormatted = '99999999999999999';
        $batasWFormatted = '0999999999999999999';
      } else {
        // Jika pada kolom batas waktu terdapat waktu akan membuat format baru
        $batasW = Carbon::parse($booking->batasW);
        $batasFormatted = $batas->format('Y-m-d H:i:s');
        $batasWFormatted = $batasW->format('Y-m-d H:i:s');
      }

      // Jika batas waktu sudah melewati hari ini pesanan akan hangus
      if ($batasWFormatted < $batasFormatted) {
        // Mengambil nomor nota dan iduser
        $nomornota = $booking->nomornota;
        $iduser = $booking->iduser;

        // Menghapus pesanan dan identitas pelanggan
        Booking::where('nomornota', $nomornota)->delete();
        Pelanggan::where('iduser', $iduser)->delete();
      }
    }

    // Menampilkan halaman admin
    return view('backend.admin', ['superadmin' => $superadmin]);
  }

  public function logout(Request $request)
  {
    // Menghapus session dan redirect ke halaman login
    $request->session()->forget('username');

    // Kembali ke halaman login
    return redirect()->route('login');
  }
}
