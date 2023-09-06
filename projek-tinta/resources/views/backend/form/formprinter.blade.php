<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | {{ $judul }} Printer</title>
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
                <h2 class="text-center">{{ $judul }} Printer</h2>
                <form action="{{ route($route) }}" method="POST">
                    @csrf
                    @if (isset($update))
                        @method('PUT')
                    @endif
                    @foreach ($data as $printer)
                        <input type="text" value="{{ $printer->idprint }}" name="idprint" hidden>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Printer</label>
                            <input type="text" class="form-control" name="printer_name"
                                value="{{ $printer->printer_name }}" />
                        </div>
                        <div class="mb-3">
                            <label for="model" class="form-label">Model Printer</label>
                            <select name="model_tinta" class="form-select mt-2" required>
                                <option disabled value="pilih"
                                    {{ $printer->model_tinta == 'pilih' ? 'selected' : '' }}>Pilih
                                    Model</option>
                                <option value="1" {{ $printer->model_tinta == 1 ? 'selected' : '' }}>Black</option>
                                <option value="2" {{ $printer->model_tinta == 2 ? 'selected' : '' }}>Black & Color
                                </option>
                            </select>
                        </div>
                    @endforeach
                    <input type="submit" class="btn btn-primary" name="Tambah" value="{{ $judul }}">
                    <a href="{{ route('printer.home') }}" class="btn btn-danger">Batal</a>
                </form>
            </div>
        </main>
    </div>
</div>

</body>

</html>
