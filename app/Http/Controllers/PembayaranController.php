<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * TAMPILKAN DATA PEMBAYARAN
     */
    public function uploadForm($id)
{
    $data = Pembayaran::findOrFail($id);
    return view('upload-bukti', compact('data'));
}

public function uploadStore(Request $request, $id)
{
    $request->validate([
        'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $pembayaran = Pembayaran::findOrFail($id);

    $file = $request->file('bukti_transfer');
    $namaFile = time() . '_' . $file->getClientOriginalName();
    $file->storeAs('public/bukti-transfer', $namaFile);

    $pembayaran->update([
        'bukti_transfer' => $namaFile,
        'status' => 'Menunggu Verifikasi'
    ]);

    return redirect()->route('data.index')
        ->with('success', 'Bukti transfer berhasil diupload, menunggu verifikasi');
}
    public function index()
    {
        $pembayaran = Pembayaran::latest()->get();
        return view('data', compact('pembayaran'));
    }

    /**
     * SIMPAN DATA DARI FORM
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email',
            'alamat' => 'required|string',
            'paket'  => 'required|string',
        ]);

        // Mapping paket → biaya
        $biayaPaket = [
            'Paket SD'  => 150000,
            'Paket SMP' => 250000,
            'Paket SMA' => 350000,
        ];

        $biaya = $biayaPaket[$request->paket] ?? 250000;

        Pembayaran::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'alamat' => $request->alamat,
            'paket'  => $request->paket,
            'biaya'  => $biaya,
            'status' => 'Hutang',
        ]);

        return redirect()->route('data.index')
            ->with('success', 'Data pembayaran berhasil ditambahkan');
    }

    /**
     * HALAMAN INSTRUKSI TRANSFER
     */
    public function instruksi($id)
    {
        $data = Pembayaran::findOrFail($id);
        return view('instruksi-transfer', compact('data'));
    }

    /**
     * HAPUS DATA
     */
    public function destroy($id)
    {
        Pembayaran::findOrFail($id)->delete();

        return redirect()->route('data.index')
            ->with('success', 'Data pembayaran berhasil dihapus');
    }

    /**
     * UBAH STATUS LUNAS
     */
    public function bayar($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'Lunas';
        $pembayaran->save();

        return redirect()->route('data.index')
            ->with('success', 'Pembayaran berhasil, status Lunas');
    }
}