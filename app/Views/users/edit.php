<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="container-fluid py-4" style="background-color: #f8f9fc; min-height: 100vh; font-family: 'Inter', sans-serif;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="mb-4">
                <h4 class="fw-bold text-dark mb-1">Edit Profil Pengguna</h4>
                <p class="text-muted small">Perbarui informasi akun dan hak akses pengguna di sini.</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-4 bg-light d-flex align-items-center justify-content-center border-end p-4">
                        <div class="text-center">
                            <div class="position-relative d-inline-block mb-3">
                                <img src="<?= base_url('uploads/users/' . ($user['foto'] ?: 'default.jpg')) ?>" 
                                     class="rounded-circle shadow-sm border border-4 border-white" 
                                     style="width: 150px; height: 150px; object-fit: cover;"
                                     id="preview-foto">
                                <span class="position-absolute bottom-0 end-0 p-2 bg-primary border border-white border-3 rounded-circle text-white">
                                    <i class="bi bi-camera-fill"></i>
                                </span>
                            </div>
                            <h6 class="fw-bold mb-0"><?= $user['nama'] ?></h6>
                            <small class="text-muted">@<?= $user['username'] ?></small>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card-body p-4">
                            <form action="<?= base_url('users/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">
                                
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                                        <input type="text" name="nama" class="form-control rounded-3" value="<?= $user['nama'] ?>" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">EMAIL</label>
                                        <input type="email" name="email" class="form-control rounded-3" value="<?= $user['email'] ?>" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">USERNAME</label>
                                        <input type="text" name="username" class="form-control rounded-3" value="<?= $user['username'] ?>" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">PASSWORD</label>
                                        <input type="password" name="password" class="form-control rounded-3" placeholder="Isi hanya jika ingin diubah">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-muted">ROLE / HAK AKSES</label>
                                        <select name="role" class="form-select rounded-3 shadow-none">
                                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Administrator</option>
                                            <option value="petugas" <?= $user['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
                                            <option value="anggota" <?= $user['role'] == 'anggota' ? 'selected' : '' ?>>Anggota</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label small fw-bold text-muted">UNGGAH FOTO BARU</label>
                                        <input type="file" name="foto" class="form-control rounded-3" accept="image/*" onchange="previewImg(this)">
                                        <div class="form-text smaller">Format: JPG, PNG (Maks. 2MB). Kosongkan jika tidak ingin mengubah foto.</div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 border-top d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill fw-bold shadow-sm">
                                        <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                                    </button>
                                    
                                    <?php if (session()->get('role') == 'admin') : ?>
                                        <a href="<?= base_url('users') ?>" class="btn btn-light px-4 rounded-pill border fw-bold text-muted">Batal</a>
                                    <?php else : ?>
                                        <a href="<?= base_url('dashboard') ?>" class="btn btn-light px-4 rounded-pill border fw-bold text-muted">Batal</a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-label { letter-spacing: 0.5px; }
    .form-control:focus, .form-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1);
    }
    .smaller { font-size: 11px; }
</style>

<script>
    function previewImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-foto').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?= $this->endSection() ?>