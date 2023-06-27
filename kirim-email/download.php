<?php

// File ini menggunakan php,  node.js untuk dependensasinya
// Visual Studio Code v1.79.2
// Node js v18.13.0
// Server version: 10.4.24-MariaDB (localhost)

// Menyambungkan koneksi ke database 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rest_etacatridge";
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengambil id yang dikirim dari link
$id = $_GET['id'];

// Mengambil data dari database berdasarkan id
$sql = "SELECT pdf FROM histori_emails WHERE id = $id";

// Menjalankan query
$result = $conn->query($sql);

// Mengecek apakah ada data 
if ($result->num_rows > 0) {

  // Membuat data menjadi array assosiatif
  $row = $result->fetch_assoc();

  // Menggambil file pdf dari database
  $file_data = $row['pdf'];

  // Tipe konten yang akan dikirim
  header('Content-Type: application/pdf');

  // Mengirimkan file nya beserta memberi nama
  header('Content-Disposition: attachment; filename="pdf_' . $id . '.pdf"');

  // Menginformasikan panjang (ukuran) yang akan dikirim
  header('Content-Length: ' . strlen($file_data));

  // Menjalankan kiriman
  echo $file_data;
}

// Koneksi ke database akan mati
$conn->close();
