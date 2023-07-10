<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lacak Pesanan</title>
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
            </div>
        </header>

        <div class="col-7 position-absolute top-50 start-50 translate-middle">
            <h2>Cari Pesanan Anda !</h2>
            <form action="{{ route('pesan.lacak') }}" method="POST">
                @csrf
                Nomor Nota :
                <input type="text" name="lacak" />
                <button type="submit">Cari</button>
            </form>

            @if ($datas)
                <div class="mt-4">
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th>Nomor Nota</th>
                                <th>Nama</th>
                                <th>Warna</th>
                                <th>Printer</th>
                                <th>Status</th>
                                <th>Batas Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $data->nomornota }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->warna }}</td>
                                    <td>{{ $data->printer_name }}</td>
                                    <td>
                                        @switch($data->status)
                                            @case('1')
                                                PENDING
                                            @break

                                            @case('2')
                                                READY TO PICKUP
                                            @break

                                            @case('3')
                                                FINISH
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if ($data->batasW === 'not')
                                            -
                                        @else
                                            {{ $data->batasW }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <footer class="mt-auto text-white-50">
            <h3><a href="{{ route('pesan.home') }}">Pesan Tinta</a></h3>
        </footer>
    </div>

</body>

</html>

</html>

</html>
