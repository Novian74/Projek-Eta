<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Tinta</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <style>
        @media (min-width: 1024px) {
            body {
                overflow-x: hidden;
            }
        }
    </style>
</head>

<body>
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
                                <a class="nav-link" href="{{ route('tinta.home') }}">Stok Tinta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('printer.home') }}">Printer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('princat.home') }}">Printer + Cartridge</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pelanggan.home') }}">Pelanggan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('booking.home') }}">Booking List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pickup.home') }}">Pickup List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('history.home') }}">History List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('report.home') }}">Report</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('setting.home') }}">Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="row ms-3">
                <div class="mt-3 col d-inline-flex gap-5">
                    <a href="{{ route('tinta.tambah') }}" class="btn btn-primary">Tambah Tinta</a>
                    <a href="#catridge" class="mt-2" style="text-decoration: none">Cartridge</a>
                    <a href="#toner" class="mt-2" style="text-decoration: none">Toner</a>
                </div>
                <div class="justify-content-between align-items-center pt-3 pb-2 mb-3">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <h3 class="mt-2">Catridge</h3>
                    <table class="table" id="catridge">
                        <thead>
                            <tr>
                                <th>Nama Catridge</th>
                                <th>Warna</th>
                                <th>Minimum Stok</th>
                                <th>Stok</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catridges as $catridge)
                                <tr>
                                    <td>{{ $catridge->catridge_name }}</td>
                                    <td>{{ $catridge->warna }}</td>
                                    <td>{{ $catridge->qty }}</td>
                                    <td>{{ $catridge->stok }}</td>
                                    <td><a href="{{ route('tinta.ubah', ['id' => $catridge->idcatridge]) }}"
                                            class="btn btn-warning">Ubah</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('tinta.destroy', $catridge->idcatridge) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h3 class="mt-2">Toner</h3>
                    <table class="table" id="toner">
                        <thead>
                            <tr>
                                <th>Nama Toner</th>
                                <th>Warna</th>
                                <th>Minimum Stok</th>
                                <th>Stok</th>
                                <th>Ubah</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($toners as $toner)
                                <tr>
                                    <td>{{ $toner->catridge_name }}</td>
                                    <td>{{ $toner->warna }}</td>
                                    <td>{{ $toner->qty }}</td>
                                    <td>{{ $toner->stok }}</td>
                                    <td><a href="{{ route('tinta.ubah', ['id' => $toner->idcatridge]) }}"
                                            class="btn btn-warning">Ubah</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('tinta.destroy', $toner->idcatridge) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

</body>

</html>
