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
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h1 {
            text-align: center;
        }

        h4 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div>
        <div>
            <div class="header">
                <h1>Report Bulanan</h1>
                <h4>{{ $periode }}</h4>
            </div>
            <div>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th>No Nota</th>
                                <th>Nama</th>
                                <th>Departemen</th>
                                <th>Printer</th>
                                <th>Toner</th>
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
</body>
<script type="text/javascript">
    window.print();
</script>

</html>

</html>
