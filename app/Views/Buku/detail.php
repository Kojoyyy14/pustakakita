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

                    <div class="row g-4">
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
</div>
<?= $this->endSection() ?>