<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="container-fluid py-4" style="background-color: #f8f9fc; min-height: 100vh; font-family: 'Inter', sans-serif;">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Data Anggota</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb smaller mb-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manajemen Anggota</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
        <a href="<?= base_url('users/print') ?>" target="_blank" class="btn btn-outline-secondary shadow-sm rounded-pill px-3">
            <i class="bi bi-printer me-1"></i> Print
        </a>
        <a href="<?= base_url('users/create') ?>" class="btn btn-primary shadow-sm rounded-pill px-4">
            <i class="bi bi-person-plus-fill me-2"></i>Tambah Anggota
        </a>
    </div>
</div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="" method="get" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group border rounded-pill px-3 bg-light">
                        <span class="input-group-text bg-transparent border-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="cari" class="form-control bg-transparent border-0 small" placeholder="Cari nama atau username...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select border-0 bg-light rounded-pill small">
                        <option value="">-- Semua Role --</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                        <option value="anggota">Anggota</option>
                    </select>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-dark rounded-pill px-4">Cari</button>
                    <a href="<?= base_url('users') ?>" class="btn btn-link text-muted text-decoration-none small">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0 custom-table">
                <thead>
                    <tr>
                        <th class="ps-4">PROFIL ANGGOTA</th>
                        <th>KONTAK</th>
                        <th>HAK AKSES</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)) : ?>
                        <tr><td colspan="4" class="text-center py-5 text-muted">Data anggota tidak ditemukan.</td></tr>
                    <?php else : ?>
                        <?php foreach ($users as $u) : ?>
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="position-relative">
                                        <img src="<?= base_url('uploads/users/' . ($u['foto'] ?: 'default.jpg')) ?>" 
                                             class="rounded-circle border border-2 border-white shadow-sm" 
                                             style="width: 48px; height: 48px; object-fit: cover;">
                                        <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white border-2 rounded-circle"></span>
                                    </div>
                                    <div class="ms-3">
                                        <div class="fw-bold text-dark mb-0"><?= $u['nama'] ?></div>
                                        <div class="smaller text-muted">@<?= $u['username'] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="smaller fw-medium text-dark"><?= $u['email'] ?: '-' ?></div>
                                <a href="https://wa.me/<?= $u['no_hp'] ?>" target="_blank" class="text-success text-decoration-none smaller fw-bold">
                                    <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                </a>
                            </td>
                            <td>
                                <?php if (strtolower($u['role']) == 'admin') : ?>
                                    <span class="badge-custom bg-danger-soft text-danger">Administrator</span>
                                <?php elseif (strtolower($u['role']) == 'petugas') : ?>
                                    <span class="badge-custom bg-warning-soft text-warning">Petugas</span>
                                <?php else : ?>
                                    <span class="badge-custom bg-primary-soft text-primary">Anggota</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?= base_url('users/edit/'.$u['id_user']) ?>" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="<?= base_url('users/delete/'.$u['id_user']) ?>" 
                                       class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                       onclick="return confirm('Hapus anggota ini?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Custom Table Styling */
    .custom-table thead th {
        background-color: #fcfcfc;
        color: #94a3b8;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .custom-table tbody td {
        border-bottom: 1px solid #f1f5f9;
        color: #475569;
    }

    .smaller { font-size: 12px; }

    /* Badge Khusus Role */
    .badge-custom {
        padding: 5px 14px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        display: inline-block;
    }
    
    .bg-primary-soft { background-color: #eef2ff; }
    .bg-danger-soft { background-color: #fff1f2; }
    .bg-warning-soft { background-color: #fffbeb; }

    /* Form & Input Reset */
    .input-group-text { border: none; }
    .form-control:focus { box-shadow: none; }
    
    .btn-outline-warning:hover, .btn-outline-danger:hover {
        color: white;
    }
</style>
<?= $this->endSection() ?>