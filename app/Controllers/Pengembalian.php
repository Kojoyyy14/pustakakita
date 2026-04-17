<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;

class Pengembalian extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

 public function index()
{
    $db      = \Config\Database::connect();
    $builder = $db->table('peminjaman');
    $builder->select('peminjaman.*, buku.judul, users.nama');
    
    // Gunakan 'left' agar data peminjaman tidak hilang jika relasi error
    $builder->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left');
    $builder->join('users', 'users.id_user = peminjaman.id_user', 'left');

    $data = [
        'title'      => 'Data Pengembalian',
        'peminjaman' => $builder->get()->getResultArray(),
        'intRole'    => session()->get('role')
    ];

    return view('pengembalian/index', $data);
}

}