<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- Variabel Filter & Role ---
$authFilter = ['filter' => 'auth'];
$admin      = ['filter' => 'role:admin'];
$user       = ['filter' => 'role:user'];
$allRole    = ['filter' => 'role:admin,user'];

// --- Auth & System ---
$routes->get('/login', 'Auth::login');
$routes->post('/proses-login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');
$routes->get('/backup', 'Backup::index', $admin);
$routes->get('/restore', 'Restore::index', $admin);
$routes->post('/restore/auth', 'Restore::auth', $admin);
$routes->get('/restore/form', 'Restore::form', $admin);
$routes->post('/restore/process', 'Restore::process', $admin);

// --- Dashboard ---
$routes->get('/', 'Dashboard::index', $authFilter);
$routes->get('dashboard', 'Dashboard::index', $authFilter);

// --- Manajemen Buku (Upgrade Fitur) ---
$routes->group('buku', $authFilter, function($routes) {
    $routes->get('/', 'Buku::index'); // Katalog Utama
    
    // Fitur khusus Admin
    $routes->get('tambah', 'Buku::tambah', ['filter' => 'role:admin']);
    $routes->post('simpan', 'Buku::simpan', ['filter' => 'role:admin']);
    $routes->get('edit/(:num)', 'Buku::edit/$1', ['filter' => 'role:admin']); // Form Edit
    $routes->post('update/(:num)', 'Buku::update/$1', ['filter' => 'role:admin']); // Proses Update
    $routes->get('hapus/(:num)', 'Buku::hapus/$1', ['filter' => 'role:admin']); // Aksi Hapus via GET (agar simpel)
    $routes->get('detail/(:num)', 'Buku::detail/$1'); // Detail Buku
    
    // Fitur Anggota (Rating & Pengajuan)
    $routes->post('ajukan/(:num)', 'Buku::ajukan/$1', ['filter' => 'role:user']);
});

// --- Manajemen Users / Anggota ---
$routes->group('users', $allRole, function($routes) {
    $routes->get('/', 'Users::index'); //
    $routes->get('create', 'Users::create', ['filter' => 'role:admin']);
    $routes->post('store', 'Users::store', ['filter' => 'role:admin']);
    $routes->get('edit/(:num)', 'Users::edit/$1'); //
    $routes->post('update/(:num)', 'Users::update/$1');
    $routes->get('delete/(:num)', 'Users::delete/$1', ['filter' => 'role:admin']);
    $routes->get('detail/(:num)', 'Users::detail/$1');
    $routes->get('print', 'Users::print', ['filter' => 'role:admin']);
    $routes->get('wa/(:num)', 'Users::wa/$1');
});

// --- Transaksi Peminjaman & Pengembalian ---
$routes->group('peminjaman', $authFilter, function($routes) {
    $routes->get('/', 'Peminjaman::index');
    $routes->get('tambah', 'Peminjaman::tambah');
    $routes->post('simpan', 'Peminjaman::simpan');
    $routes->post('simpan_permohonan', 'Peminjaman::simpan_permohonan');
    $routes->get('detail/(:num)', 'Peminjaman::detail/$1');
    $routes->get('konfirmasi/(:num)/(:any)', 'Peminjaman::konfirmasi/$1/$2', ['filter' => 'role:admin']);
    
    // Pengembalian
    $routes->get('proses_kembali/(:num)', 'Peminjaman::proses_kembali/$1');
    $routes->post('proses_kembali/(:num)', 'Peminjaman::proses_kembali/$1');
});

// --- Fitur Baru: Ulasan & Rating ---
$routes->group('ulasan', $authFilter, function($routes) {
    $routes->get('tambah/(:num)', 'Ulasan::tambah/$1'); // Form ulasan per id_buku
    $routes->post('simpan', 'Ulasan::simpan'); // Aksi simpan ulasan
});

// --- Laporan ---
$routes->get('laporan', 'Laporan::index', $admin);
$routes->get('laporan/filter', 'Laporan::filter', $admin);
$routes->get('pengembalian', 'Pengembalian::index', $admin);