<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;
use App\Models\UsersModel;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;
    protected $bukuModel;
    protected $usersModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->bukuModel = new BukuModel();
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        
        // Ambil data peminjaman dengan join ke buku dan users
        $builder = $db->table('peminjaman');
        $builder->select('peminjaman.*, buku.judul, users.nama');
        $builder->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $builder->join('users', 'users.id_user = peminjaman.id_user');
        $builder->orderBy('peminjaman.id_pinjam', 'DESC');
        
        $data = [
            'title'      => 'Daftar Transaksi Peminjaman',
            'peminjaman' => $builder->get()->getResultArray()
        ];

        return view('peminjaman/index', $data);
    }

    public function konfirmasi($id, $aksi)
    {
        // Hanya Admin yang boleh mengakses fungsi ini
        if (session()->get('role') != 'admin') {
            return redirect()->to('/buku')->with('error', 'Akses ditolak!');
        }

        $dataPinjam = $this->peminjamanModel->find($id);
        if (!$dataPinjam) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        if ($aksi == 'setuju') {
            $this->peminjamanModel->update($id, [
                'status'         => 'dipinjam',
                'tanggal_pinjam' => date('Y-m-d H:i:s'),
            ]);

            // Stok berkurang otomatis saat disetujui
            $buku = $this->bukuModel->find($dataPinjam['id_buku']);
            $this->bukuModel->update($dataPinjam['id_buku'], [
                'stok' => $buku['stok'] - 1
            ]);

            $pesan = 'Peminjaman disetujui.';
        } else {
            $this->peminjamanModel->update($id, ['status' => 'ditolak']);
            $pesan = 'Pengajuan ditolak.';
        }

        return redirect()->to('/peminjaman')->with('success', $pesan);
    }

    public function tambah()
    {
        // Jika Anda belum punya UserModel, buat dulu atau gunakan query manual
        $userModel = new \App\Models\UsersModel(); 

        $data = [
            'title' => 'Form Peminjaman Baru',
            'users' => $userModel->findAll(), // Mengambil data user untuk dropdown
            'buku'  => $this->bukuModel->where('stok >', 0)->findAll() // Hanya buku yang ada stok
        ];
        return view('peminjaman/tambah', $data);
    }

    public function proses_kembali($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->back()->with('error', 'Hanya admin yang bisa memproses pengembalian.');
        }

        $dataPinjam = $this->peminjamanModel->find($id);
        
        // Menangkap nilai denda dari input form (Jika kosong otomatis 0)
        $denda = $this->request->getPost('denda') ?? 0;

        $this->peminjamanModel->update($id, [
            'tanggal_kembali' => date('Y-m-d H:i:s'),
            'status'          => 'dikembalikan',
            'denda'           => $denda // Menyimpan nominal denda ke database
        ]);

        // Kembalikan stok buku
        $buku = $this->bukuModel->find($dataPinjam['id_buku']);
        $this->bukuModel->update($dataPinjam['id_buku'], [
            'stok' => $buku['stok'] + 1
        ]);

        return redirect()->to('/peminjaman')->with('success', 'Buku telah dikembalikan. Denda dicatat: Rp' . number_format($denda));
    }
}