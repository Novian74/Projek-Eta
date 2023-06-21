// Template icon edit
let btnEdit = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg>`;

// Template icon hapus
let btnHapus = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/></svg>`;

// Template icon tambah
let btnTambah = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg>`;

// Template icon dokumen
let btnReport = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16"><path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/></svg>`;

// Template icon download
let btnDownload = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16"><path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/><path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/></svg>`

// Function untuk sign out
function logout() {
  // Menghapus local storage
  localStorage.removeItem("isLoggedIn");

  // Kembali ke halaman login 
  window.location.href = "http://127.0.0.1:5501/index.html";
}

// Function untuk menampilkan data catridge
function tinta() {
  // Mengambil data catridge dari database
  axios.get("http://127.0.0.1:8000/api/tintas").then(function (response) {
    // Membuat variabel agar dipermudah
    let tinta = response.data;

    // Menyiapkan tabel
    let out =
      "<table class='table'><thead><tr><th scope='col'>No</th><th scope='col'>Nama Catridge</th><th scope='col'>Warna</th><th scope='col'>Minimum Stok</th><th scope='col'>Stok</th><th></th></tr></thead><tbody>";

    // Memecah array dengan foreach
    tinta.forEach((el, index) => {
      // Variabel untuk membuat nomor mulai dari 1 sampai data terakhir
      let number = index + 1;

      // Menyiapkan isi tabel
      out += `<tr>
                <td>${number}</td>
                <td>${el.catridge_name}</td>
                <td>${el.warna}</td>
                <td>${el.qty}</td>
                <td>${el.stok}</td>
                <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal4" onclick="tampilTinta('${el.idcatridge}')">${btnEdit}</button><button type="button" class="btn btn-danger ms-3" onclick="hapusTinta('${el.idcatridge}')">${btnHapus}</button></td>
              </tr>`;
    });

    // Menutup tabel
    out += "</tbody></table>";

    // DOM untuk menampilkan tabel
    document.querySelector(".cont").innerHTML = out;
  });

  // DOM untuk menampilkan tombol tambah data
  document.querySelector(".btn").innerHTML =
    '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3">Tambah Model Tinta</button>';
}

//Function untuk menambahkan tinta
function tambahTinta() {
  // Mengambil id catridge dari database
  axios.get("http://127.0.0.1:8000/api/tintas").then(function (response) {
    // Menambah id catridge yang baru dengan format CT XXX 
    let idcat = response.data;
    var idCate = idcat[idcat.length - 1];
    var stringNomor = idCate.idcatridge;
    var nomor = parseInt(stringNomor.match(/\d+/)[0]);
    nomor += 1;
    var nomorBaru = "CT " + nomor.toString().padStart(3, "0");

    // Membuat variabel berisi data data catridge yang ingin ditambahkan
    let data = {
      idcatridge: nomorBaru,
      catridge_name: document.getElementById("tTinta").value,
      warna: document.getElementById("tWarnaI").value,
      qty: document.getElementById("tMinQ").value,
      stok: document.getElementById("tStok").value
    }

    // Mengirim data catridge ke database
    axios.post("http://127.0.0.1:8000/api/tintas", data);

    // Mengembalikan form tambah data ke semula
    document.getElementById("tTinta").value = "";
    document.getElementById("tWarnaI").value = "pilih";
    document.getElementById("tMinQ").value = "";
    document.getElementById("tStok").value = "";

    // Pemberitahuan tinta sudah ditambah
    alert("Tinta Sudah Ditambah");

    // Memanggil function tinta untuk menampilkan semua data catridge
    tinta();
  })
}

// Function untuk menampilkan data catridge untuk diubah
function tampilTinta(idCat) {
  // Mengambil data catridge sesuai id catridge yang ingin diubah
  axios.get("http://127.0.0.1:8000/api/tintas/" + idCat).then(function (response) {
    let tampil = response.data

    // Memecah data array
    tampil.forEach(el => {
      // Menampilkan data catridge ke form edit
      document.getElementById("idTinta").value = el.idcatridge;
      document.getElementById("tinta").value = el.catridge_name;
      document.getElementById("stok").value = el.stok;
    });
  })
}

