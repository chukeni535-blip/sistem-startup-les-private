<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Paket Belajar - Les Privat Bimbingan Belajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/KENI.jpg') }}" alt="Logo Les Privat" width="60" height="60" class="me-2 rounded-circle">
                <span class="fw-bold">Les Privat Bimbingan Belajar</span>
            </a>
            <a class="nav-link text-white ms-auto" href="/">Beranda</a>
        </div>
    </nav>

    <!-- Produk -->
    <div class="container py-5">
        <h2 class="text-center mb-4 text-primary fw-bold">Paket Bimbingan Belajar</h2>

        <div class="row justify-content-center">
            @foreach ($paket as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <img src="{{ asset('images/KENI.jpg') }}" alt="Icon" width="80" height="80" class="mb-3 rounded-circle">
                            <h5 class="card-title text-primary">{{ $item['nama'] }}</h5>
                            <p class="card-text">{{ $item['deskripsi'] }}</p>
                            <p class="fw-bold text-success">{{ $item['harga'] }}</p>
                            <a href="{{ route('daftar', $item['nama']) }}" class="btn btn-outline-primary btn-sm">
    Daftar Sekarang
</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="/" class="btn btn-secondary">← Kembali ke Beranda</a>
        </div>
    </div>

    <footer class="text-center py-3 mt-5 bg-white shadow-sm">
        <small>© 2025 Les Privat Bimbinga Belajar. Semua Hak Dilindungi oleh Pingkeli Santri Keni.</small>
    </footer>

</body>
</html>