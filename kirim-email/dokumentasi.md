// Visual Studio Code v1.79.2
// Live Server Port: http://localhost:8080/kirim-email/
// Scirpt ini menjalankan fungsi download histori dan pengiriman email

/\*\*

- Nama Program: KIRIM EMAIL Menggunakan PHP, JavaScript, HTML, Composer
- Deskripsi : Program ini adalah contoh dari penggunaan logika untuk menjalankan sebuah proses secara setruktur
- Pembuat : [IT]
- Waktu dibuat : [06-2023]
  \*/

//===========================================
//== Keterangan ==
//===========================================
// 1. Program ini dibuat untuk menjalankan sebuah logika pengiriman email secara terstruktur
// 2. Fungsi node.js untuk menjalankan node_modules
// 3. Menggunakan tcpdf untuk mengconvert data dari data base ke dalam file pdf.
// 4. Menggunakan node_modules untuk melakukan pengelolaan dependensasi.
// 5. Menggunakan node_mailer dan chokidar untuk menjalankan fungsi kirim email

//===========================================
//== Struktur Folder dan File ==
//===========================================
// - email : Folder yang berisi program untuk menjalankan kirim email secara otomatis
// - email/.vscode : Berisi konfigurasi launch.json
// - chokidar : Dependensasi yang digunakan untuk memantau perubahan file dalam folder
// - node_modules : Digunakan untuk menjalankan nodemailer
// - script2.js : Berisi serentetan program nodejs untuk menjalankan program kirim email

// - download.php : Berisi program untuk membuat link download pada databse histori sehingga dapat mengambil pdf secara manual menggunakan link

// - index.php : Berisi program untuk menjalankan fungsi kirim email otomatis dengan cara memngambil histori sebulan yang lalu dan akan diambil sesuai
// dengan waktu yang disetting untuk admin yang kemudian dimasukan ke dalam folder email

// - tcpdf : Dipendensasi untuk membuat program yang memungkinkan mengambil data mentah menjadi pdf yang dirapihkan

// - node_modules : Untuk menggunakan fungsinya sebagai pengatur dipendensasi

// - F : Digunakan untuk temp%

// - dokumentasi.md : Berisi dokumentasi program kirim email

//===========================================
//== Pelogikaan ==
//===========================================

//Mengambil data dari database pengconvertan menjadi pdf//

//Data dari database histori akan diambil dari tanggal 1-30 atau 1- akhir bulan sebelumnya kemudian dikirim ditanggal yang disetting oleh admin untuk bulan depannya,
//Kemudian data diambil dari link api yang sudah dibuat denga laravel dan diconvert di index.php yang akan otomatis refresh setiap menit untuk mengecek tanggal admin apakah sudah waktunya mengirim email
//kemudian pdf menjadi 2 jalur yaitu masuk ke database admin untuk diambil secara manual dan satunya masuk ke folder email untuk dikirimkan secara otomatis menggunakan email.

//Pengiriman File pdf melalui email//

//File yang masuk sudah diberi nama booking_report.pdf yang akan menjalankan fungsi watch pada chokidar dan akan menjalankan deretan program yaitu pertama mengirim pdf tersebut menggunakan email dan dikirim ke email yang sudah ditentukan menggunakan nodemailer
//Kemudian setelah terkirim file pdf booking_report.pdf akan otomatis terhapus karena untuk mencegah penumpukkan folder dan error
//Run and debug dengan sekali menyalakan (node.js) maka kirim email akan terus berjalan

//===========================================
//== Dependensi Eksternal ==
//===========================================
// - Node js : https://nodejs.org/
// - chokidar : https://www.npmjs.com/package/chokidar
// - composer : https://getcomposer.org/
