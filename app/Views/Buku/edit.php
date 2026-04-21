<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-0">
                    <div class="d-flex align-items-center">
                        <a href="<?= base_url('buku') ?>" class="btn btn-sm btn-light me-3">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                        <h5 class="fw-bold mb-0">Edit Data Buku</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="coverLama" value="<?= $buku['cover']; ?>">

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Judul Buku</label>
                                <input type="text" name="judul" class="form-control" value="<?= $buku['judul']; ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Penulis</label>
                                <input type="text" name="penulis" class="form-control" value="<?= $buku['penulis']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" value="<?= $buku['penerbit']; ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">ISBN</label>
                                <input type="text" name="isbn" class="form-control" value="<?= $buku['isbn']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" class="form-control" value="<?= $buku['tahun_terbit']; ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kategori</label>
                                <select name="kategori" class="form-select">
                                    <?php $list_kategori = ['Sains', 'Matematika', 'Sejarah', 'Sastra', 'Islam', 'Teknologi', 'Biologi', 'Kimia', 'Hukum']; ?>
                                    <?php foreach ($list_kategori as $kat) : ?>
                                        <option value="<?= $kat; ?>" <?= ($buku['kategori'] == $kat) ? 'selected' : ''; ?>><?= $kat; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jumlah Stok</label>
                                <input type="number" name="stok" class="form-control" value="<?= $buku['stok']; ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Ukuran Buku</label>
                                <input type="text" name="ukuran_buku" class="form-control" value="<?= $buku['ukuran_buku']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Halaman</label>
                                <input type="number" name="halaman" class="form-control" value="<?= $buku['halaman']; ?>">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Ganti Cover (Kosongkan jika tidak ingin diubah)</label>
                                <div class="d-flex gap-3 align-items-start">
                                    <img src="<?= base_url('img/' . $buku['cover']) ?>" class="img-thumbnail" style="width: 100px;">
                                    <input type="file" name="cover" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-grid">
                            <button type="submit" class="btn btn-primary py-2 fw-bold">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>