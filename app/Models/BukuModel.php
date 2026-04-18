<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_buku';

    // app/Models/BukuModel.php
protected $allowedFields = [
    'judul', 'penulis', 'penerbit', 'isbn', 
    'tahun_terbit', 'ukuran_buku', 'halaman', 
    'kategori', 'stok', 'cover'
];
    // ... (kode lainnya tetap biarkan saja)
}