// Function untuk mengubah data catridge
function ubahTinta() {
  // Mengambil id catridge pada form edit
  let idTinta = document.getElementById("idTinta").value;

  // Membuat variabel berisi data data catridge yang ingin diubah
  let data = {
    idcatridge: idTinta,
    catridge_name: document.getElementById("tinta").value,
    stok: document.getElementById("stok").value,
  };

  // Mengubah data tersebut ke database
  axios.put("http://127.0.0.1:8000/api/tintas/" + idTinta, data);

  // Pemberitahuan catridge berhasil diubah
  alert("Tinta Berhasil Diubah");

  // Menjalankan function tinta untuk tampil semua data catridge 
  tinta();
}

// Function untuk menghapus catridge
function hapusTinta(id) {
  // Menghapus data catridge di database sesuai id catridge yang dihapus
  axios.delete("http://127.0.0.1:8000/api/tintas/" + id);

  // Pemberitahuan catridge berhasil dihapus
  alert("Berhasil Menghapus Tinta");

  // Menjalankan function tinta untuk tampil semua data catridge
  tinta();
}

// Function untuk menampilkan printer
function printer() {
  // Mengambil data printer dari database
  axios.get("http://127.0.0.1:8000/api/printer").then(function (response) {
    let printer = response.data;
    let warna;

    // Membuat tabel
    let out =
      "<table class='table'><thead><tr><th scope='col'>No</th><th scope='col'>Nama Printer</th><th scope='col'>Model Tinta</th><th scope='col'></th></tr></thead><tbody>";

    // Memecah data array menggunakan foreach
    printer.forEach((el, index) => {
      // Jika angka 1 printer hanya bisa memakai catridge hitam
      // Jika angka 2 printer bisa memakai semua warna catridge
      // Melakukan pernyataan bersyarat
      switch (el.model_tinta) {
        case 1:
          warna = "Black"
          break;
        case 2:
          warna = "Black & Color"
          break;
      }

      // Membuat variabel agar nomor urut sesuai data 
      let number = index + 1;

      // Membuat isian tabel
      out += `<tr>
                <td>${number}</td>
                <td>${el.printer_name}</td>
                <td>${warna}</td>
                <td><button type="button" class="btn btn-danger"onclick="hapusPrinter('${el.idprint}')">${btnHapus}</button></td>
            </tr>`;
    });

    // Menutup tabel
    out += "</tbody></table>";

    // DOM untuk menampilkan tabel
    document.querySelector(".cont").innerHTML = out;

    // Membuat variabel berisikan tombol tambah printer
    let btn =
      '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Printer</button>';

    // DOM untuk menampilkan tombol tambah printer
    document.querySelector(".btn").innerHTML = btn;
  })
}

// Function untuk menambah printer
function tambahPrinter() {
  // Mengambil id printer dari database
  axios.get("http://127.0.0.1:8000/api/printer").then(function (response) {
    // Menambah id printer yang baru dengan format PR XXX 
    let idPt = response.data;
    var idPrinter = idPt[idPt.length - 1];
    var stringNomor = idPrinter.idprint;
    var nomor = parseInt(stringNomor.match(/\d+/)[0]);
    nomor += 1;
    var nomorBaru = "PR " + nomor.toString().padStart(3, "0");

    // Membuat variabel berisi data data printer
    let dataP = {
      idprint: nomorBaru,
      printer_name: document.getElementById('nama').value,
      model_tinta: document.getElementById("model").value
    }

    // Mengirim data printer ke database, lalu ada pemberitahuan printer berhasil ditambah, dan muncul semua data printer
    axios.post("http://127.0.0.1:8000/api/printer", dataP).then(alert("Printer Berhasil Ditambahkan !"), printer());
  })
}

// Function untuk mengapus printer sesuai id yang ingin dihapus
function hapusPrinter(id) {
  // Mengapus data printer di database, lalu ada pemberitahuan printer berhasil dihapus, dan muncul semua data printer
  axios.delete("http://127.0.0.1:8000/api/printer/" + id).then(alert("Printer Berhasil Dihapus !"), printer());
}

