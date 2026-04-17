<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="fw-bold mb-0">Form Tambah Buku</h5>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('buku/simpan') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold">Judul Buku</label>
                            <input type="text" name="judul" class="form-control" required placeholder="Masukkan judul lengkap">
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold">Penulis</label>
                            <input type="text" name="penulis" class="form-control" required placeholder="Nama pengarang">
                        </div>
                        <div class="row text-start">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Kategori</label>
                                <select name="kategori" class="form-select">
                                    <option value="Sains">Sains</option>
                                    <option value="Matematika">Matematika</option>
                                    <option value="Sejarah">Sejarah</option>
                                    <option value="Sastra">Sastra</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Jumlah Stok</label>
                                <input type="number" name="stok" class="form-control" required min="1" value="1">
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Simpan Buku</button>
                            <a href="<?= base_url('buku') ?>" class="btn btn-light px-4 border">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>