<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Upload Bukti Transfer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">

            <h4 class="mb-3">Upload Bukti Transfer</h4>

            <p>
                Nama: <b>{{ $data->nama }}</b><br>
                Paket: <b>{{ $data->paket }}</b><br>
                Total: <b>Rp {{ number_format($data->biaya, 0, ',', '.') }}</b>
            </p>

            <form action="{{ route('pembayaran.upload.store', $data->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" class="form-control" required>
                </div>

                <button class="btn btn-success w-100">
                    Upload Sekarang
                </button>
            </form>

            <a href="{{ route('data.index') }}"
               class="btn btn-outline-secondary w-100 mt-2">
                Batal
            </a>

        </div>
    </div>
</div>

</body>
</html>