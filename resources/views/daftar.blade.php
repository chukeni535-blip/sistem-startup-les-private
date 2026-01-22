<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Pembayaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f5f5; }
        .form-card { max-width: 500px; margin: 50px auto; }
    </style>
</head>
<body>

<div class="container form-card">
    <div class="card shadow-lg">
        <div class="card-body">

            <h3 class="text-center mb-4">Formulir Pendaftaran</h3>

            <form action="{{ route('data.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" name="alamat" style="height: 100px" required></textarea>
                    <label>Alamat</label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Paket</label>
                    <select name="paket" class="form-select" required>
                        <option value="">-- Pilih Paket --</option>
                        <option value="Paket SD">Paket SD - Rp 150.000</option>
                        <option value="Paket SMP">Paket SMP - Rp 200.000</option>
                        <option value="Paket SMA">Paket SMA - Rp 350.000</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Bayar</button>

            </form>
        </div>
    </div>
</div>

</body>
</html>