<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * HALAMAN INSTRUKSI PEMBAYARAN
     */
    public function instruksi($id)
    {
        $data = Pembayaran::findOrFail($id);
        return view('pembayaran.instruksi', compact('data'));
    }

    /**
     * FORM UPLOAD BUKTI TRANSFER
     */
    public function uploadForm($id)
    {
        $data = Pembayaran::findOrFail($id);
        return view('upload-bukti', compact('data'));
    }

    /**
     * SIMPAN BUKTI TRANSFER
     */
    public function uploadStore(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        // Hapus bukti lama jika ada
        if ($pembayaran->bukti_transfer) {
            Storage::disk('public')->delete($pembayaran->bukti_transfer);
        }

        // Simpan file
        $path = $request->file('bukti_transfer')
                        ->store('bukti-transfer', 'public');

        // Update database
        $pembayaran->update([
            'bukti_transfer' => $path,
            'status' => 'Menunggu Verifikasi'
        ]);

        return redirect()->route('pembayaran.laporan', $pembayaran->id)
            ->with('success', 'Bukti transfer berhasil diupload');
    }

    /**
     * HALAMAN LAPORAN PEMBAYARAN
     */
    public function laporan($id)
    {
        $data = Pembayaran::findOrFail($id);
        return view('pembayaran.laporan', compact('data'));
    }

    /**
     * TAMPILKAN SEMUA DATA
     */
    public function index()
    {
        $pembayaran = Pembayaran::latest()->get();
        return view('data', compact('pembayaran'));
    }

    /**
     * SIMPAN DATA PENDAFTARAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email',
            'alamat' => 'required|string',
            'paket'  => 'required|string',
        ]);

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
     * HAPUS DATA
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        if ($pembayaran->bukti_transfer) {
            Storage::disk('public')->delete($pembayaran->bukti_transfer);
        }

        $pembayaran->delete();

        return redirect()->route('data.index')
            ->with('success', 'Data pembayaran berhasil dihapus');
    }

    /**
     * STATUS LUNAS
     */
    public function bayar($id)
    {
        Pembayaran::findOrFail($id)->update([
            'status' => 'Lunas'
        ]);

        return redirect()->route('data.index')
            ->with('success', 'Pembayaran berhasil, status Lunas');
    }
}
