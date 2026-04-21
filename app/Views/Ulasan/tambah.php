<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Beri Ulasan: <?= $buku['judul'] ?></h5>
                    <form action="<?= base_url('ulasan/simpan') ?>" method="post">
                        <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Rating Bintang</label>
                            <select name="rating" class="form-select" required>
                                <option value="5">⭐⭐⭐⭐⭐ (Sangat Bagus)</option>
                                <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                                <option value="3">⭐⭐⭐ (Cukup)</option>
                                <option value="2">⭐⭐ (Kurang)</option>
                                <option value="1">⭐ (Buruk)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ulasan Anda</label>
                            <textarea name="ulasan" class="form-control" rows="4" placeholder="Tulis pendapatmu tentang buku ini..." required></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                            <a href="<?= base_url('buku') ?>" class="btn btn-light">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>