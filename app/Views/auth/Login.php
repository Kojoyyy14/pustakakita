<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa | PustakaKita Sekolah</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --glass-bg: rgba(255, 255, 255, 0.98);
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #e0e7ff 0%, #ffffff 100%);
            /* Pattern halus ala sekolah */
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png");
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 24px;
            background: var(--glass-bg);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            animation: slideUp 0.6s ease-out;
            margin: 20px;
        }

        .brand-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .school-badge {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--primary-color);
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: block;
        }

        h1 {
            color: var(--text-dark);
            font-size: 24px;
            font-weight: 800;
            margin: 0;
        }

        /* ===== FORM STYLING ===== */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .full-width { grid-column: span 2; }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 18px;
        }

        input, select {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 2px solid #f1f5f9;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.2s;
            box-sizing: border-box;
            background: #f8fafc;
            font-family: inherit;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        /* ===== BUTTON ===== */
        .btn-login {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            background: var(--primary-color);
            color: white;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-login:hover {
            background: var(--primary-hover);
            box-shadow: 0 8px 15px rgba(37, 99, 235, 0.2);
        }

        .footer-text {
            margin-top: 25px;
            font-size: 13px;
            color: var(--text-muted);
            text-align: center;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }

        .footer-text a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .form-grid { grid-template-columns: 1fr; }
            .full-width { grid-column: span 1; }
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="brand-section">
        <span class="school-badge">Perpustakaan Digital</span>
        <h1>PustakaKita</h1>
        <p style="color: var(--text-muted); font-size: 14px; margin-top: 5px;">Silakan masuk untuk meminjam buku</p>
    </div>

    <?php if (session()->getFlashdata('error') || session()->getFlashdata('salahpw')): ?>
    <div style="background: #fff1f2; color: #e11d48; padding: 12px; border-radius: 10px; font-size: 13px; margin-bottom: 20px; border: 1px solid #ffe4e6;">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <?= session()->getFlashdata('error') ?: session()->getFlashdata('salahpw') ?>
    </div>
    <?php endif; ?>

    <form action="<?= base_url('/proses-login') ?>" method="post">
        <div class="form-grid">
            <div class="form-group full-width">
                <label>NIS / Username</label>
                <div class="input-wrapper">
                    <i class="bi bi-person-badge"></i>
                    <input type="text" name="username" placeholder="Contoh: 222310156" required>
                </div>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <div class="input-wrapper">
                    <i class="bi bi-door-open" style="left: 14px;"></i>
                    <select name="kelas" required style="padding-left: 42px;">
                        <option value="" disabled selected>Pilih</option>
                        <option value="X">Kelas X</option>
                        <option value="XI">Kelas XI</option>
                        <option value="XII">Kelas XII</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Jurusan</label>
                <div class="input-wrapper">
                    <i class="bi bi-mortarboard" style="left: 14px;"></i>
                    <input type="text" name="jurusan" placeholder="MIPA 1" required style="padding-left: 42px;">
                </div>
            </div>

            <div class="form-group full-width">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-shield-lock"></i>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-login">
            Masuk Sekarang <i class="bi bi-arrow-right-short"></i>
        </button>
    </form>

    <div class="footer-text">
        Siswa baru? <a href="<?= base_url('users/create') ?>">Registrasi di sini</a>
    </div>
</div>

</body>
</html>