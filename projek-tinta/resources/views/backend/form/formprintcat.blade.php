<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Tambah Relasi</title>
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
            </div>
        </nav>

        <main class="row justify-content-center align-items-center">
            <div class="col-5 mt-3">
                <h2 class="text-center">Tambah Relasi</h2>
                <form action="{{ route('printcat.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="printer" class="form-label">Nama Printer</label>
                        <select name="idprint" class="form-select mt-2" required>
                            <option disabled selected value="pilih">Pilih Printer</option>
                            @foreach ($printers as $printer)
                                <option value="{{ $printer->idprint }}">{{ $printer->printer_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catridge" class="form-label">Nama Catridge</label>
                        <select name="idcatridge" class="form-select mt-2" required>
                            <option disabled selected value="pilih">Pilih Catridge</option>
                            @foreach ($catridges as $catridge)
                                <option value="{{ $catridge->idcatridge }}">{{ $catridge->catridge_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" name="Tambah" value="Tambah">
                </form>
            </div>
        </main>
    </div>
</div>

</body>

</html>
