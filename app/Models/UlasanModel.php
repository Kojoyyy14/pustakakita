<?php

namespace App\Models;

use CodeIgniter\Model;

class UlasanModel extends Model
{
    protected $table            = 'ulasan_buku';
    protected $primaryKey       = 'id_ulasan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_buku', 'id_user', 'rating', 'ulasan', 'tanggal_ulasan', 'is_read_admin'];

    // Fungsi untuk mengambil ulasan berdasarkan ID Buku
    public function getUlasanByBuku($id_buku)
    {
        return $this->select('ulasan_buku.*, users.nama as nama_user')
                    ->join('users', 'users.id_user = ulasan_buku.id_user')
                    ->where('id_buku', $id_buku)
                    ->findAll();
    }
}