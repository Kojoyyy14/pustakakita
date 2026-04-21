<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Katalog Buku</h2>
            <p class="text-muted">Temukan referensi bacaan untuk mendukung belajarmu.</p>
        </div>
        <div class="d-flex gap-2">
            <form action="<?= base_url('buku') ?>" method="get" class="input-group" style="width: 300px;">
                <?php if (request()->getGet('kategori')) : ?>
                    <input type="hidden" name="kategori" value="<?= request()->getGet('kategori') ?>">
                <?php endif; ?>
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" name="keyword" class="form-control border-start-0" 
                       placeholder="Cari buku favoritmu..." value="<?= request()->getGet('keyword') ?>">
            </form>

            <?php if (session()->get('role') == 'admin') : ?>
                <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary px-4 shadow-sm">
                    <i class="bi bi-plus-lg me-2"></i> Tambah Buku
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="mb-4">
        <h6 class="fw-bold mb-3">Pilih Kategori:</h6>
        <div class="d-flex gap-2 overflow-auto pb-2" style="white-space: nowrap;">
            <?php 
                $kat_aktif = request()->getGet('kategori'); 
                $keyword = request()->getGet('keyword');
            ?>
            <a href="<?= base_url('buku' . ($keyword ? '?keyword='.$keyword : '')) ?>" 
               class="btn <?= empty($kat_aktif) ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill px-4 shadow-sm">
               Semua
            </a>
            
            <?php 
            $list_kategori = ['Sains', 'Matematika', 'Sejarah', 'Sastra', 'Islam', 'Teknologi', 'Biologi', 'Kimia', 'Hukum'];
            foreach ($list_kategori as $kat) : 
                $url = base_url("buku?kategori=$kat" . ($keyword ? "&keyword=$keyword" : ""));
            ?>
                <a href="<?= $url ?>" 
                   class="btn <?= ($kat_aktif == $kat) ? 'btn-primary' : 'btn-outline-secondary' ?> rounded-pill px-4 shadow-sm">
                     <?= $kat ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
        <?php foreach ($buku as $b) : ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm hover-top transition">
                    <div class="position-relative p-3">
                        <span class="badge bg-info position-absolute top-0 start-0 mt-4 ms-4 shadow-sm" style="z-index: 5;"><?= $b['kategori']; ?></span>
                        
                        <?php if (session()->get('role') != 'admin') : ?>
                            <a href="<?= base_url('favorite/tambah/' . $b['id_buku']) ?>" 
                               class="btn btn-white btn-sm position-absolute top-0 end-0 mt-4 me-4 shadow-sm rounded-circle d-flex align-items-center justify-content-center favorit-btn" 
                               style="z-index: 5; width: 35px; height: 35px;"
                               title="Tambah ke Favorit">
                                <i class="bi bi-heart-fill text-danger"></i>
                            </a>
                        <?php endif; ?>

                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center overflow-hidden" style="height: 250px;">
                            <?php if ($b['cover'] && $b['cover'] != 'default.jpg'): ?>
                                <img src="<?= base_url('img/' . $b['cover']) ?>" class="img-fluid" style="max-height: 100%; width: auto; object-fit: contain;">
                            <?php else: ?>
                                <i class="bi bi-book text-secondary display-1"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <h6 class="fw-bold mb-1 text-truncate" title="<?= $b['judul']; ?>"><?= $b['judul']; ?></h6>
                        <p class="text-muted small mb-2 text-truncate"><?= $b['penulis'] ?? 'Penulis Anonim'; ?></p>

                        <div class="bg-light p-2 rounded-2 mb-3" style="font-size: 0.7rem; line-height: 1.4;">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Tahun:</span> <span class="fw-bold"><?= $b['tahun_terbit'] ?: '-'; ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Stok:</span> <span class="fw-bold <?= $b['stok'] <= 0 ? 'text-danger' : 'text-success' ?>"><?= $b['stok']; ?></span>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="text-warning small d-flex align-items-center">
                                <?php 
                                    $rating_angka = isset($b['rata_rating']) ? round($b['rata_rating']) : 0;
                                    for($i=1; $i<=5; $i++):
                                ?>
                                    <i class="bi <?= ($i <= $rating_angka) ? 'bi-star-fill' : 'bi-star text-muted opacity-50' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>" class="text-primary small fw-bold text-decoration-none">Detail <i class="bi bi-chevron-right"></i></a>
                        </div>

                        <div class="d-grid gap-2">
                            <?php if (session()->get('role') == 'admin') : ?>
                                <div class="d-flex gap-1">
                                    <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>" class="btn btn-sm btn-warning flex-grow-1 text-white fw-bold">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="<?= base_url('buku/hapus/' . $b['id_buku']) ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Hapus buku ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            <?php else : ?>
                                <?php 
                                    $db = \Config\Database::connect();
                                    $peminjaman = $db->table('peminjaman')
                                        ->where('id_buku', $b['id_buku'])
                                        ->where('id_user', session()->get('id_user'))
                                        ->whereIn('status', ['pending', 'dipinjam'])
                                        ->get()->getRow();
                                ?>
                                
                                <?php if ($peminjaman) : ?>
                                    <button class="btn btn-sm btn-warning disabled fw-bold shadow-sm">
                                        <i class="bi bi-clock-history me-1"></i> <?= ($peminjaman->status == 'pending') ? 'Menunggu' : 'Dipinjam'; ?>
                                    </button>
                                <?php elseif ($b['stok'] <= 0) : ?>
                                    <button class="btn btn-sm btn-secondary disabled fw-bold">Stok Habis</button>
                                <?php else : ?>
                                    <button type="button" class="btn btn-sm btn-primary fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalPinjam<?= $b['id_buku'] ?>">
                                        <i class="bi bi-journal-plus me-1"></i> Pinjam Buku
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if (session()->get('role') != 'admin' && $b['stok'] > 0) : ?>
                <div class="modal fade" id="modalPinjam<?= $b['id_buku'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content border-0 shadow">
                            <form action="<?= base_url('peminjaman/simpan') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id_buku" value="<?= $b['id_buku'] ?>">
                                <div class="modal-header border-0 pb-0">
                                    <h6 class="modal-title fw-bold">Konfirmasi Pinjam</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small text-muted mb-3">Mau pinjam <strong>"<?= $b['judul'] ?>"</strong> berapa lama?</p>
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold">Durasi (Hari)</label>
                                        <input type="number" name="durasi_pinjam" class="form-control form-control-sm" placeholder="Contoh: 7" required min="1">
                                    </div>
                                </div>
                                <div class="modal-footer border-0 pt-0">
                                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-sm btn-primary px-3">Pinjam</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .hover-top { transition: all 0.3s ease; }
    .hover-top:hover { transform: translateY(-10px); box-shadow: 0 1rem 3rem rgba(0,0,0,.15) !important; }
    .btn-primary { background-color: #2563eb; border-color: #2563eb; }
    .transition { transition: all 0.3s ease-in-out; }
    
    /* Style khusus tombol favorit */
    .btn-white { 
        background-color: white; 
        border: 1px solid #f0f0f0;
    }
    .favorit-btn {
        transition: all 0.2s ease;
    }
    .favorit-btn:hover {
        transform: scale(1.15);
        background-color: #fff5f5;
        border-color: #ffc1c1;
    }
</style>
<?= $this->endSection() ?>