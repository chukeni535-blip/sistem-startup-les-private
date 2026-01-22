<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @media print {
            .no-print {
                display: none;
            }
            body {
                background: white;
            }
        }

        .bukti-img {
            max-width: 300px;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">

            <h4 class="text-center mb-4 fw-bold">LAPORAN PEMBAYARAN</h4>

            <table class="table table-bordered">
                <tr>
                    <th width="30%">Nama</th>
                    <td>{{ $data->nama }}</td>
                </tr>
                <tr>
                    <th>Paket</th>
                    <td>{{ $data->paket }}</td>
                </tr>
                <tr>
                    <th>Total Biaya</th>
                    <td>Rp {{ number_format($data->biaya, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge 
                            {{ $data->status == 'Lunas' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $data->status }}
                        </span>
                    </td>
                </tr>
            </table>

            <p class="mt-3 fw-bold">Bukti Transfer:</p>

            @if($data->bukti_transfer && file_exists(public_path('storage/' . $data->bukti_transfer)))
                <img 
                    src="{{ asset('storage/' . $data->bukti_transfer) }}" 
                    class="img-fluid bukti-img"
                    alt="Bukti Transfer">
            @else
                <p class="text-muted fst-italic">Bukti transfer belum tersedia</p>
            @endif

            <div class="text-center mt-4 no-print">
                <button onclick="window.print()" class="btn btn-primary">
                    Cetak Laporan
                </button>

                <a href="{{ route('data.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
