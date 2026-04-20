<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_pinjam';
    protected $allowedFields = ['id_pinjam', 'id_buku', 'durasi', 'id_user', 'denda', 'status', 'tanggal_pinjam', 'tanggal_kembali'];
}