// Function untuk menampilkan data printer dan catridge yang sudah direlasikan
function printCat() {
  // Mengambil data printer + catridge di database
  axios.get("http://127.0.0.1:8000/api/printcat").then(function (response) {
    let printCat = response.data;

    // Membuat tabel
    let out =
      "<table class='table'><thead><tr><th scope='col'>No</th><th scope='col'>Printer</th><th scope='col'>Catridge</th><th scope='col'>Hapus</th></tr></thead><tbody>";
    // Memecah array dengan foreach
    printCat.forEach((el, index) => {
      // Membuat variabel berisi nomor yang urut
      let number = index + 1;

      // Membuat isi tabel 
      out += `<tr>
                <td>${number}</td>
                <td>${el.printer_name}</td>
                <td>${el.catridge_name}</td>
                <td><button type="button" class="btn btn-danger" onclick="hapusPrintCat('${el.PrCt}')">${btnHapus}</button></td>
            </tr>`;
    });

    // Menutup tabel
    out += "</tbody></table>";

    // DOM untuk menampilkan tabel
    document.querySelector(".cont").innerHTML = out;

    // Membuat variabel berisi tombol tambah data
    let btn =
      '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick="tampilCat()">Tambah Printer</button>';

    // DOM untuk menampilkan tombol tambah data
    document.querySelector(".btn").innerHTML = btn;
  });
}

// Function untuk menampilkan pilihan printer dan catridge
function tampilCat() {
  // Mengambil elemen select printer
  const selectPrint = document.getElementById("selPrint");

  // Mengambil data printer dari database
  axios.get("http://127.0.0.1:8000/api/printer").then(function (response) {
    let print = response.data;

    // Memecah data array menggunakan foreach
    print.forEach(el => {
      // Membuat elemen baru pilihan
      const option = document.createElement("option");

      // Mengisi value select dengan id printer
      option.value = el.idprint;

      // Mengisi isi tulisan dengan nama printer
      option.textContent = el.printer_name;

      // Menampilkan elemennya
      selectPrint.appendChild(option);
    });
  })

  // Mengambil elemen select catridge
  const selectCat = document.getElementById("selCat");

  // Mengambil data catridge dari database
  axios.get("http://127.0.0.1:8000/api/tintas").then(function (response) {
    let cat = response.data;

    // Memecah data array menggunakan foreach
    cat.forEach(el => {
      // Membuat elemen baru pilihan
      const option = document.createElement("option");

      // Mengisi value select dengan id catridge
      option.value = el.idcatridge;

      // Mengisi isi tulisan dengan nama catridge
      option.textContent = el.catridge_name;

      // Menampilkan elemennya
      selectCat.appendChild(option);
    });
  })
}

// Function untuk menambah relasi antara printer dan catridge
function tambahPrintCat() {
  // Mengambil pilihan printer dan catridge
  let selCat = document.getElementById("selCat").value;
  let selPrint = document.getElementById("selPrint").value;

  // Membuat variabel berisi pilihan yang dipilih
  let dataPrintCat = {
    idprint: selPrint,
    idcatridge: selCat
  }

  // Mengirim data relasi ke database
  axios.post("http://127.0.0.1:8000/api/printcat", dataPrintCat)

  // Pemberitahuan berhasil ditambahkan
  alert("Printer + Catridge Berhasil Ditambahkan !")

  // Mengembalikan form seperti semula
  document.getElementById("selCat").innerHTML = "";
  document.getElementById("selPrint").innerHTML = "";

  // Merefresh halaman agar tidak ada data yang tertumpuk
  window.location.reload()
}

// Function untuk menghapus relasi antara printer dan catridge
function hapusPrintCat(idPrCt) {
  // Mengapus relasi sesuai id nya, lalu muncul pemberitahuan berhasil, dan menampilkan semua data relasi
  axios.delete("http://127.0.0.1:8000/api/printcat/" + idPrCt).then(alert("Printer + Catridge Berhasil Dihapus !"), printCat());
}

