<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * HALAMAN BERANDA
     * Ambil data dari YouTube API dengan aman
     */
    public function beranda()
    {
        $apiKey    = env('YOUTUBE_API_KEY');
        $channelId = env('YOUTUBE_CHANNEL_ID');

        // Validasi env
        if (empty($apiKey) || empty($channelId)) {
            return view('beranda')->with([
                'error' => 'API Key atau Channel ID belum diset di file .env'
            ]);
        }

        // Ambil data channel
        $urlChannel = "https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id={$channelId}&key={$apiKey}";
        $resultChannel = $this->get_CURL($urlChannel);

        // Validasi response
        if (!is_array($resultChannel) || !isset($resultChannel['items'][0])) {
            return view('beranda')->with([
                'error' => 'Gagal mengambil data YouTube. Periksa API Key, Channel ID, atau koneksi internet.'
            ]);
        }

        $item = $resultChannel['items'][0];

        // Ambil data dengan aman
        $youtubefotoProfile = $item['snippet']['thumbnails']['medium']['url'] ?? null;
        $namachannel        = $item['snippet']['title'] ?? 'Tidak ditemukan';
        $subscribers        = isset($item['statistics']['subscriberCount'])
            ? number_format($item['statistics']['subscriberCount'])
            : 0;

        // Ambil video terbaru
        $urlLatestVideo = "https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId={$channelId}&maxResults=1&key={$apiKey}";
        $resultLatest = $this->get_CURL($urlLatestVideo);

        return view('beranda', compact(
            'youtubefotoProfile',
            'namachannel',
            'subscribers',
            'resultLatest'
        ));
    }

    /**
     * HALAMAN PRODUK
     */
    public function produk()
    {
        $paket = [
            [
                'nama' => 'Paket SD',
                'deskripsi' => 'Belajar semua mata pelajaran tingkat SD.',
                'harga' => 'Rp 150.000 / bulan'
            ],
            [
                'nama' => 'Paket SMP',
                'deskripsi' => 'Bimbingan belajar untuk semua mapel SMP.',
                'harga' => 'Rp 200.000 / bulan'
            ],
            [
                'nama' => 'Paket SMA',
                'deskripsi' => 'Bimbingan belajar khusus tingkat SMA.',
                'harga' => 'Rp 300.000 / bulan'
            ]
        ];

        return view('produk', compact('paket'));
    }

    /**
     * HALAMAN DAFTAR / PEMBAYARAN
     * Dipanggil dari tombol "Daftar Sekarang"
     */
    public function daftar($nama)
    {
        return view('daftar', compact('nama'));
    }

    /**
     * HELPER CURL
     */
    private function get_CURL($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_TIMEOUT        => 15
        ]);

        $result = curl_exec($curl);

        if ($result === false) {
            $error = curl_error($curl);
            curl_close($curl);
            return ['error' => $error];
        }

        curl_close($curl);

        return json_decode($result, true);
    }
}