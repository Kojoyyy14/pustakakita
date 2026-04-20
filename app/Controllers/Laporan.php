<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Laporan extends BaseController
{
   public function index()
{
    $db = \Config\Database::connect();
    $bulanIni = date('m');
    $tahunIni = date('Y');

    // 1. Ambil data transaksi untuk Tabel
    $laporan = $db->table('peminjaman')
        ->select('peminjaman.*, buku.judul, users.nama')
        ->join('buku', 'buku.id_buku = peminjaman.id_buku')
        ->join('users', 'users.id_user = peminjaman.id_user')
        ->where('MONTH(peminjaman.tanggal_pinjam)', $bulanIni)
        ->where('YEAR(peminjaman.tanggal_pinjam)', $tahunIni)
        ->get()->getResultArray();

    // 2. Hitung Total Denda (Penyebab error tadi)
    $totalDenda = $db->table('peminjaman')
        ->selectSum('denda')
        ->where('MONTH(peminjaman.tanggal_pinjam)', $bulanIni)
        ->get()->getRow()->denda ?? 0;

    // 3. Data untuk Grafik Batang (Tren Harian)
    $trenHarian = $db->table('peminjaman')
        ->select('DAY(tanggal_pinjam) as tgl, COUNT(*) as total')
        ->where('MONTH(tanggal_pinjam)', $bulanIni)
        ->groupBy('DAY(tanggal_pinjam)')
        ->get()->getResultArray();

    // 4. Data untuk Pie Chart (Distribusi Kategori)
    $distribusiKategori = $db->table('peminjaman')
        ->select('buku.kategori, COUNT(*) as total')
        ->join('buku', 'buku.id_buku = peminjaman.id_buku')
        ->groupBy('buku.kategori')
        ->get()->getResultArray();

    // 5. Kirim SEMUA variabel ke View
    $data = [
        'title'       => 'Laporan Bulanan PustakaKita',
        'laporan'     => $laporan,
        'total_denda' => $totalDenda, // Sekarang variabel ini sudah ada!
        'tren'        => json_encode($trenHarian),
        'kategori'    => json_encode($distribusiKategori)
    ];

    return view('laporan/index', $data);
}
}