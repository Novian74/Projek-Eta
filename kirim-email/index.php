<?php
// File ini menggunakan php,  node.js untuk dependensasinya
// Visual Studio Code v1.79.2
// Node js v18.13.0
// Server version: 10.4.24-MariaDB (localhost)
// tcpdf v6.3.2

// Menyambungkan tcpdf untuk memakai fungsinya 
require_once('tcpdf/tcpdf.php');

// Link url API database 
$url = 'http://127.0.0.1:8000/api/admin';

//Mengambil konten dari database dan mengurai data tersebut menjadi array assosiatif
$data = file_get_contents($url);
$response = json_decode($data, true);

// Mengambil tanggal dan waktu kirim email
$inputDate =  $response[0]['tgl_kirim_email'];
$inputTime = $response[0]['waktu_kirim_email'];

// Memisahkan tanggal menjadi hari, bulan, dan tahun
$dateParts = explode("-", $inputDate);
$day = intval($dateParts[0]);
$month = intval($dateParts[1]);
$year = intval($dateParts[2]);

// Membuat format tanggal baru
$date = DateTime::createFromFormat("j-n-Y", $inputDate);

// Menghitung bulan sebelumnya
$previousMonth = clone $date;
$previousMonth->modify("-1 month");

// Menghitung tanggal pertama dari bulan tersebut 
$startOfMonth = clone $previousMonth;
$startOfMonth->setDate($previousMonth->format("Y"), $previousMonth->format("m"), 1);

// Menghitung tanggal terakhir dari bulan tersebut
$endOfMonth = clone $previousMonth;
$endOfMonth->setDate($previousMonth->format("Y"), $previousMonth->format("m"), $previousMonth->format("t"));

// Membuat format awal bulan dan akhir bulan
$outputStartDate = $startOfMonth->format("Y-m-d");
$outputEndDate = $endOfMonth->format("Y-m-d");

// Link API untuk mendapatkan pesanan dalam tanggal tersebut
$url = "http://127.0.0.1:8000/api/booking/report/" . $outputStartDate . '/' . $outputEndDate;

// Mengambil konten dari database dan mengurai data tersebut menjadi array assosiatif
$data = file_get_contents($url);
$dataArray = json_decode($data, true);

// Function untuk membuat file pdf (function ini membutuhkan data report, tanggal awal, dan tanggal akhir)
function generatePDF($data, $outputStartDate, $outputEndDate)
{
  // Membuat objek TCPDF dan mengatur layout kertas
  $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

  // Memberi identitas pada dokumen
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('Printer Catridge');
  $pdf->SetTitle('Booking Report');
  $pdf->SetSubject('Booking Report');
  $pdf->SetKeywords('Booking, Report');

  // Mengatur tampilan dari kertas
  $pdf->SetHeaderData('', 0, 'Laporan Bulanan', $outputStartDate . ' - ' . $outputEndDate, array(0, 0, 0), array(255, 255, 255));
  $pdf->setHeaderFont(array('helvetica', '', 15));
  $pdf->setFooterFont(array('helvetica', '', 8));
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  $pdf->SetMargins(9, PDF_MARGIN_LEFT, PDF_MARGIN_TOP, 5, PDF_MARGIN_RIGHT);
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  $pdf->setFontSubsetting(true);
  $pdf->SetFont('dejavusans', '', 10, '', true);
  $pdf->AddPage('L');
  $pdf->SetFont('helvetica', '', 12);

  // Membuat kolom kolom tabel
  $header = array('Tanggal Pesan', 'Tanggal Ambil', 'Nomor Nota', 'Nama', 'Departemen', 'Printer', 'Cartridge Name', 'Warna');

  // Memberi warna pada tabel
  $pdf->SetFillColor(240, 240, 240);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetDrawColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 10);

  // Mengatur kolom kolom yang memerlukan ukuran yang lebih panjang
  foreach ($header as $col) {
    if ($col == 'Printer') {
      $pdf->Cell(53, 10, $col, 1, 0, 'C', 1);
    } else if ($col == 'Nomor Nota') {
      $pdf->Cell(25, 10, $col, 1, 0, 'C', 1);
    } else if ($col == 'Warna') {
      $pdf->Cell(25, 10, $col, 1, 0, 'C', 1);
    } else {
      $pdf->Cell(35, 10, $col, 1, 0, 'C', 1);
    }
  }
  $pdf->Ln();
  $pdf->SetFont('helvetica', '', 10);

  // Melakukan pengulangan agar semua data bisa tampil
  foreach ($data as $row) {
    // Membuat variabel berisi data data setiap kolom
    $tanggal = new DateTime($row['created_at']);
    $tanggalA = new DateTime($row['updated_at']);
    $nomorNota = $row['nomornota'];
    $nama = $row['nama'];
    $departemen = $row['departemen'];
    $printerName = $row['printer_name'];
    $cartridgeName = $row['catridge_name'];
    $warna = $row['warna'];

    // Mengisi data ke setiap kolom
    $pdf->Cell(35, 10, $tanggal->format('d/m/Y'), 1, 0, 'C');
    $pdf->Cell(35, 10, $tanggalA->format('d/m/Y'), 1, 0, 'C');
    $pdf->Cell(25, 10, $nomorNota, 1, 0, 'C');
    $pdf->Cell(35, 10, $nama, 1, 0, 'C');
    $pdf->Cell(35, 10, $departemen, 1, 0, 'C');
    $pdf->Cell(53, 10, $printerName, 1, 0, 'C');
    $pdf->Cell(35, 10, $cartridgeName, 1, 0, 'C');
    $pdf->Cell(25, 10, $warna, 1, 0, 'C');
    $pdf->Ln();
  }

  // Melakukan penyimpanan file pdf di folder email
  $pdf->Output(__DIR__ . '/email/booking_report.pdf', 'F');

  // Menyimpan dengan tipe string untuk dikirim ke database
  $pdfData = $pdf->Output('', 'S');

  // Melakukan koneksi ke database
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'rest_etacatridge';
  $conn = new mysqli($host, $username, $password, $database);

  // Membuat format tanggal sekarang
  $currentDateTime = new DateTime();
  $tglKirim = $currentDateTime->format('d-m-Y');

  // Melakukan pengiriman file pdf dan tanggal pengiriman ke database
  $stmt = $conn->prepare('INSERT INTO histori_emails (pdf, tgl_kirim) VALUES (?, ?)');
  $stmt->bind_param('ss', $pdfData, $tglKirim);
  $stmt->send_long_data(0, $pdfData);
  $stmt->send_long_data(1, $tglKirim);
  $stmt->execute();
  $stmt->close();
  $conn->close();
}

// Membuat variabel berisi tanggal dan waktu pengiriman dari database 
$targetDate = $inputDate;
$targetTime = $inputTime;

// Membuat format tanggal dan waktu sekarang
$currentDateTime = new DateTime();
$currentDate = $currentDateTime->format('d-m-Y');
$currentTime = $currentDateTime->format('H:i');

// Melakukan pengecekan 
if ($currentDate === $targetDate && $currentTime === $targetTime) {
  // Jika sesuai dengan tanggal dan waktu sekarang akan melakukan function dibawah
  $data = $dataArray;
  generatePDF($data, $outputStartDate, $outputEndDate);
  echo "File PDF berhasil dibuat.";
}

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Untuk merefresh page secara otomatis setiap 40 detik -->
  <meta http-equiv="refresh" content="60">
</head>

<body>
  <h3>page kirim email</h3>
</body>

</html>