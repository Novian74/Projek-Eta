@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Booking</title>
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
                <div class="btn mt-3 col d-inline-flex gap-5"></div>
                <div class="justify-content-between align-items-center pt-3 pb-2 mb-3">
                    <table class="table">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::has('err'))
                            <div class="alert alert-danger">
                                {{ Session::get('err') }}
                            </div>
                        @endif

                        <thead>
                            <tr>
                                <th>Nomor Nota</th>
                                <th>Mama Pelanggan</th>
                                <th>Nama Printer</th>
                                <th>Nama Tinta</th>
                                <th>Warna Tinta</th>
                                <th>Waktu Pesan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                @php
                                    $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $booking->created_at);
                                    
                                    // Set zona waktu ke 'Asia/Jakarta'
                                    $created_at->setTimezone('Asia/Jakarta');
                                    
                                    // Format tanggal dan waktu dalam zona waktu Jakarta
                                    $tgl = $created_at->format('d-m-Y H:i:s');
                                @endphp
                                <tr>
                                    <td>{{ $booking->nomornota }}</td>
                                    <td>{{ $booking->nama }}</td>
                                    <td>{{ $booking->printer_name }}</td>
                                    <td>{{ $booking->catridge_name }}</td>
                                    <td>{{ $booking->warna }}</td>
                                    <td>{{ $tgl }}</td>
                                    <td>
                                        <form
                                            action="{{ route('booking.ready', ['nomornota' => $booking->nomornota, 'idcatridge' => $booking->idcatridge]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning">PENDING</button>
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