// Function untuk menampilkan data pelanggan
function pelanggan() {
  // Mengambil data pelanggan dari database
  axios
    .get("http://127.0.0.1:8000/api/pelanggan")
    .then(function (response) {
      // Membuat tabel
      let out =
        "<table class='table'><thead><tr><th scope='col'>No</th><th scope='col'>Nama</th><th scope='col'>Gedung</th><th scope='col'>Area</th><th scope='col'>Departemen</th></tr></thead><tbody>";

      // Memecah data array menggunakan foreach
      let pelanggan = response.data;
      pelanggan.forEach((el, index) => {
        // Membuat variabel berisi nomor urut
        let number = index + 1;

        // Membuat isi tabel
        out += `<tr>
                  <td>${number}</td>
                  <td>${el.nama}</td>
                  <td>${el.gedung}</td>
                  <td>${el.area}</td>
                  <td>${el.departemen}</td>
                </tr>`;
      });

      // Menutup tabel
      out += "</tbody></table>";

      // DOM untuk menampilkan tabel
      document.querySelector(".cont").innerHTML = out;
    });
}

// Function untuk menampilkan pesanan 
function booking() {
  // Menggambil data pesanan dari database
  axios.get("http://127.0.0.1:8000/api/booking/pending").then(function (response) {
    let booki = response.data;

    // Membuat tabel
    let out =
      "<table class='table'><thead><tr><th scope='col'>Nomor Nota</th><th scope='col'>Nama Pelanggan</th><th scope='col'>Nama Printer</th><th scope='col'>Nama Catridge</th><th scope='col'>Warna Catridge</th><th scope='col'>Tanggal Pesan</th><th scope='col'></th></tr></thead><tbody>";

    // Memecah data array dengan foreach
    booki.forEach((el) => {
      // Membuat variabel berisi tanggal pemesanan
      var tanggal = new Date(el.created_at);

      // Membuat isi tabel
      out += `<tr>
                  <td>${el.nomornota}</td>
                  <td>${el.nama}</td>
                  <td>${el.printer_name}</td>
                  <td>${el.catridge_name}</td>
                  <td>${el.warna}</td>
                  <td>${tanggal.toLocaleDateString("id-ID")}</td>
                  <td><button type="button" class="btn btn-warning" onclick="pending('${el.nomornota}','${el.idcatridge}')">Pending</button></td>
                </tr>`;
    }
    );

    // Menutup tabel
    out += "</tbody></table>";

    // DOM untuk menampilkan tabel
    document.querySelector(".cont").innerHTML = out;
  });
}

// Function untuk merubah pesanan pending menjadi pickup
function pending(nota, id) {
  // Menggambil data catridge sesuai id
  axios.get("http://127.0.0.1:8000/api/tintas/" + id).then(function (response) {

    // Mengurangi stok catridge
    var stok = response.data;
    stok.forEach(el => {
      var dataS = {
        stok: el.stok - 1
      };

      // Mengirim pengurangan stok ke database
      axios.put("http://127.0.0.1:8000/api/tintas/stok/" + id, dataS)

      // Membuat batas waktu pesanan
      var hangus = new Date();
      hangus.setDate(hangus.getDate() + 1);

      // Membuat variabel berisi status dan batas waktu pesanan
      let data = {
        status: "2",
        batasW: hangus
      }

      // Mengirim data pesanan ke database sesuai nomor nota
      axios.put("http://127.0.0.1:8000/api/booking/" + nota, data);

      // Pemberitahuan pesanan sudah siap diambil
      alert("Barang Ready !")

      // Menampilkan semua data booking
      booking();
    });
  })
}

