<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm col-lg-8 mx-auto">
        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">Form Peminjaman Baru</h5>
        </div>
        <div class="card-body">
            <form action="<?= base_url('peminjaman/simpan') ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Pilih Siswa/Anggota</label>
                    <select name="id_user" class="form-select" required>
                        <option value="">-- Pilih Siswa --</option>
                        <?php foreach($users as $u): ?>
                            <option value="<?= $u['id_user'] ?>"><?= $u['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Pilih Buku</label>
                    <select name="id_buku" class="form-select" required>
                        <option value="">-- Pilih Buku --</option>
                        <?php foreach($buku as $b): ?>
                            <option value="<?= $b['id_buku'] ?>"><?= $b['judul'] ?> (Stok: <?= $b['stok'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Pinjaman</button>
                    <a href="<?= base_url('/') ?>" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>