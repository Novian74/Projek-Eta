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
        alert("Username / Password Salah");
        location.reload();
      }
    })
    .catch(function (response) {
      // Jika form hanya di isi satu pertanyaan saja langsung muncul error 
      let message = response.response.data.message;
      let out = `<div class="alert alert-danger" role="alert">${message}</div>`;
      document.querySelector(".err").innerHTML = out;
    });
}
