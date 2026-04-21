<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
   public function index()
{
    $db = \Config\Database::connect();

    // 1. Hitung Total Koleksi
    $totalBuku = $db->table('buku')->selectSum('stok')->get()->getRow()->stok ?? 0;

    // 2. Hitung Buku yang sedang dipinjam
    $totalDipinjam = $db->table('peminjaman')
                        ->where('status', 'dipinjam')
                        ->countAllResults();

    // 3. Hitung Siswa Aktif
    $totalSiswa = $db->table('users')
                     ->where('role', 'user') 
                     ->where('status', 'aktif')
                     ->countAllResults();

    // 4. Ambil Peminjaman yang akan segera berakhir
    $deadlineAlert = date('Y-m-d', strtotime('+3 hours'));

    $aktivitasMendesak = $db->table('peminjaman')
        // PERBAIKAN: Tambahkan users.kelas di select agar tidak Undefined Index
        ->select('peminjaman.*, buku.judul, users.nama, users.kelas') 
        ->join('buku', 'buku.id_buku = peminjaman.id_buku')
        ->join('users', 'users.id_user = peminjaman.id_user')
        ->where('peminjaman.status', 'dipinjam')
        ->where('peminjaman.tanggal_kembali <=', $deadlineAlert)
        ->orderBy('peminjaman.tanggal_kembali', 'ASC')
        ->limit(5)
        ->get()->getResultArray();

    // 5. Kirim data ke view (Cukup satu return saja)
    $data = [
        'title'         => 'Dashboard PustakaKita',
        'totalBuku'     => $totalBuku,
        'totalDipinjam' => $totalDipinjam,
        'totalSiswa'    => $totalSiswa,
        'aktivitas'     => $aktivitasMendesak
    ];

    return view('dashboard/index', $data);
}
}