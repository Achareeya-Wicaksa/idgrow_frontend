<!-- resources/views/mutasi/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mutasi</title>
    @vite('resources/js/app.js')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('barang.index') }}">Manajemen Barang</a>
        <a class="navbar-brand" href="{{ route('mutasi.index') }}">Mutasi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome, {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Log Out</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h1>Manajemen Mutasi</h1>
    
    <!-- Form untuk menambah Mutasi baru -->
    <form action="{{ url('/mutasi') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="jenis_mutasi" class="form-label">Jenis Mutasi</label>
            <input type="text" name="jenis_mutasi" id="jenis_mutasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="barang_id" class="form-label">Barang ID</label>
            <input type="number" name="barang_id" id="barang_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Mutasi</button>
    </form>

    <!-- Tabel untuk menampilkan Mutasi -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Jenis Mutasi</th>
                <th>Jumlah</th>
                <th>Barang ID</th>
                <th>User ID</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mutasis as $mutasi)
                <tr>
                    <td>{{ $mutasi['ID'] ?? 'N/A' }}</td>
                    <td>{{ $mutasi['tanggal'] }}</td>
                    <td>{{ $mutasi['jenis_mutasi'] }}</td>
                    <td>{{ $mutasi['jumlah'] }}</td>
                    <td>{{ $mutasi['barang_id'] }}</td>
                    <td>{{ $mutasi['user_id'] }}</td>
                    <td>
                        <form action="{{ url('/mutasi/' . $mutasi['ID']) }}" method="POST" style="display:inline;">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
