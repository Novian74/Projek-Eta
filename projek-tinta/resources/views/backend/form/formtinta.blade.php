<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | {{ $judul }} Tinta</title>
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
                <h2 class="text-center">{{ $judul }} Tinta</h2>
                <form action="{{ route($route) }}" method="POST">
                    @csrf
                    @if (isset($update))
                        @method('PUT')
                    @endif
                    @foreach ($data as $tinta)
                        <input type="text" value="{{ $tinta->idcatridge }}" name="idcatridge" hidden>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Tinta</label>
                            <input type="text" class="form-control" name="catridge_name"
                                value="{{ $tinta->catridge_name }}" />
                        </div>
                        <div class="mb-3">
                            <label for="model" class="form-label">Model Tinta</label>
                            <select name="TC" class="form-select mt-2" required>
                                <option disabled value="pilih" {{ $tinta->TC == 'pilih' ? 'selected' : '' }}>Pilih
                                    Model</option>
                                <option value="1" {{ $tinta->TC == 1 ? 'selected' : '' }}>Toner</option>
                                <option value="2" {{ $tinta->TC == 2 ? 'selected' : '' }}>Cartridge</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="warna" class="form-label">Warna Tinta</label>
                            <select name="warna" class="form-select mt-2" required>
                                <option disabled value="pilih" {{ $tinta->warna == 'pilih' ? 'selected' : '' }}>Pilih
                                    Warna</option>
                                <option value="Black" {{ $tinta->warna == 'Black' ? 'selected' : '' }}>Black</option>
                                <option value="Cyan" {{ $tinta->warna == 'Cyan' ? 'selected' : '' }}>Cyan</option>
                                <option value="Yellow" {{ $tinta->warna == 'Yellow' ? 'selected' : '' }}>Yellow
                                </option>
                                <option value="Magenta" {{ $tinta->warna == 'Magenta' ? 'selected' : '' }}>Magenta
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="merek" class="form-label">Minimum Stok</label>
                            <input type="number" class="form-control" name="qty" value="{{ $tinta->qty }}" />
                        </div>
                        <div class="mb-3">
                            <label for="merek" class="form-label">Stok</label>
                            <input type="number" class="form-control" name="stok" value="{{ $tinta->stok }}" />
                        </div>
                    @endforeach
                    <input type="submit" class="btn btn-primary" name="Tambah" value="{{ $judul }}">
                </form>
            </div>
        </main>
    </div>
</div>

</body>

</html>
