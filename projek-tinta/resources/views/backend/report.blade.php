@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Report</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/app.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</head>

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

        <div class="row justify-content-center align-items-center">
            <div class="col-5 mt-3">
                <h2 class="text-center">Report Bulanan</h2>
                <form action="{{ route('report.tampil') }}" method="post">
                    @csrf
                    <label for="tanggal-awal" class="form-label">Tanggal Awal:</label>
                    <input class="form-control" type="date" name="tanggalAw">
                    <label for="mahasiswa_id" class="form-label mt-3">Tanggal Akhir:</label>
                    <input class="form-control" type="date" name="tanggakAkh">
                    <button class="btn btn-primary mt-3" type="submit">Tampilkan</button>
                    @if ($datas)
                        <a href="{{ route('report.cetak', ['data' => urlencode(json_encode($datas)), 'periode' => $periode]) }}"
                            class="btn btn-success mt-3 ms-3">Download / Print</a>
                        <a href="{{ route('report.home') }}" class="btn btn-danger mt-3 ms-3">Cari Ulang</a>
                    @endif
                </form>
            </div>
        </div>
        @if ($datas)
            <div class="row justify-content-center align-items-center mt-3">
                <div class="col-11">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nomor Nota</th>
                                <th>Nama Pelanggan</th>
                                <th>Departemen</th>
                                <th>Nama Printer</th>
                                <th>Nama Tinta</th>
                                <th>Warna Tinta</th>
                                <th>Waktu Pesan</th>
                                <th>Waktu Ambil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                @php
                                    $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at);
                                    $created_at->setTimezone('Asia/Jakarta');
                                    $tglA = $created_at->format('d-m-Y H:i:s');
                                    
                                    $updated_at = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at);
                                    $updated_at->setTimezone('Asia/Jakarta');
                                    $tglB = $updated_at->format('d-m-Y H:i:s');
                                @endphp
                                <tr>
                                    <td>{{ $data->nomornota }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->departemen }}</td>
                                    <td>{{ $data->printer_name }}</td>
                                    <td>{{ $data->catridge_name }}</td>
                                    <td>{{ $data->warna }}</td>
                                    <td>{{ $tglA }}</td>
                                    <td>{{ $tglB }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        @endif
    </div>
</div>
</div>

</body>

</html>
