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
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</head>

<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top">
            <div class="container">
                <a class="navbar-brand"href="{{ route('admin') }}">Admin Page</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/tinta">Stok Tinta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/printer">Printer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/printcat">Printer + Cartridge</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/pelanggan">Pelanggan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/booking">Booking List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/pickup">Pickup List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/history">History List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/report">Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/setting">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/logout">Logout</a>
                        </li>
                    </ul>
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
                                <th>Nama Catridge</th>
                                <th>Warna Catridge</th>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Ambil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                @php
                                    $tglA = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                                    $tglB = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->format('d-m-Y');
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
