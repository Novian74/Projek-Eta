<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pesan Tinta</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <style>
        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            color: lightblue;
        }
    </style>
</head>

<body class="d-flex h-100 text-center text-bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">E-T-A INDONESIA</h3>
                <h4 class="float-md-end mb-0">
                    <a href="{{ route('lacak.home') }}">Cari Pesanan Anda</a>
                </h4>
            </div>
        </header>

        <div class="p-3">
            <h1>Memesan Tinta</h1>
            <form action="{{ route('pesan.cek') }}" method="POST">
                @csrf
                <div class="row mt-3 justify-content-center">
                    <div class="col-6">
                        <h3 for="" class="form-label">Printer :</h3>
                        <select name="printer" id="printer" class="form-select" required>
                            <option selected disabled>Pilih Printer</option>
                            @foreach ($printers as $printer)
                                <option value="{{ $printer->idprint }}"
                                    {{ $id == $printer->idprint ? 'selected' : '' }}>{{ $printer->printer_name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary btn-lg mt-3">Buat</button>
                    </div>
                </div>
            </form>
            @if ($id)
                <form action="{{ route('pesan.kirim') }}" method="POST">
                    @csrf
                    <input type="text" value="{{ $id }}" hidden name="idprint">
                    <div class="row mt-2 justify-content-center">
                        <div class="col-3">
                            <h3 class="form-label">Nama : </h3>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-3">
                            <h3 class="form-label">Gedung : </h3>
                            <select name="gedung" class="form-select" required>
                                <option selected disabled>Pilih Gedung</option>
                                <option value="G5">G5</option>
                                <option value="G5A">G5A</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-3">
                            <h3 class="form-label">Area : </h3>
                            <select name="area" id="area" class="form-select">
                                <option value="" disabled selected>Pilih Area</option>
                                <option value="Office">Office</option>
                                <option value="Produksi">Produksi</option>
                                <option value="Gudang">Gudang</option>
                                <option value="Facility">Facility</option>
                                <option value="Test Room">Test Room</option>
                            </select>
                        </div>
                        <div class="col-3" id="pemberitahuan" style="display: none;"></div>
                    </div>
        </div>
        @if ($model === 1)
            <div class="row mt-3 justify-content-center">
                <div class="col-6 warna">
                    <h3 class="form-label">Warna Tinta :</h3>
                    <select name="warna" class="form-select mt-2" required>
                        <option selected disabled>Pilih Warna</option>
                        <option selected value="Black">Black</option>
                        <option disabled value="Cyan">Cyan</option>
                        <option disabled value="Yellow">Yellow</option>
                        <option disabled value="Magenta">Magenta</option>
                    </select>
                </div>
            </div>
        @else
            <div class="row mt-3 justify-content-center">
                <div class="col-6 warna">
                    <h3 class="form-label">Warna Tinta : </h3>
                    <select name="warna" class="form-select mt-2" required>
                        <option selected disabled>Pilih Warna</option>
                        <option value="Black">Black</option>
                        <option value="Cyan">Cyan</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Magenta">Magenta</option>
                    </select>
                </div>
            </div>
        @endif

        <div class="row mt-3 justify-content-center">
            <div class="col">
                <button type="submit" class="btn btn-primary btn-lg">Pesan</button>
            </div>
        </div>
        </form>
        @endif

    </div>
    </div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Menangani perubahan dalam elemen select
        document.getElementById("area").addEventListener("change", function() {
            var pilihan = this.value;
            var pemberitahuan = document.getElementById("pemberitahuan");

            // Periksa apakah opsi yang dipilih sesuai area
            if (pilihan == "Office" || pilihan == "Gudang" || pilihan == "Facility") {
                // Tampilkan pemberitahuan untuk area yang menggunakan segmen
                pemberitahuan.style.display = "block";
                pemberitahuan.innerHTML =
                    '<h3 class="form-label">Departemen : </h3><input type="text" name="departemen" class="form-control" required>';
            } else if (pilihan == "Produksi" || pilihan == "Test Room") {
                // Tampilkan pemberitahuan untuk area yang menggunakan departemen
                pemberitahuan.style.display = "block";
                pemberitahuan.innerHTML =
                    '<h3 class="form-label">Segmen : </h3><input type="text" name="departemen" class="form-control" required>';
            } else {
                // Sembunyikan kedua pemberitahuan jika opsi lain yang dipilih
                pemberitahuan.style.display = "none";
            }
        });
    });
</script>

</html>
