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
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
        <?php foreach ($buku as $b) : ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm hover-top transition">
                    <div class="position-relative p-3">
                        <span class="badge bg-info position-absolute top-0 start-0 mt-4 ms-4 shadow-sm" style="z-index: 5;"><?= $b['kategori']; ?></span>
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
                        <p class="text-muted small mb-2 text-truncate"><?= $b['penulis'] ?? 'Penulis Anonim'; ?> | <?= $b['penerbit'] ?? '-'; ?></p>

                        <div class="bg-light p-2 rounded-2 mb-3" style="font-size: 0.7rem; line-height: 1.4;">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">ISBN:</span> <span class="fw-bold"><?= $b['isbn'] ?: '-'; ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Tahun:</span> <span class="fw-bold"><?= $b['tahun_terbit'] ?: '-'; ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Ukuran:</span> <span class="fw-bold"><?= $b['ukuran_buku'] ?: '-'; ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Halaman:</span> <span class="fw-bold"><?= $b['halaman'] ?: '0'; ?> hlm</span>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="text-warning small d-flex align-items-center">
                                <?php 
                                    // Hitung bintang secara dinamis
                                    $rating_angka = isset($b['rata_rating']) ? round($b['rata_rating']) : 0;
                                    for($i=1; $i<=5; $i++):
                                ?>
                                    <i class="bi <?= ($i <= $rating_angka) ? 'bi-star-fill' : 'bi-star text-muted opacity-50' ?>"></i>
                                <?php endfor; ?>
                                <span class="text-muted ms-1" style="font-size: 0.75rem;">(<?= isset($b['rata_rating']) ? number_format($b['rata_rating'], 1) : '0'; ?>)</span>
                            </div>
                            <span class="badge bg-light text-success border border-success border-opacity-25">Stok: <?= $b['stok']; ?></span>
                        </div>

                        <div class="d-grid gap-2">
                            <?php if (session()->get('role') == 'admin') : ?>
                                <div class="d-flex gap-1">
                                    <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>" class="btn btn-sm btn-warning flex-grow-1 text-white fw-bold">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="<?= base_url('buku/hapus/' . $b['id_buku']) ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                                <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>" class="btn btn-sm btn-outline-primary border-2 fw-bold">
                                    <i class="bi bi-info-circle"></i> Detail Buku
                                </a>
                            <?php else : ?>
                                <?php 
                                    $db = \Config\Database::connect();
                                    $isPending = $db->table('peminjaman')->where('id_buku', $b['id_buku'])->where('id_user', session()->get('id_user'))->whereIn('status', ['pending', 'dipinjam'])->get()->getRow();
                                    
                                    // Cek apakah user sudah pernah pinjam & kembali untuk kasih ulasan
                                    $canReview = $db->table('peminjaman')->where('id_buku', $b['id_buku'])->where('id_user', session()->get('id_user'))->where('status', 'dikembalikan')->get()->getRow();
                                ?>
                                
                                <?php if ($isPending) : ?>
                                    <button class="btn btn-sm btn-warning disabled fw-bold">
                                        <i class="bi bi-clock-history me-1"></i> <?= ($isPending->status == 'pending') ? 'Menunggu' : 'Sedang Dipinjam'; ?>
                                    </button>
                                <?php elseif ($b['stok'] <= 0) : ?>
                                    <button class="btn btn-sm btn-secondary disabled fw-bold">Stok Habis</button>
                                <?php else : ?>
                                    <button type="button" class="btn btn-sm btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalPinjam<?= $b['id_buku'] ?>">
                                        <i class="bi bi-journal-plus me-1"></i> Pinjam Sekarang
                                    </button>
                                <?php endif; ?>

                                <?php if ($canReview) : ?>
                                    <a href="<?= base_url('ulasan/tambah/' . $b['id_buku']) ?>" class="btn btn-sm btn-outline-info fw-bold">
                                        <i class="bi bi-chat-left-text me-1"></i> Beri Ulasan
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if (session()->get('role') != 'admin' && isset($isPending) && !$isPending && $b['stok'] > 0) : ?>
                <div class="modal fade" id="modalPinjam<?= $b['id_buku'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content border-0 shadow">
                            <form action="<?= base_url('buku/ajukan/' . $b['id_buku']) ?>" method="post">
                                <div class="modal-header border-0 pb-0">
                                    <h6 class="modal-title fw-bold">Konfirmasi Pinjam</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="small text-muted mb-3">Berapa lama ingin meminjam buku <strong>"<?= $b['judul'] ?>"</strong>?</p>
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold">Rencana Durasi</label>
                                        <input type="text" name="durasi_pinjam" class="form-control form-control-sm" placeholder="Contoh: 3 hari" required>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 pt-0">
                                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Kirim Permohonan</button>
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
    .bg-info { background-color: #0ea5e9 !important; }
    .text-warning { color: #f59e0b !important; }
    .transition { transition: all 0.3s ease-in-out; }
</style>
<?= $this->endSection() ?>