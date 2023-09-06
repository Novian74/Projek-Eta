<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60">
    <title>Admin | List User Page</title>
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
            <main class="row ms-3 me-3 justify-content-center">
                <div class="table-responsive text-center">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <h2 class="text-center">List Admin</h2>
                    <a href="{{ route('listuser.tambah') }}" class="btn btn-primary">TAMBAH ADMIN</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Level</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->password }}</td>
                                    <td>{{ $admin->level }}</td>
                                    <td>
                                        <form action="{{ route('listuser.destroy', $admin->id) }}" method="POST">
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
