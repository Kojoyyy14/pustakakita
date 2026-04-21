<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PustakaKita</title>
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

        .brand-section { text-align: center; margin-bottom: 25px; }
        .school-badge { font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--primary-color); letter-spacing: 1px; display: block; margin-bottom: 5px; }
        h1 { color: var(--text-dark); font-size: 24px; font-weight: 800; margin: 0; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .form-group { margin-bottom: 15px; text-align: left; }
        .full-width { grid-column: span 2; }
        
        /* Animasi transisi */
        .siswa-only, .jurusan-only { 
            display: none; 
            animation: fadeIn 0.3s ease-in-out;
        }

        label { display: block; font-size: 12px; font-weight: 700; color: var(--text-dark); margin-bottom: 5px; }
        .input-wrapper { position: relative; }
        .input-wrapper i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 17px; z-index: 2; }

        input, select {
            width: 100%; padding: 11px 14px 11px 40px; border: 2px solid #f1f5f9;
            border-radius: 10px; font-size: 14px; transition: all 0.2s; box-sizing: border-box;
            background: #f8fafc; font-family: inherit; appearance: none;
        }

        select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 12px center;
        }

        input:focus, select:focus { outline: none; border-color: var(--primary-color); background: #fff; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); }

        .btn-login {
            width: 100%; padding: 13px; border: none; border-radius: 12px; font-size: 15px; font-weight: 700;
            background: var(--primary-color); color: white; cursor: pointer; transition: all 0.3s;
            margin-top: 10px; display: flex; justify-content: center; align-items: center; gap: 8px;
        }

        .btn-login:hover { background: var(--primary-hover); transform: translateY(-1px); box-shadow: 0 8px 15px rgba(37, 99, 235, 0.2); }

        .restore-link {
            font-size: 12px; color: #94a3b8; text-decoration: none; display: flex; 
            align-items: center; gap: 5px; margin-top: 15px; justify-content: center;
        }
        .restore-link:hover { color: #e11d48; }

        .footer-text { margin-top: 20px; font-size: 13px; color: var(--text-muted); text-align: center; border-top: 1px solid #f1f5f9; padding-top: 15px; }
        .footer-text a { color: var(--primary-color); text-decoration: none; font-weight: 700; }

        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body>

<div class="login-card">
    <div class="brand-section">
        <span class="school-badge">Perpustakaan Digital</span>
        <h1>PustakaKita</h1>
    </div>

    <form action="<?= base_url('/proses-login') ?>" method="post">
        <div class="form-grid">
            
            <div class="form-group full-width">
                <label>Masuk Sebagai</label>
                <div class="input-wrapper">
                    <i class="bi bi-people"></i>
                    <select name="role" id="roleSelector" onchange="handleUI()" required>
                        <option value="admin">Admin / Petugas</option>
                        <option value="siswa">Siswa</option>
                    </select>
                </div>
            </div>

            <div class="form-group full-width siswa-only">
                <label>Jenjang Sekolah</label>
                <div class="input-wrapper">
                    <i class="bi bi-building"></i>
                    <select name="jenjang" id="jenjangSelector" onchange="handleUI()">
                        <option value="SMP">SMP / MTs</option>
                        <option value="SMA">SMA / SMK / MA</option>
                    </select>
                </div>
            </div>

            <div class="form-group full-width">
                <label>Username / NIS</label>
                <div class="input-wrapper">
                    <i class="bi bi-person-badge"></i>
                    <input type="text" name="username" placeholder="Username atau NIS" required>
                </div>
            </div>

            <div class="form-group siswa-only full-width">
                <label>Kelas</label>
                <div class="input-wrapper">
                    <i class="bi bi-door-open"></i>
                    <input type="text" name="kelas" id="kelasInput" placeholder="Contoh: 7-A atau XII-RPL">
                </div>
            </div>

            <div class="form-group full-width jurusan-only">
                <label>Jurusan <small class="text-danger">*Wajib untuk SMA/SMK</small></label>
                <div class="input-wrapper">
                    <i class="bi bi-mortarboard"></i>
                    <input type="text" name="jurusan" id="jurusanInput" placeholder="Contoh: IPA 1 atau TKJ">
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

        <a href="<?= base_url('restore') ?>" class="restore-link">
            <i class="bi bi-database-fill-gear"></i> Pemulihan Sistem
        </a>
    </form>
    
    <div class="footer-text">
        Siswa baru? <a href="<?= base_url('users/create') ?>">Daftar Akun</a>
    </div>
</div>

<script>
    function handleUI() {
        const role = document.getElementById('roleSelector').value;
        const jenjang = document.getElementById('jenjangSelector').value;
        
        const siswaFields = document.querySelectorAll('.siswa-only');
        const jurusanFields = document.querySelectorAll('.jurusan-only');
        
        const kelasInput = document.getElementById('kelasInput');
        const jurusanInput = document.getElementById('jurusanInput');

        // 1. Logika Tampilan Siswa
        if (role === 'siswa') {
            siswaFields.forEach(f => f.style.display = 'block');
            kelasInput.setAttribute('required', 'required');
            
            // 2. Logika Jurusan (Hanya muncul jika SMA atau SMK)
            if (jenjang === 'SMA' || jenjang === 'SMK') {
                jurusanFields.forEach(f => f.style.display = 'block');
                jurusanInput.setAttribute('required', 'required');
            } else {
                jurusanFields.forEach(f => f.style.display = 'none');
                jurusanInput.removeAttribute('required');
                jurusanInput.value = ""; // Reset jika pilih SMP lagi
            }
        } else {
            // Sembunyikan semua jika Admin/Petugas
            siswaFields.forEach(f => f.style.display = 'none');
            jurusanFields.forEach(f => f.style.display = 'none');
            kelasInput.removeAttribute('required');
            jurusanInput.removeAttribute('required');
        }
    }

    // Jalankan saat startup
    window.onload = handleUI;
</script>

</body>
</html>