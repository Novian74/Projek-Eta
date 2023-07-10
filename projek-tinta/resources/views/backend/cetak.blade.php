@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Cetak Report {{ $periode }}</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</head>

@if ($datas)
    <div class="container-fluid">
        <div class="row">
            <div class="row justify-content-center align-items-center mt-3">
                <h2 class="text-center">Report Bulanan</h2>
                <h4 class="text-center">{{ $periode }}</h4>
            </div>
            <div class="row mt-2">
                <div class="col ms-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nomor Nota</th>
                                <th>Nama</th>
                                <th>Departemen</th>
                                <th>Printer</th>
                                <th>Catridge</th>
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
            </div>
        </div>
    </div>
    </div>
@endif
<script type="text/javascript">
    window.print();
</script>
</body>

</html>
