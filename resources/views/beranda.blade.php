<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Les Privat Bimbingan Belajar - Beranda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('images/KENI.jpg') }}" width="60" height="60" class="me-2 rounded-circle">
            <span class="fw-bold">Les Privat Bimbingan Belajar</span>
        </a>
        <a class="nav-link text-white ms-auto" href="/produk">Lihat Paket</a>
    </div>
</nav>

<main class="container py-5 text-center">
    <img src="{{ asset('images/KENI.jpg') }}" width="140" height="140" class="mb-4 rounded-circle shadow">

    <h1 class="fw-bold text-primary">HALLO...</h1>
    <h1 class="fw-bold text-primary">Selamat Datang di Les Privat Bimbingan Belajar!</h1>

    <p class="lead">
        Kami menyediakan layanan bimbingan belajar profesional untuk SD, SMP, dan SMA.
    </p>

    <a href="/produk" class="btn btn-success btn-lg mt-3">Lihat Paket Belajar</a>
</main>

<!-- YouTube Section -->
<div class="container mb-5">
    <div class="text-center mb-4">
        <h2>YouTube</h2>
    </div>

    <div class="row g-4">

        <!-- Channel Profile -->
        <div class="col-lg-4">
            <div class="p-3 bg-white shadow-sm rounded">
                <div class="d-flex align-items-center">
                    <div>
                        <h3>{{ $namachannel ?? 'Nama Channel' }}</h3>
                        <span>{{ $subscribers ?? 0 }} Subscribers</span>
                    </div>

                    <img 
                        src="{{ $youtubefotoProfile ?? asset('images/default.png') }}" 
                        width="80" 
                        height="80" 
                        class="rounded-circle ms-auto">
                </div>
            </div>
        </div>

        <!-- Latest Video -->
        <div class="col-lg-8">
            <div class="p-3 bg-white shadow-sm rounded">

                @php
                    $latestVideoId = $resultLatest['items'][0]['id']['videoId'] ?? null;
                @endphp

                @if($latestVideoId)
                    <iframe
                        width="100%"
                        height="400"
                        src="https://www.youtube.com/embed/{{ $latestVideoId }}"
                        frameborder="0"
                        allowfullscreen>
                    </iframe>
                @else
                    <p class="text-danger text-center">
                        Tidak dapat memuat video terbaru.
                    </p>
                @endif

            </div>
        </div>

    </div>
</div>

<!-- Footer -->
<footer class="text-center py-3 mt-5 bg-white shadow-sm">
    <small>©2025 Les Privat Bimbingan Belajar. Semua Hak Dilindungi.</small>
</footer>

</body>
</html>
