@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | History</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/app.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    
</head>

<body>
    <div class="container-fluid">
        <div class="row">
          <nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top">
            <div class="container">
                <a class="navbar-brand fs-5" href="{{ route('admin') }}">Admin Page</a>
                <div class="collapse navbar-collapse mt-3 d-flex justify-content-end" id="navbarNav">
                    <div class="dropdown me-5">
                        <p class="fs-5" id="dropdownMenuButton" data-mdb-toggle="dropdown">
                            Data Printer
                        </p>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ route('tinta.home') }}">Stok Tinta</a></li>
                            <li><a class="dropdown-item" href="{{ route('printer.home') }}">Printer</a></li>
                            <li><a class="dropdown-item" href="{{ route('princat.home') }}">Printer + Tinta</a></li>
                        </ul>
                    </div>
                    <div class="dropdown me-5">
                        <p class="fs-5" id="dropdownMenuButton" data-mdb-toggle="dropdown">
                            Order
                        </p>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ route('pelanggan.home') }}">Pelanggan</a></li>
                            <li><a class="dropdown-item" href="{{ route('booking.home') }}">Booking List</a></li>
                            <li><a class="dropdown-item" href="{{ route('pickup.home') }}">Pickup List</a></li>
                            <li><a class="dropdown-item" href="{{ route('history.home') }}">History List</a></li>
                        </ul>
                    </div>
                    <div class="me-5">
                        <a class="dropdown-item fs-5 mb-3" href="{{ route('report.home') }}">Report</a>
                    </div>
                    <div class="dropdown me-5">
                        <p class="fs-5" id="dropdownMenuButton" data-mdb-toggle="dropdown">
                            Settings
                        </p>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @if ($superadmin)
                                <li><a class="dropdown-item" href="{{ route('setting.listuser') }}">List User</a>
                                </li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('setting.historiemail') }}">Histori
                                    Email</a></li>
                            <li><a class="dropdown-item" href="{{ route('setting.profile') }}">Profil Saya</a></li>
                        </ul>
                    </div>
                    <div>
                        <a class="dropdown-item fs-5 mb-3" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
            <main class="row ms-3">
                <div class="mt-3 col-3 d-inline-flex gap-5">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                </div>
                <div class="mt-3 col-3 d-inline-flex gap-5">
                    <select class="form-select" id="nama-filter">
                        <option value="">Nama</option>
                        @foreach ($historys->pluck('nama')->unique() as $nama)
                            <option value="{{ $nama }}">{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3 col-3 d-inline-flex gap-5">
                    <select class="form-select" id="departemen-filter">
                        <option value="">Departemen</option>
                        @foreach ($historys->pluck('departemen')->unique() as $departemen)
                            <option value="{{ $departemen }}">{{ $departemen }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3 col-3 d-inline-flex gap-5">
                    <select class="form-select" id="printer-filter">
                        <option value="">Printer</option>
                        @foreach ($printers as $printer)
                            <option value="{{ $printer->printer_name }}">{{ $printer->printer_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="justify-content-between align-items-center pt-3 pb-2 mb-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nomor Nota</th>
                                <th>Nama Pelanggan</th>
                                <th>Departemen</th>
                                <th>Nama Printer</th>
                                <th>Nama Tinta</th>
                                <th>Warna Tinta</th>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Ambil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historys as $history)
                                @php
                                    $tglA = Carbon::createFromFormat('Y-m-d H:i:s', $history->created_at)->format('d-m-Y');
                                    $tglB = Carbon::createFromFormat('Y-m-d H:i:s', $history->updated_at)->format('d-m-Y');
                                @endphp
                                <tr>
                                    <td>{{ $history->nomornota }}</td>
                                    <td>{{ $history->nama }}</td>
                                    <td>{{ $history->departemen }}</td>
                                    <td>{{ $history->printer_name }}</td>
                                    <td>{{ $history->catridge_name }}</td>
                                    <td>{{ $history->warna }}</td>
                                    <td>{{ $tglA }}</td>
                                    <td>{{ $tglB }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

</body>
<script>
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.toLowerCase();
        rows.forEach(row => {
            const columns = row.querySelectorAll('td');
            let found = false;
            columns.forEach(column => {
                if (column.textContent.toLowerCase().includes(searchTerm)) {
                    found = true;
                }
            });

            row.style.display = found ? 'table-row' : 'none';
        });
    });

    document.getElementById("nama-filter").addEventListener("change", filterTable);
    document.getElementById("departemen-filter").addEventListener("change", filterTable);
    document.getElementById("printer-filter").addEventListener("change", filterTable);

    function filterTable() {
        var nama = document.getElementById("nama-filter").value;
        var departemen = document.getElementById("departemen-filter").value;
        var printer = document.getElementById("printer-filter").value;
        var rows = document.querySelectorAll("tbody tr");

        rows.forEach(function(row) {
            var namaCell = row.querySelector("td:nth-child(2)");
            var departemenCell = row.querySelector("td:nth-child(3)");
            var printerCell = row.querySelector("td:nth-child(4)");
            var shouldShow = (nama === "" || namaCell.textContent === nama) && (departemen === "" ||
                departemenCell.textContent === departemen) && (printer === "" || printerCell.textContent ===
                printer);
            row.style.display = shouldShow ? "" : "none";
        });
    }
</script>


</html>
