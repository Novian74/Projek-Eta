// Template icon copy
let btnCopy = `<button type="button" class="btn btn-secondary" onclick="copyText()"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clipboard2" viewBox="0 0 16 16"><path d="M3.5 2a.5.5 0 0 0-.5.5v12a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-12a.5.5 0 0 0-.5-.5H12a.5.5 0 0 1 0-1h.5A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1H4a.5.5 0 0 1 0 1h-.5Z"/><path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/></svg></button>`;

// Function untuk menampilkan pilihan printer
function tampil() {
  // Mengambil elemen select
  const selectPrinter = document.getElementById("printer");

  // Mengambil data dari database menggunakan axios
  axios.get("http://127.0.0.1:8000/api/printer").then(function (response) {
    // Membuat variabel agar mudah digunakan
    let printer = response.data;

    // Melakukan foreach memecah data yang dikirimkan berbentuk array
    printer.forEach((el) => {
      // Menmbuat elemen option baru
      const option = document.createElement("option");

      // Mengisi value select dengan angka 1 (hitam & warna) dan angka 2 (hitam saja)
      option.value = el.model_tinta;

      // Mengisi isi konten dengan nama printer
      option.textContent = el.printer_name;

      // Menampilkan option baru ke user
      selectPrinter.appendChild(option);
    });
  });
}

// Function untuk mengirim notifikasi ke telegram melalui bot
function kirimPesanAdmin(pesan) {
  // Membuat variabel isi pesan notifikasi agar mudah digunakan
  var my_text = pesan

  // Membuat variabel berisi token bot telegram
  var token = "6007053333:AAHN_tUHbVie6AR2P6wrXChGae-JeOcRiLY"

  // Membuat variabel berisi chat id telegram tujuan
  var chat_id = "6127290706"

  // Membuat variabel berisi link mengirim notifikasi
  var url = `https://api.telegram.org/bot${token}/sendMessage?chat_id=${chat_id}&text=${my_text}`;

  // Membuat variabel berisi url bublle untuk mengarah ke halaman backend
  var urlBublle = "http://127.0.0.1:5501/backend/";

  // Membuat variabel berisi menambahkan fitur di telegram seperti bubble chat
  var keyboard = {
    inline_keyboard: [
      [
        { text: 'Cek Pesanan', url: `${urlBublle}` }
      ]
    ]
  };

  // Mengubah variabel javascript menjadi data JSON 
  var keyboardJSON = JSON.stringify(keyboard);

  // Mengirim fitur bubble chat ke telegram
  url += `&reply_markup=${keyboardJSON}`;

  // Membuat variabel untuk fungsi pengiriman API
  let api = new XMLHttpRequest();

  // Konfigurasi pengiriman API
  api.open("GET", url, true);

  // API terkirim
  api.send();
}

