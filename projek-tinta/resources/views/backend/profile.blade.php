<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60">
    <title>Admin | Profil Page</title>
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
                <div class="col mt-2">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="text-center mt-5">
                        <img src="{{ asset('images/png-transparent-penguin-penguin-animal-penguin-clipart.png') }}"
                            class="img-fluid rounded-circle" width="300px">
                    </div>
                    <h2 class="text-center mt-2">{{ $username }}</h2>
                    <p class="text-center mt-2">{{ $level }}</p>
                </div>
                <div class="col d-flex justify-content-end pt-3 pb-2 mb-3">
                    <div class="card" style="width: 45rem;">
                        <div class="card-body">
                            <form action="{{ route('profile.kirim') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <h5>Tanggal Pengiriman Email Otomoatis : </h5>
                                <input type="number" name="tgl" class="form-control" min="0" max="31">
                                <p>Tanggal yang dipilih untuk bulan selanjutnya</p>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                            <form action="{{ route('profile.email') }}" method="POST" class="mt-3">
                                @csrf
                                @method('PUT')
                                <h5>Alamat Email : </h5>
                                <input type="email" name="email" class="form-control">
                                <p>Masukkan email untuk pengiriman otomatis</p>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                            <form action="{{ route('profile.tele') }}" method="POST" class="mt-3">
                                @csrf
                                @method('PUT')
                                <h5>Chat ID Telegram : </h5>
                                <input type="number" name="tele" class="form-control">
                                <p>Ketikan "/start" ke telegrambotraw untuk mendapatkan chat id anda, Tulis chat ID
                                    anda
                                </p>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                                <a href="https://t.me/CATRIDGEBOT" class="ms-3">Link Bot Catridge</a>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>

</html>
