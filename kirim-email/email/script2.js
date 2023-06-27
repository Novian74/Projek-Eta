// File ini menggunakan javascript node mailer dan chokidar untuk dependensasinya
// Visual Studio Code v1.79.2
// Node js v18.13.0
// Chokidar v3.5.1
/**
 * Nama Program: EMAIl Menggunakan , JavaScript, node.js, nodemailer dan chokidar 
 * Deskripsi  : Program ini digunakan untuk menjalankan perintah mengirim email ketika folder booking_report.pdf masuk dengan bantuan chokidar dan nodemailer              
**/

// Mengimportkan file file yang akan digunakan 
const path = require('path');
const nodemailer = require('nodemailer');
const fs = require('fs');
const chokidar = require('chokidar');

// Menggambil file yang ingin dikirim
const folderPath = path.join(__dirname, 'booking_report.pdf');

// Function kirim email
function sendEmail(filePath) {
  // Menyiapkan akun gmail yang sudah di sandi aplikasi
  let transporter = nodemailer.createTransport({
    service: 'Gmail',
    auth: {
      user: 'ardhirizall@gmail.com',
      pass: 'sqsrbzxzjttslmey'
    }
  });

  // Menyiapkan file pdf yang ingin dikirim
  let attachments = [
    {
      filename: 'booking_report.pdf',
      path: filePath
    }
  ];

  // Menyiapkan pengaturan pengiriman email
  let mailOptions = {
    from: 'ardhirizall@gmail.com',
    to: 'palekaf713@gmail.com',
    subject: 'Laporan Bulanan Eta Catridge',
    text: 'Silakan temukan file PDF terlampir.',
    attachments: attachments
  };

  // Mengirim email
  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      // Jika ada error muncul pemberitahuan
      console.error('Terjadi kesalahan saat mengirim email:', error);
    } else {
      // Jika bisa terkirim akan muncul pemberitahuan
      console.log('Email terkirim: ', info.messageId);

      // Menghapus file otomatis setelah dikirim
      fs.unlink(filePath, (err) => {
        if (err) {
          // Jika ada error muncul pemberitahuan
          console.error('Terjadi kesalahan saat menghapus file:', err);
        } else {
          // Jika berhasil muncul pemberitahuan
          console.log('File berhasil dihapus:', filePath);
        }
      });
    }
  });
}

// Untuk memantau perubahan pada folder menggunakan chokidar
const watcher = chokidar.watch(folderPath, {
  ignored: /^\./,
  persistent: true
});

// Jika ada file booking masuk langsung menjalankan pengiriman email menggunakan chokidar
watcher.on('add', (filePath) => {
  const fileName = path.basename(filePath);
  if (fileName === 'booking_report.pdf') {
    sendEmail(filePath);
  }
});