// Function untuk menampilkan pesanan dengan status pickup
function pickup() {
  // Menggambil data pesanan status pickup
  axios.get("http://127.0.0.1:8000/api/booking/pickup").then(function (response) {
    let pick = response.data;

    // Membuat tabel
    let out =
      "<table class='table'><thead><tr><th scope='col'>Nomor Nota</th><th scope='col'>Nama Pelanggan</th><th scope='col'>Nama Printer</th><th scope='col'>Nama Catridge</th><th scope='col'>Warna Catridge</th><th scope='col'>Tanggal Pesan</th><th scope='col'></th></tr></thead><tbody>";

    // Memecah data array menggunakan foreach
    pick.forEach((el) => {
      // Membuat variabel berisi tanggal pemesanan
      var tanggal = new Date(el.created_at);

      // Membuat isi tabel
      out += `<tr>
                  <td>${el.nomornota}</td>
                  <td>${el.nama}</td>
                  <td>${el.printer_name}</td>
                  <td>${el.catridge_name}</td>
                  <td>${el.warna}</td>
                  <td>${tanggal.toLocaleDateString("id-ID")}</td>
                  <td><button type="button" class="btn btn-success" onclick="statusR('${el.nomornota}')">READY</button></td>
                </tr>`;
    });

    // Menutup tabel 
    out += "</tbody></table>";

    // DOM untuk menampilkan tabel
    document.querySelector(".cont").innerHTML = out;
  });
}

// Function untuk mengubah status pickup menjadi selesai 
function statusR(id) {
  // Membuat variabel berisi status dan batas waktu
  var data = {
    status: "3",
    batasW: "not"
  };

  // Mengirim ke database sesuai nomor nota
  axios.put("http://127.0.0.1:8000/api/booking/" + id, data)

  // Pemberitahuan barang sudah diambil
  alert("Sudah Diambill !")

  // Menampilkan semua data pesanan berstatus pickup
  pickup();
}

