<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User | Perpustakaan Digital</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4e73df;
            --bg-soft: #f8f9fc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .auth-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
        }

        .auth-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .auth-header h4 {
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .auth-body {
            padding: 40px 35px;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        }

        .btn-submit {
            background: var(--primary-color);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: transform 0.2s;
        }

        .btn-submit:hover {
            background: #2e59d9;
            transform: translateY(-2px);
        }

        .footer-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
        }

        .footer-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        /* Styling Input File */
        .input-group-text {
            background: #f8fafc;
            border-radius: 10px 0 0 10px;
        }
        
        .custom-file-input {
            border-radius: 0 10px 10px 0 !important;
        }
    </style>
</head>

<body>

    <div class="auth-card">
        <div class="auth-header">
            <h4>Daftar Akun Baru</h4>
            <p class="mb-0 small opacity-75">Lengkapi data di bawah untuk bergabung</p>
        </div>

        <div class="auth-body">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger border-0 small rounded-3 mb-4">
                    <i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person text-muted"></i></span>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipe Pengguna (Role)</label>
                    <select name="role" class="form-select" required>
                        <option value="" disabled selected>Pilih hak akses...</option>
                        <option value="admin">Administrator</option>
                        <option value="petugas">Petugas Perpus</option>
                        <option value="anggota">Anggota/Siswa</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Foto Profil <span class="text-muted fw-normal">(Opsional)</span></label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <div class="form-text smaller">Format: JPG, PNG (Max. 2MB)</div>
                </div>

                <button type="submit" class="btn btn-primary btn-submit">
                    Daftar Sekarang <i class="bi bi-arrow-right ms-2"></i>
                </button>

                <div class="footer-link text-muted">
                    Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>