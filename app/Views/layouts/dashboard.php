<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="p-5 mb-4 bg-light rounded-3 shadow-sm border-start border-primary border-5">
                <div class="container-fluid py-2">
                    <h1 class="display-6 fw-bold">Selamat Datang di PustakaKita</h1>
                    <p class="col-md-8 fs-5 text-secondary">Sistem Informasi Manajemen Perpustakaan Sekolah. Pantau koleksi buku dan aktivitas peminjaman Anda dengan mudah.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted fw-normal">Total Koleksi</h6>
                            <h3 class="fw-bold mb-0">1,240</h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-bookshelf text-primary fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-success"><i class="bi bi-arrow-up"></i> 12 buku baru</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted fw-normal">Sedang Dipinjam</h6>
                            <h3 class="fw-bold mb-0">45</h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-journal-bookmark-fill text-warning fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="<?= base_url('peminjaman') ?>" class="text-muted text-decoration-none">
                            <small>Lihat daftar pinjaman <i class="bi bi-chevron-right"></i></small>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted fw-normal">Siswa Aktif</h6>
                            <h3 class="fw-bold mb-0">850</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-people-fill text-info fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">Dari total 900 siswa</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted fw-normal">Terlambat</h6>
                            <h3 class="fw-bold mb-0">8</h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="bi bi-exclamation-triangle-fill text-danger fs-3"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="<?= base_url('peminjaman?filter=terlambat') ?>" class="text-danger fw-bold text-decoration-none">
                            <small>Perlu Tindakan <i class="bi bi-arrow-right-short"></i></small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Aktivitas Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Nama Siswa</th>
                                    <th>Judul Buku</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4">Andi Wijaya</td>
                                    <td>Dasar Pemrograman PHP</td>
                                    <td><span class="badge bg-success">Kembali</span></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('peminjaman/detail/1') ?>" class="btn btn-sm btn-outline-primary px-3">Detail</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">Siti Aminah</td>
                                    <td>Matematika Kelas X</td>
                                    <td><span class="badge bg-warning text-dark">Dipinjam</span></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('peminjaman/detail/2') ?>" class="btn btn-sm btn-outline-primary px-3">Detail</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body p-4">
                    <h5 class="fw-bold">Pintasan Cepat</h5>
                    <div class="d-grid gap-2 mt-4">
                        <a href="<?= base_url('peminjaman/tambah') ?>" class="btn btn-light text-primary fw-bold text-start border-0">
    <i class="bi bi-plus-circle me-2"></i> Tambah Pinjaman Baru
</a>
                        <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary-light bg-white bg-opacity-10 text-white text-start border-0 py-2">
                            <i class="bi bi-plus-square me-2"></i> Tambah Koleksi Buku
                        </a>
                        <hr class="my-2 text-white opacity-25">
                        <a href="<?= base_url('laporan') ?>" class="btn btn-primary-light bg-white bg-opacity-10 text-white text-start border-0 py-2">
                            <i class="bi bi-file-earmark-pdf me-2"></i> Laporan Bulanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>