<div class="d-flex flex-column h-100 p-3 bg-white border-end shadow-sm">
    <div class="mb-5 px-3">
        <a class="navbar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/') ?>" style="text-decoration: none;">
            <div class="p-2 bg-primary rounded-3 me-2">
                <i class="bi bi-book-half text-white fs-5"></i>
            </div>
            <div>
                <span class="fw-bold fs-5 text-dark" style="letter-spacing: -0.5px;">PustakaKita</span><span class="fw-light fs-5 text-primary"></span>
            </div>
        </a>
    </div>

    <ul class="nav nav-pills flex-column mb-auto px-2">
        <li class="nav-item">
            <small class="text-uppercase text-muted fw-bold px-3 mb-2 d-block" style="font-size: 0.65rem; letter-spacing: 1px;">Menu Utama</small>
        </li>
        
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center py-2 px-3 <?= (uri_string() == '' || uri_string() == '/') ? 'active shadow-sm text-white' : 'text-secondary' ?>" href="<?= base_url('/') ?>">
                <i class="bi bi-speedometer2 me-3 fs-5"></i> <span class="fw-semibold">Dashboard
                
                </span>
            </a>
        </li>

        <li class="nav-item">
            <small class="text-uppercase text-muted fw-bold px-3 mt-4 mb-2 d-block" style="font-size: 0.65rem; letter-spacing: 1px;">Manajemen</small>
        </li>

        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center py-2 px-3 <?= (strpos(uri_string(), 'buku') !== false) ? 'active shadow-sm text-white' : 'text-secondary' ?>" href="<?= base_url('/buku') ?>">
                <i class="bi bi-collection me-3 fs-5"></i> <span class="fw-semibold">Katalog Buku</span>
            </a>
        </li>

      <li class="nav-item mb-2">
    <a class="nav-link d-flex align-items-center py-2 px-3 <?= (strpos(uri_string(), 'peminjaman') !== false) ? 'active shadow-sm text-white' : 'text-secondary' ?>" href="<?= base_url('/peminjaman') ?>">
        <i class="bi bi-arrow-left-right me-3 fs-5"></i> <span class="fw-semibold">Peminjaman</span>
    </a>
</li>

        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center py-2 px-3 <?= (strpos(uri_string(), 'users') !== false && strpos(uri_string(), 'edit') === false) ? 'active shadow-sm text-white' : 'text-secondary' ?>" href="<?= base_url('/users') ?>">
                <i class="bi bi-person-badge me-3 fs-5"></i> <span class="fw-semibold">Daftar Anggota</span>
            </a>
        </li>

        <li class="nav-item">
            <small class="text-uppercase text-muted fw-bold px-3 mt-4 mb-2 d-block" style="font-size: 0.65rem; letter-spacing: 1px;">Sistem</small>
        </li>

        <?php $idu = session('id_user'); ?>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center py-2 px-3 <?= (strpos(uri_string(), 'users/edit') !== false) ? 'active shadow-sm text-white' : 'text-secondary' ?>" href="<?= base_url('users/edit/' . $idu) ?>">
                <i class="bi bi-sliders me-3 fs-5"></i> <span class="fw-semibold">Pengaturan</span>
            </a>
        </li>
    </ul>

    <div class="mt-auto pt-4 border-top">
        <a href="<?= site_url('/logout') ?>" class="nav-link d-flex align-items-center py-2 px-3 text-danger mb-3 btn-logout fw-bold" onclick="return confirm('Log Out dari aplikasi?')">
            <i class="bi bi-power me-3 fs-5"></i> <span>Keluar</span>
        </a>
        <div class="d-flex align-items-center p-2 rounded-3 bg-light">
            <div class="position-relative">
                <?php $foto = session()->get('foto') ?: 'default.jpg'; ?>
                <img src="<?= base_url('uploads/users/' . $foto) ?>" width="42" height="42" class="rounded-circle shadow-sm" style="object-fit: cover;" alt="User Profile" />
                <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white border-2 rounded-circle"></span>
            </div>
            <div class="ms-3 overflow-hidden text-truncate">
                <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.85rem;"><?= session('nama'); ?></h6>
                <span class="text-muted text-uppercase fw-bold" style="font-size: 0.6rem;"><?= session('role'); ?></span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Hover & Active State Sidebar */
    .nav-pills .nav-link {
        border-radius: 12px;
        transition: all 0.3s ease;
        font-size: 0.92rem;
    }
    .nav-pills .nav-link:not(.active):hover {
        background-color: #f1f5f9;
        color: #0d6efd !important;
        transform: translateX(4px);
    }
    .nav-pills .nav-link.active {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
    }
    .btn-logout:hover {
        background-color: #fff1f2 !important;
        color: #be123c !important;
    }
</style>