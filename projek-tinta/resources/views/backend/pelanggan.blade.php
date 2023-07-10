<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Pelanggan</title>
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
                <div class="btn mt-3 col d-inline-flex gap-5"></div>
                <div class="justify-content-between align-items-center pt-3 pb-2 mb-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Gedung</th>
                                <th>Area</th>
                                <th>Departemen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelanggans as $pelanggan)
                                <tr>
                                    <td>{{ $pelanggan->nama }}</td>
                                    <td>{{ $pelanggan->gedung }}</td>
                                    <td>{{ $pelanggan->area }}</td>
                                    <td>{{ $pelanggan->departemen }}</td>
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