// Function untuk melihat pesanan yang sudah selesai
function history() {
  // Menggambil data pesanan yang sudah selesai di database
  axios.get("http://127.0.0.1:8000/api/booking/history").then(function (response) {
    var history = response.data;

    // Menggambil semua elemen yang diperlukan
    var dropdown1 = document.getElementById('nama');
    var dropdown2 = document.getElementById('departemen');
    var dropdown3 = document.getElementById('printer');
    var searchInput = document.getElementById('searchInput');
    var container = document.querySelector('.cont');

    // Memberikan function ketika terjadi event
    dropdown1.addEventListener('change', applyFilters);
    dropdown2.addEventListener('change', applyFilters);
    dropdown3.addEventListener('change', applyFilters);
    searchInput.addEventListener('input', applyFilters);

    // Menampilkan default tabel
    renderTable(history, container);

    // Membuat filter dari input
    function applyFilters() {
      var selectedValue1 = dropdown1.value.toLowerCase();
      var selectedValue2 = dropdown2.value.toLowerCase();
      var selectedValue3 = dropdown3.value.toLowerCase();
      var searchTerm = searchInput.value.toLowerCase();

      // Membuat variabel yang berisikan data yang sudah difilter
      var filteredData = history.filter(function (el) {
        return (
          (selectedValue1 === '' || selectedValue1 === el.nama.toLowerCase()) &&
          (selectedValue2 === '' || selectedValue2 === el.departemen.toLowerCase()) &&
          (selectedValue3 === '' || selectedValue3 === el.printer_name.toLowerCase()) &&
          (searchTerm === '' || Object.values(el).some(value => String(value).toLowerCase().includes(searchTerm)))
        );
      });

      // Menampilkan tabel yang sudah difilter
      renderTable(filteredData, container);
    }
  });

  // Function untuk menampilkan tabel
  function renderTable(data, container) {
    // Membuat tabel
    var tableHTML = "<table class='table'><thead><tr><th scope='col'>Nomor Nota</th><th scope='col'>Nama Pelanggan</th><th scope='col'>Departemen</th><th scope='col'>Nama Printer</th><th scope='col'>Cartridge</th><th scope='col'>Warna Cartridge</th><th scope='col'>Tanggal Pesan</th><th scope='col'>Tanggal Ambil</th></tr></thead><tbody>";

    // Memecah 
    data.forEach(function (el) {
      // Membuat variabel berisi tanggal pemesanan dan pengambilan
      var tanggal = new Date(el.created_at);
      var tanggalA = new Date(el.updated_at);

      // Membuat isi tabel
      tableHTML += `<tr>
                        <td>${el.nomornota}</td>
                        <td>${el.nama}</td>
                        <td>${el.departemen}</td>
                        <td>${el.printer_name}</td>
                        <td>${el.catridge_name}</td>
                        <td>${el.warna}</td>
                        <td>${tanggal.toLocaleDateString("id-ID")}</td>
                        <td>${tanggalA.toLocaleDateString("id-ID")}</td>
                      </tr>`;
    });

    // Menutup tabel
    tableHTML += "</tbody></table>";

    // DOM untuk menampilkan tabel
    container.innerHTML = tableHTML;
  }
  // DOM untuk menampilkan input pencarian
  document.querySelector(".btn").innerHTML = `<div class="col"><input type="text" id="searchInput" placeholder="Cari..." class="form-control"></div><div class="col"><select id="nama" class="form-select"><option value="">Nama</option></select></div><div class="col"><select id="departemen" class="form-select"><option value="">Departemen</option></select></div><div class="col"><select id="printer" class="form-select"><option value="">Printer</option></select></div><div class="col"><button class="btn btn-success" onclick="goToReport()">${btnReport}</button></div>`;

  // Menggambil data printer dari database
  axios.get("http://127.0.0.1:8000/api/printer").then(function (response) {
    let test = response.data

    // Mengambil elemen select printer
    const selectCa = document.getElementById("printer");

    // Memecah data array menggunakan foreach
    test.forEach((el) => {
      // Membuat elemen opsi
      const option = document.createElement("option");

      // Mengisi opsi value dengan nama printer
      option.value = el.printer_name;

      // Mengisi tampilan opsi dengan nama printer
      option.textContent = el.printer_name;

      // Menampilkan elemen opsi
      selectCa.appendChild(option);
    });
  })

  // Menggambil data pesanan
  axios
    .get("http://127.0.0.1:8000/api/booking/history")
    .then(function (response) {
      // Menggambil elemen select nama
      const selectCat = document.getElementById("nama");
      let test = response.data;

      // Memecah data array dengan foreach
      test.forEach((el) => {
        // Membuat opsi baru
        const option = document.createElement("option");

        // Mengisi opsi value dengan nama
        option.value = el.nama;

        // Mengisi tampilan opsi dengan nama
        option.textContent = el.nama;

        // Menampilkan elemen opsi
        selectCat.appendChild(option);
      });

      // Menggambil elemen select departemen
      const selectC = document.getElementById("departemen");

      // Memecah data array menggunakan foreach
      test.forEach((el) => {
        // Membuat opsi baru
        const option = document.createElement("option");

        // Mengisi opsi value dengan departemen
        option.value = el.departemen;

        // Mengisi tampilan opsi dengan departemen
        option.textContent = el.departemen;

        // Menampilkan elemen opsi
        selectC.appendChild(option);
      });
    });
}

// Function untuk menampilkan halaman setting
function setting() {
  // Mengambil data histori pengiriman email dari database
  axios.get("http://127.0.0.1:8000/api/historiemail").then(function (response) {
    // Membuat variabel berisi input tanggal pengiriman
    let out = `<div class="row">
    <h2>Admin Settings</h2>
  </div>
  <div class="row">
    <div class="col-5">
      <h5 class="mt-2">Tanggal Pengiriman Laporan Bulanan</h5>
      <p>Tanggal yang dipilih akan mengirim pada bulan selanjutnya</p>
    </div>
    <div class="col-2">
      <input
        type="number"
        name="tgl_kirim"
        id="tgl_kirim"
        class="form-control"
      />
    </div>
    <div class="col-2">
      <button class="btn btn-primary" onclick="tgl_kirim()">
        Kirim
      </button>
    </div>
  </div>`;

    // Membuat tabel
    out += `<div class="row mt-2"><h3>Histori Pengiriman Email</h3><table class="table text-black"><thead><tr><th>Nomor</th><th>Tanggal Pengiriman</th><th>Dokumen</th></tr></thead><tbody>`
    let histori = response.data;

    // Memecah data array menggunakan foreach
    histori.forEach((el, index) => {
      // Membuat variabel berisi nomor urut
      let number = index + 1;

      // Membuat isi tabel
      out += `<tr>
              <td>${number}</td>
              <td>${el.tgl_kirim}</td>
              <td><a href="http://localhost:8080/kirim-email/download.php?id=${el.id}">Dokumen Email ${el.tgl_kirim}</a></td>
        </tr>`
    });

    // Menutup tabel
    out += `</tbody></table></div>`;

    // DOM untuk menampilkan halaman setting
    document.querySelector(".cont").innerHTML = out;
  })
}

