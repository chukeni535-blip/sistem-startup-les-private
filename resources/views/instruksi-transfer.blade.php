<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Instruksi Transfer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">

            <h4 class="text-primary mb-3">
                <i class="bi bi-bank"></i> Instruksi Transfer
            </h4>

            <p>Halo <b>{{ $data->nama }}</b>, silakan lakukan pembayaran ke rekening berikut:</p>

            <div class="alert alert-info">
                <b>Bank BRI</b><br>
                No Rekening: <b>0817 1234 3535</b><br>
                A/N: <b>Keni</b>
            </div>

            <p>
                Paket: <b>{{ $data->paket }}</b>
            </p>

            <p>
                Total Bayar:
                <b class="text-success">
                    Rp {{ number_format($data->biaya, 0, ',', '.') }}
                </b>
            </p>

<a href="{{ route('pembayaran.upload', $data->id) }}"
   class="btn btn-success w-100 mt-3">
    Upload Bukti Transfer
</a>

            <a href="{{ route('data.index') }}"
               class="btn btn-outline-secondary w-100 mt-2">
                Kembali ke Data
            </a>

        </div>
    </div>
</div>

</body>
</html>