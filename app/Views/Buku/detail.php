<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="mb-4">
        <a href="<?= base_url('buku') ?>" class="btn btn-light shadow-sm">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Katalog
        </a>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="row g-0">
            <div class="col-md-4 bg-light d-flex align-items-center justify-content-center p-4">
                <?php if ($buku['cover'] && $buku['cover'] != 'default.jpg'): ?>
                    <img src="<?= base_url('img/' . $buku['cover']) ?>" class="img-fluid rounded shadow" style="max-height: 450px;">
                <?php else: ?>
                    <i class="bi bi-book text-secondary display-1"></i>
                <?php endif; ?>
            </div>

            <div class="col-md-8">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-info mb-2"><?= $buku['kategori']; ?></span>
                            <h1 class="fw-bold"><?= $buku['judul']; ?></h1>
                            <p class="text-muted fs-5">Oleh: <span class="text-dark fw-semibold"><?= $buku['penulis']; ?></span></p>
                        </div>
                        <?php if (session()->get('role') == 'admin') : ?>
                            <a href="<?= base_url('buku/edit/' . $buku['id_buku']) ?>" class="btn btn-warning text-white">
                                <i class="bi bi-pencil-square me-1"></i> Edit Buku
                            </a>
                        <?php endif; ?>
                    </div>

                    <hr class="my-4">

                    <div class="row g-4 text-break">
                        <div class="col-sm-6">
                            <label class="text-muted small d-block">Penerbit</label>
                            <p class="fw-bold"><?= $buku['penerbit'] ?: '-'; ?></p>
                        </div>
                        <div class="col-sm-6">
                            <label class="text-muted small d-block">ISBN</label>
                            <p class="fw-bold"><?= $buku['isbn'] ?: '-'; ?></p>
                        </div>
                        <div class="col-sm-6">
                            <label class="text-muted small d-block">Tahun Terbit</label>
                            <p class="fw-bold"><?= $buku['tahun_terbit'] ?: '-'; ?></p>
                        </div>
                        <div class="col-sm-6">
                            <label class="text-muted small d-block">Jumlah Halaman</label>
                            <p class="fw-bold"><?= $buku['halaman'] ?: '0'; ?> Halaman</p>
                        </div>
                        <div class="col-sm-6">
                            <label class="text-muted small d-block">Ukuran Buku</label>
                            <p class="fw-bold"><?= $buku['ukuran_buku'] ?: '-'; ?></p>
                        </div>
                        <div class="col-sm-6">
                            <label class="text-muted small d-block">Status Ketersediaan</label>
                            <span class="badge <?= $buku['stok'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                <?= $buku['stok'] > 0 ? 'Tersedia (' . $buku['stok'] . ')' : 'Stok Habis' ?>
                            </span>
                        </div>
                    </div>

                    <?php if (session()->get('role') != 'admin' && $buku['stok'] > 0) : ?>
                        <div class="mt-5">
                            <button class="btn btn-primary btn-lg px-5 shadow" data-bs-toggle="modal" data-bs-target="#modalPinjam<?= $buku['id_buku'] ?>">
                                <i class="bi bi-journal-plus me-2"></i> Pinjam Buku Ini
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 px-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold m-0"><i class="bi bi-star-fill text-warning me-2"></i>Ulasan Pengguna</h4>
            <?php if (session()->get('role') == 'user') : ?>
                <a href="<?= base_url('ulasan/tambah/' . $buku['id_buku']) ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                    Beri Ulasan
                </a>
            <?php endif; ?>
        </div>
        
        <?php if (empty($ulasan)) : ?>
            <div class="text-center py-5 bg-white rounded shadow-sm border">
                <i class="bi bi-chat-left-dots text-muted display-4 mb-3 d-block"></i>
                <p class="text-muted">Belum ada ulasan untuk buku ini. Jadilah yang pertama memberikan ulasan!</p>
            </div>
        <?php else : ?>
            <div class="row row-cols-1 row-cols-md-2 g-3">
                <?php foreach ($ulasan as $u) : ?>
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6 class="fw-bold mb-0 text-primary"><?= $u['nama_user']; ?></h6>
                                    <small class="text-muted small"><?= date('d/m/Y', strtotime($u['tanggal_ulasan'])); ?></small>
                                </div>
                                
                                <div class="mb-2">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <i class="bi <?= $i <= $u['rating'] ? 'bi-star-fill text-warning' : 'bi-star text-secondary'; ?> small"></i>
                                    <?php endfor; ?>
                                </div>
                                
                                <p class="card-text text-dark small mb-0">
                                    "<?= htmlspecialchars($u['ulasan']); ?>"
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>