// Function untuk mengubah tanggal kirim email
function tgl_kirim() {
  // Mengambil tanggal dari input dan menambahkan 1 bulan kedepan
  var tanggalSaatIni = new Date();
  var tanggalInput = document.getElementById("tgl_kirim").value;
  tanggalSaatIni.setMonth(tanggalSaatIni.getMonth() + 1);
  tanggalSaatIni.setDate(tanggalInput);
  var bulan = String(tanggalSaatIni.getMonth() + 1).padStart(2, "0");
  var tanggal = String(tanggalSaatIni.getDate()).padStart(2, "0");
  var tahun = tanggalSaatIni.getFullYear();
  var tanggalFormatted = tanggal + "-" + bulan + "-" + tahun;

  // Membuat variabel berisikan data pengiriman email
  let data = {
    tgl_kirim_email: tanggalFormatted,
    waktu_kirim_email: "08:00",
  }

  // Mengirim data ke database
  axios.put("http://127.0.0.1:8000/api/admin/1", data)

  // Pemberitahuan berhasil mengubah
  alert("Berhasil Mengubah")

  // Menampilkan halaman setting
  setting();
}

// Function untuk memindah page ke report
function goToReport() {
  // Memindah page sesuai link report
  window.location.href = "http://127.0.0.1:5501/backend/report.html"
}

// Function untuk menampilkan halaman report
function report() {
  // Mengambil input tanggal awal dan akhir
  let tanggalAwal = document.getElementById("tAwal").value;
  let tanggalAkhir = document.getElementById("tAkhir").value;

  // Menampilkan tanggal yang dicari
  document.getElementById("tgl").innerHTML = `<h4>${tanggalAwal} - ${tanggalAkhir}</h4>`;

  // Menampilkan judul ke title halaman
  document.title = `Report Bulanan  ${tanggalAwal} - ${tanggalAkhir}`;

  // Menggambil data pesanan sesuai tanggal yang dinginkan di database
  axios.get("http://127.0.0.1:8000/api/booking/report/" + tanggalAwal + "/" + tanggalAkhir).then(function (response) {
    let rep = response.data

    // Membuat tabel
    let out = `<table class="table table-bordered mt-4" id="demo"><thead><tr><th scope="col">Tanggal Pesan</th><th scope="col">Tanggal Ambil</th><th scope="col">Nomor Nota</th><th scope="col">Nama</th><th scope="col">Departemen</th><th scope="col">Printer</th><th scope="col">Catridge</th><th scope="col">Warna</th></tr></thead><tbody>`;

    // Memecah data array menggunakan foreach
    rep.forEach(el => {
      // Membuat variabel berisi tanggal pesan dan tanggal ambil
      var tanggal = new Date(el.created_at);
      var tanggalA = new Date(el.updated_at);

      // Membuat isi tabel
      out += `<tr>
                <td>${tanggal.toLocaleDateString("id-ID")}</td>
                <td>${tanggalA.toLocaleDateString("id-ID")}</td>
                <td>${el.nomornota}</td>
                <td>${el.nama}</td>
                <td>${el.departemen}</td>
                <td>${el.printer_name}</td>
                <td>${el.catridge_name}</td>
                <td>${el.warna}</td>
              </tr>`
    });

    // Menutup tabel
    out += `</tbody></table>`;

    // DOM untuk menampilkan tabel
    document.querySelector(".content").innerHTML = out;
  })
}
