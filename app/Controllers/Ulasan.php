<?php

namespace App\Controllers;

use App\Models\UlasanModel;
use App\Models\BukuModel;

class Ulasan extends BaseController
{
    protected $ulasanModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->ulasanModel = new UlasanModel();
        $this->bukuModel = new BukuModel();
    }

    // Menampilkan halaman form ulasan
    public function tambah($id_buku)
    {
        $data = [
            'title' => 'Beri Ulasan Buku',
            'buku'  => $this->bukuModel->find($id_buku)
        ];
        return view('ulasan/tambah', $data);
    }

    // Menyimpan ulasan ke database
    public function simpan()
    {
        $id_buku = $this->request->getPost('id_buku');
        
        $this->ulasanModel->save([
            'id_buku' => $id_buku,
            'id_user' => session()->get('id_user'),
            'rating'  => $this->request->getPost('rating'),
            'ulasan'  => $this->request->getPost('ulasan'),
        ]);

        return redirect()->to('/buku')->with('success', 'Terima kasih atas ulasan Anda!');
    }
}