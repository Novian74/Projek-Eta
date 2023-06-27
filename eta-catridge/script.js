// Bootstrap v5.3.0-alpha3
// Axios v1.1.2
// Visual Studio Code v1.79.2
// Live Server Port: 5501
// Scirpt ini menjalankan fungsi yang berada di frontend

/**
 * Nama Program : index.html Menggunakan JavaScript, HTML dengan Bootstrap 5,
 *                Axios, dan jQuery
 * Deskripsi    : Program ini merupakan script yang digunakan untuk menjalankan seluruh request frontend.
 */

//===========================================
//==             Keterangan                 ==
//===========================================
// 1. Program ini mengambil data dari server menggunakan laravel dengan metode axios dan memasukkannya jika menerima request.
// 2. Menggunakan JavaScript untuk membuat script yang diinginkan untuk mejalankan request menuju server.
// 3. Menggunakan Axios untuk melakukan permintaan HTTP ke server.
// 4. Jika program ETA-CATRIDGE dibuka maka halaman utama akan langsung menuju login form admin user diminta untuk memasukan link ini http://127.0.0.1:5501/frontend untuk memasuki halaman interface user untuk memesan catridge

//===========================================
//==         Struktur Folder dan File       ==
//===========================================
// - download.png  : Resource png
// - index.hmtl    : Index utama pada program ETA-CATRIDGE berisi form login admin 
//-  script.js     : Berisi script untuk menjalankan form login admin dengan function login

//===========================================
//==         Dependensi Eksternal           ==
//===========================================
// - Bootstrap 5 : https://getbootstrap.com/
// - Axios       : https://github.com/axios/axios
// - jQuery      : https://jquery.com/
// - Sweet Alert : https://unpkg.com/sweetalert/dist/sweetalert.min.js


// Function untuk melakukan login
function login() {
  // Mengambil data dari form login
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;

  // Membuat data untuk dikirim ke database
  let data = {
    username: username,
    password: password,
  };

  // Melakukan pengiriman data ke database
  axios
    .post("http://127.0.0.1:8000/api/login", data)
    .then(function (response) {
      // Membuat variabel agar mudah di cek
      let login = response.data;

      // Melakukan pengecekan apakah data sesuai dengan database
      if (login === "bener") {
        // Jika data sesuai akan langsung membuat localStorage dan pindah ke halaman backend
        localStorage.setItem("isLoggedIn", "true");
        window.location.href = "http://127.0.0.1:5501/backend/";
      } else {
        // Jika data tidak sesuai akan muncul alert dan mulai mengisi form ulang
        swal("Username / Password Salah !", " ", "error").then(document.getElementById("username").value = "", document.getElementById("password").value = "")
      }
    })
    .catch(function (response) {
      // Jika form hanya di isi satu pertanyaan saja langsung muncul error 
      let message = response.response.data.message;
      let out = `<div class="alert alert-danger" role="alert">${message}</div>`;
      document.querySelector(".err").innerHTML = out;
    });
}
