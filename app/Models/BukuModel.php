<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_buku';

    // Kolom yang boleh diisi
    protected $allowedFields = ['judul', 'kategori', 'stok'];

    // Aktifkan ini supaya create_at & update_at terisi otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'create_at'; 
    protected $updatedField  = 'update_at';
}