<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\PeminjamanModel;
use App\Models\UlasanModel;

class Buku extends BaseController
{
    protected $bukuModel;
    protected $peminjamanModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
        $this->peminjamanModel = new PeminjamanModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $kategori = $this->request->getGet('kategori');

        // Menggunakan Query Builder untuk Join Rating
        $builder = $this->bukuModel->builder();
        $builder->select('buku.*, AVG(ulasan_buku.rating) as rata_rating, COUNT(ulasan_buku.id_ulasan) as total_ulasan');
        $builder->join('ulasan_buku', 'ulasan_buku.id_buku = buku.id_buku', 'left');
        $builder->groupBy('buku.id_buku');

        if ($keyword) {
            $builder->like('buku.judul', $keyword);
        }

        if ($kategori) {
            $builder->where('buku.kategori', $kategori);
        }

        $data = [
            'title' => 'Katalog Buku',
            'buku'  => $builder->get()->getResultArray(),
            'kategori_aktif' => $kategori,
            'keyword' => $keyword
        ];

        return view('buku/index', $data);
    }

    // Tambahkan use model di bagian atas

public function detail($id)
{
    $ulasanModel = new UlasanModel();
    
    $data = [
        'title'  => 'Detail Buku',
        'buku'   => $this->bukuModel->find($id),
        // Ambil ulasan beserta nama user yang memberi ulasan
        'ulasan' => $ulasanModel->select('ulasan_buku.*, users.nama as nama_user')
                                ->join('users', 'users.id_user = ulasan_buku.id_user')
                                ->where('id_buku', $id)
                                ->orderBy('tanggal_ulasan', 'DESC')
                                ->findAll()
    ];

    if (empty($data['buku'])) {
        return redirect()->to('/buku')->with('error', 'Data buku tidak ditemukan.');
    }

    return view('buku/detail', $data);
} 

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Koleksi Buku Baru'
        ];
        return view('buku/tambah', $data);
    }

    public function simpan()
    {
        $fileCover = $this->request->getFile('cover');
        if ($fileCover && $fileCover->getError() == 4) {
            $namaCover = 'default.jpg';
        } else {
            $namaCover = $fileCover->getRandomName();
            $fileCover->move('img', $namaCover);
        }

        $this->bukuModel->save([
            'judul'        => $this->request->getPost('judul'),
            'penulis'      => $this->request->getPost('penulis'),
            'penerbit'     => $this->request->getPost('penerbit'), 
            'isbn'         => $this->request->getPost('isbn'),     
            'tahun_terbit' => $this->request->getPost('tahun_terbit'), 
            'ukuran_buku'  => $this->request->getPost('ukuran_buku'),   
            'halaman'      => $this->request->getPost('halaman'),     
            'kategori'     => $this->request->getPost('kategori'),
            'stok'         => $this->request->getPost('stok'),
            'cover'        => $namaCover
        ]);

        return redirect()->to('/buku')->with('success', 'Buku berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Buku',
            'buku'  => $this->bukuModel->find($id)
        ];
        return view('buku/edit', $data);
    }

    public function update($id)
    {
        $fileCover = $this->request->getFile('cover');
        $bukuLama = $this->bukuModel->find($id);

        if ($fileCover->getError() == 4) {
            $namaCover = $this->request->getPost('coverLama');
        } else {
            $namaCover = $fileCover->getRandomName();
            $fileCover->move('img', $namaCover);
            // Hapus file lama jika bukan default
            if ($bukuLama['cover'] != 'default.jpg' && file_exists('img/' . $bukuLama['cover'])) {
                unlink('img/' . $bukuLama['cover']);
            }
        }

        $this->bukuModel->update($id, [
            'judul'        => $this->request->getPost('judul'),
            'penulis'      => $this->request->getPost('penulis'),
            'penerbit'     => $this->request->getPost('penerbit'), 
            'isbn'         => $this->request->getPost('isbn'),     
            'tahun_terbit' => $this->request->getPost('tahun_terbit'), 
            'ukuran_buku'  => $this->request->getPost('ukuran_buku'),   
            'halaman'      => $this->request->getPost('halaman'),     
            'kategori'     => $this->request->getPost('kategori'),
            'stok'         => $this->request->getPost('stok'),
            'cover'        => $namaCover
        ]);

        return redirect()->to('/buku')->with('success', 'Data buku berhasil diubah.');
    }

    public function hapus($id)
    {
        $buku = $this->bukuModel->find($id);
        
        // Hapus gambar dari folder img
        if ($buku['cover'] != 'default.jpg' && file_exists('img/' . $buku['cover'])) {
            unlink('img/' . $buku['cover']);
        }

        $this->bukuModel->delete($id);
        return redirect()->to('/buku')->with('success', 'Buku berhasil dihapus.');
    }

    public function ajukan($id_buku)
    {
        $buku = $this->bukuModel->find($id_buku);

        if ($buku['stok'] > 0) {
            $durasiInput = $this->request->getPost('durasi_pinjam');

            $this->peminjamanModel->save([
                'id_user'           => session()->get('id_user'),
                'id_buku'           => $id_buku,
                'durasi'            => $durasiInput,
                'tanggal_pengajuan' => date('Y-m-d H:i:s'),
                'status'            => 'pending' 
            ]);

            $this->bukuModel->update($id_buku, [
                'stok' => $buku['stok'] - 1
            ]);

            return redirect()->to('/buku')->with('success', 'Berhasil mengajukan pinjaman.');
        } else {
            return redirect()->back()->with('error', 'Maaf, stok buku sudah habis!');
        }
    }
}