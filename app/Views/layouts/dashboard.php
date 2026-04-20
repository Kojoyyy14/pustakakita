<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4" style="background-color: #f8f9fa; min-height: 100vh;">
    
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h2 class="fw-bold text-dark mb-1">Dashboard</h2>
            <p class="text-muted small">Ringkasan aktivitas perpustakaan hari ini.</p>
        </div>
        <div class="col-auto">
            <div class="bg-white px-3 py-2 rounded-3 shadow-sm border small fw-bold text-primary">
                <i class="bi bi-calendar3 me-2"></i> <?= date('d F Y') ?>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <?php 
        $stats = [
            ['title' => 'Total Koleksi', 'val' => '1,240', 'icon' => 'bi-book', 'bg' => '#4e73df'],
            ['title' => 'Dipinjam', 'val' => '45', 'icon' => 'bi-journal-check', 'bg' => '#f6c23e'],
            ['title' => 'Siswa Aktif', 'val' => '850', 'icon' => 'bi-people', 'bg' => '#36b9cc'],
            ['title' => 'Terlambat', 'val' => '8', 'icon' => 'bi-exclamation-circle', 'bg' => '#e74a3b']
        ];
        foreach ($stats as $s) : ?>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-uppercase mb-1 text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">
                                <?= $s['title'] ?>
                            </div>
                            <div class="h3 mb-0 fw-bold text-dark"><?= $s['val'] ?></div>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; background-color: <?= $s['bg'] ?>; color: white;">
                            <i class="bi <?= $s['icon'] ?> fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Aktivitas Terkini</h5>
                    <span class="badge bg-light text-primary border px-3 py-2 rounded-pill">Real-time</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr class="text-muted border-bottom" style="font-size: 0.85rem;">
                                    <th class="ps-4 py-3 fw-normal">Siswa</th>
                                    <th class="py-3 fw-normal">Judul Buku</th>
                                    <th class="py-3 fw-normal">Status</th>
                                    <th class="py-3 text-center fw-normal">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom-0">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Andi+Wijaya&background=random" class="rounded-circle me-3" width="35">
                                            <div>
                                                <div class="fw-bold mb-0">Andi Wijaya</div>
                                                <small class="text-muted">Kelas XII-IPA</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-dark fw-medium">Dasar Pemrograman PHP</span></td>
                                    <td><span class="badge bg-success-subtle text-success px-3 py-2">Selesai</span></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('peminjaman/detail/1') ?>" class="btn btn-sm btn-light rounded-3 shadow-xs">Lihat</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=random" class="rounded-circle me-3" width="35">
                                            <div>
                                                <div class="fw-bold mb-0">Siti Aminah</div>
                                                <small class="text-muted">Kelas XI-IPS</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-dark fw-medium">Matematika Kelas X</span></td>
                                    <td><span class="badge bg-warning-subtle text-warning px-3 py-2">Dipinjam</span></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('peminjaman/detail/2') ?>" class="btn btn-sm btn-light rounded-3 shadow-xs">Lihat</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 text-center pb-4">
                    <a href="<?= base_url('peminjaman') ?>" class="text-decoration-none small fw-bold">Lihat Semua Aktivitas <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Navigasi Cepat</h5>
                    
                    <a href="<?= base_url('peminjaman/tambah') ?>" class="nav-shortcut mb-3">
                        <div class="icon-box bg-primary text-white"><i class="bi bi-plus-lg"></i></div>
                        <div class="ms-3 text-dark fw-bold">Pinjaman Baru</div>
                    </a>

                    <?php if (session()->get('role') == 'admin') : ?>
                    <a href="<?= base_url('buku/tambah') ?>" class="nav-shortcut mb-3">
                        <div class="icon-box bg-dark text-white"><i class="bi bi-book"></i></div>
                        <div class="ms-3 text-dark fw-bold">Update Koleksi</div>
                    </a>
                    <?php endif; ?>

                    <a href="<?= base_url('laporan') ?>" class="nav-shortcut">
                        <div class="icon-box bg-info text-white"><i class="bi bi-file-earmark-text"></i></div>
                        <div class="ms-3 text-dark fw-bold">Cetak Laporan</div>
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 bg-dark text-white p-4 position-relative overflow-hidden">
                <div class="position-relative" style="z-index: 2;">
                    <h6 class="fw-bold">Butuh Bantuan?</h6>
                    <p class="small opacity-75 mb-0">Jika ada kendala pada sistem, hubungi administrator IT.</p>
                </div>
                <i class="bi bi-question-circle position-absolute end-0 bottom-0 mb-n2 me-n2 opacity-25" style="font-size: 5rem;"></i>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap');
    
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    .rounded-4 { border-radius: 1.2rem !important; }
    .bg-success-subtle { background-color: #d1e7dd !important; }
    .bg-warning-subtle { background-color: #fff3cd !important; }
    
    .nav-shortcut {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-radius: 1rem;
        background: #fdfdfd;
        border: 1px solid #f0f0f0;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .nav-shortcut:hover {
        background: #f8f9fa;
        transform: translateX(5px);
        border-color: #ddd;
    }
    
    .icon-box {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
</style>
<?= $this->endSection() ?>