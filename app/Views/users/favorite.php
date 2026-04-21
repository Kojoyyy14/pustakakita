<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Buku Favorite Saya</h2>
            <p class="text-muted">Kumpulan buku yang kamu simpan untuk dibaca nanti.</p>
        </div>
        <a href="<?= base_url('buku') ?>" class="btn btn-outline-primary rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Katalog
        </a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
        <?php if (empty($buku_favorite)) : ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-bookmark-heart text-muted display-1 opacity-25"></i>
                <p class="text-muted mt-3">Daftar favoritmu masih kosong. Yuk cari buku di katalog!</p>
            </div>
        <?php else : ?>
            <?php foreach ($buku_favorite as $bf) : ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm hover-top transition">
                        <div class="p-3">
                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center overflow-hidden" style="height: 200px;">
                                <?php if ($bf['cover'] && $bf['cover'] != 'default.jpg'): ?>
                                    <img src="<?= base_url('img/' . $bf['cover']) ?>" class="img-fluid" style="max-height: 100%; width: auto; object-fit: contain;">
                                <?php else: ?>
                                    <i class="bi bi-book text-secondary display-1"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <span class="badge bg-light text-primary mb-2"><?= $bf['kategori']; ?></span>
                            <h6 class="fw-bold text-truncate" title="<?= $bf['judul']; ?>"><?= $bf['judul']; ?></h6>
                            <p class="text-muted small mb-3"><?= $bf['penulis']; ?></p>
                            
                            <div class="d-grid">
                                <a href="<?= base_url('buku/detail/' . $bf['id_buku']) ?>" class="btn btn-sm btn-primary fw-bold">
                                    <i class="bi bi-eye me-1"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    .hover-top { transition: all 0.3s ease; }
    .hover-top:hover { transform: translateY(-5px); box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1) !important; }
</style>
<?= $this->endSection() ?>