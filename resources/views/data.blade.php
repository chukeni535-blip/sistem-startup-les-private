<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Bayar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">
    <h1>Tabel Data Pembayaran</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No ID</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Aksi</th>
                <th>Bayar</th>
            </tr>
        </thead>

        <tbody>
        @foreach($pembayaran as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama }}</td>

                <td>
                    @if($item->status == 'Lunas')
                        <span class="badge bg-success">Lunas</span>
                    @else
                        <span class="badge bg-warning text-dark">Hutang</span>
                    @endif
                </td>

                <td>
                    <form action="{{ route('pembayaran.hapus', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </form>
                </td>

                <td>
<a href="{{ route('pembayaran.instruksi', $item->id) }}" 
   class="btn btn-primary btn-sm">
    Bayar
</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>