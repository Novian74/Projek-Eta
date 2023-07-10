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
            <div class="row mt-3">
                <h3>Nota Pembelian</h3>
                <div class="col mt-5">
                    <h5>Nomor Nota :
                        <input type="text" style="background: none; color: white; width: 75px;" id="textToCopy"
                            value="{{ $nomornota }}" readonly> <button class="btn btn-primary btn-sm "
                            onclick="copyText()">Copy</button>
                    </h5>
                    <h4 class="text-danger">Simpan Nomor Nota Untuk Cek Status !</h4>
                </div>
                <div class="col mt-5">
                    <h4 class="mt-2">Tinta : {{ $tinta }}</h4>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col mt-3">
                    <h2><a href="{{ route('pesan.home') }}">Pesan Lagi</a></h2>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    function copyText() {
        var textToCopy = document.getElementById("textToCopy");
        textToCopy.select();
        document.execCommand("copy");
    }
</script>

</html>