// Function untuk membuat pesanan
function booking() {
  // Mengambil data pelanggan
  axios.get("http://127.0.0.1:8000/api/pelanggan").then(function (response) {

    // Membuat variabel berisi array id pelanggan 
    let idpelanggan = response.data;

    // Membuat variabel untuk mengakses elemen terakhir array.
    var idplgn = idpelanggan[idpelanggan.length - 1];

    // Membuat variabel yang berisikan string dari variabel idplgn
    var stringNomor = idplgn.iduser;

    // Membuat variabel untuk mengambil hasil pertama yang cocok dan mengubahnya menjadi bilangan integer
    var nomor = parseInt(stringNomor.match(/\d+/)[0]);

    // Menambahkan 1 angka ke variabel nomor
    nomor += 1;

    // Membuat variabel berisi konversi semua variabel menjadi format "USER XXX"
    var nomorBaru = "USER " + nomor.toString().padStart(3, "0");

    // Membuat variabel berisi data data pelanggan
    var dataPelanggan = {
      iduser: nomorBaru,
      nama: document.getElementById("nama").value,
      gedung: document.getElementById("gedung").value,
      area: document.getElementById("area").value,
      departemen: document.getElementById("departemen").value,
    };

    // Mengirim data pelanggan ke database
    axios.post("http://127.0.0.1:8000/api/pelanggan", dataPelanggan);

    // Mengambil elemen select printer
    var selectElement = document.getElementById("printer");

    // Mengambil elemen index
    var selectedIndex = selectElement.selectedIndex;

    // Mengambil elemen yang sudah dipilih
    var selectedOption = selectElement.options[selectedIndex];

    // Membuat variabel berisi text yang sudah dipilih 
    var printer = selectedOption.text;

    // Membuat variabel agar mudah digunakan
    var searchPrintCat = {
      printer_name: printer,
      warna: document.getElementById("warna").value
    }

    // Membuat public variabel agar mudah
    var dataBooking;
    var noNota

    // Mengambil data dari database sesuai nama printer dan warna catridge
    axios.get("http://127.0.0.1:8000/api/printcat/" + searchPrintCat.printer_name + "/" + searchPrintCat.warna).then(function (response) {
      // Membuat variabel agar mudah
      let cek = response.data

      // Membuat variabel berisi angka random untuk nomor nota
      let no = Math.floor(100000 + Math.random() * 900000);

      // Melakukan foreach memecah data yang dikirimkan berbentuk array
      cek.forEach(el => {
        // Membuat variabel berisi data untuk pemesanan
        dataBooking = {
          nomornota: no,
          iduser: dataPelanggan.iduser,
          idprint: el.idprint,
          idcatridge: el.idcatridge,
          status: "1",
          batasW: "24 Jam"
        };
        noNota = dataBooking.nomornota;
      });

      // Mengirim data pesanan ke database
      axios.post("http://127.0.0.1:8000/api/booking", dataBooking).then(function () {
        // Muncul alert tanda pesanan sudah berhasil
        alert("Berhasil Pesan");

        // Membuat variabel untuk menampilkan data pesanan
        let nota = `<div>
        <h2>Pembelian Berhasil !</h2>
        <div class="row g-1 mt-4">
        <div class="col"><h5>NO NOTA : <input type="text" style="background: none; color: white; width: 75px;" id="textToCopy" value="${noNota}" readonly> ${btnCopy}</h2> <h4 class="text-danger">Simpan Nomor Nota Untuk Cek Status!</h4></div>
        <div class="col"><h5>Printer : ${searchPrintCat.printer_name}</h5><p class="bTinta">Tinta : ${searchPrintCat.warna}</p></div>
        </div>
        </div>
        
        <footer class="mt-auto text-white-50"><h3><a href="http://127.0.0.1:5501/frontend/">Memesan Lagi</a> </h3></footer>
        </div>`;

        // DOM untuk menampilkan data pesanan
        document.querySelector(".lacak").innerHTML = nota;

        // Membuat pesan untuk telegram
        const pesan = 'Ada Pesanan Catridge !';

        // Menjalankan fungsi notifikasi telegram
        kirimPesanAdmin(pesan);

      }).catch(function (err) {
        // Jika pesanan gagal terbuat muncul error
        console.log("error");
      })
    })
  })
}

// Function untuk menyalin nomor nota
function copyText() {
  // Mengambil elemen berisi nomor nota
  var text = document.getElementById("textToCopy");

  // Memilih semua nomor nota
  text.select();

  // Menyalin nomor nota nya
  document.execCommand("copy");
}

// Function untuk melacak pesanan
function lacak() {
  // Mengambil isi input nomor nota
  let nomorNota = document.getElementById("tLacak").value;

  // Mengambil data sesuai dari nomor nota yang diinputkan
  axios
    .get("http://127.0.0.1:8000/api/booking/lacak/" + nomorNota)
    .then(function (response) {
      // Membuat variabel agar mudah
      let lacak = response.data

      // Melakukan foreach memecah data yang dikirimkan berbentuk array
      lacak.forEach(el => {
        // Mengambil data batas waktu pesanan
        var batas = new Date(el.batasW)
        let waktu;
        let warna;

        // Jika status 1 pesanan pending
        // Jika status 2 pesanan siap di ambil
        // Jika status 3 pesanan sudah selesai
        // Melakukan pernyataan bersyarat
        switch (el.status) {
          case "1":
            warna = "<p class='text-warning'>PENDING</p>";
            waktu = "-"
            break;
          case "2":
            warna = "<p class='text-success'>READY TO PICKUP</p>";
            waktu = batas.toLocaleString("id-ID");
            break;
          case "3":
            warna = "<p class='text-white'>FINISH</p>";
            waktu = "-"
            break;
        }

        // Menampilkan layout tabel 
        let out = `<table class="table text-white mt-2"><thead><tr><th scope="col">Nomor Nota</th><th scope="col">Nama</th><th scope="col">Warna</th><th scope="col">Printer</th><th scope="col">Status</th><th scope="col">Batas Waktu</th></tr></thead><tbody>`;

        // Mengisi tabel dengan data pesanan
        out += `<tr>
                <th>${el.nomornota}</th>
                <td>${el.nama}</td>
                <td>${el.warna}</td>
                <td>${el.printer_name}</td>
                <td>${warna}</td>
                <td>${waktu}</td>
              </tr>`;

        // Menutup tabel
        out += "</tbody></table>";

        // DOM untuk menampilkan tabe;
        document.getElementById("tampilLacak").innerHTML = out;
      });
    }).catch(function (error) {
      // Jika pesanan tidak ditemukan muncul pemberitahuan
      let err = "<h1 class='mt-2'>Pesanan Tidak Ada / Pesanan Hangus</h1>";
      document.getElementById("tampilLacak").innerHTML = err;
    });
}
