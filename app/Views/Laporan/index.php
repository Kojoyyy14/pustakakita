<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<style>
    .card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s; }
    .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
    .bg-soft-primary { background-color: #e7f1ff; color: #0d6efd; }
    .bg-soft-success { background-color: #e8fadf; color: #198754; }
    .bg-soft-info { background-color: #e0f7fa; color: #00acc1; }
    @media print { .d-print-none { display: none !important; } .card { box-shadow: none; border: 1px solid #ddd; } }
</style>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 d-print-none">
        <div>
            <h4 class="fw-bold mb-0">Laporan Bulanan PustakaKita</h4>
            <p class="text-muted small">Ringkasan aktivitas perpustakaan periode <?= date('F Y') ?></p>
        </div>
        <button onclick="window.print()" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-printer me-2"></i> Unduh Laporan (PDF)
        </button>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-soft-primary me-3">
                        <i class="bi bi-book fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Total Peminjaman</p>
                        <h4 class="fw-bold mb-0"><?= count($laporan) ?> <small class="text-success fs-6"><i class="bi bi-arrow-up"></i></small></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-soft-success me-3">
                        <i class="bi bi-cash-stack fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Denda Terkumpul</p>
                        <h4 class="fw-bold mb-0">Rp <?= number_format($total_denda, 0, ',', '.') ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div class="stat-icon bg-soft-info me-3">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Periode Laporan</p>
                        <h4 class="fw-bold mb-0"><?= date('M Y') ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4 d-print-none">
        <div class="col-md-8">
            <div class="card p-3 shadow-sm h-100">
                <h6 class="fw-bold mb-3">Tren Peminjaman Harian</h6>
                <canvas id="trenChart" style="max-height: 280px;"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 shadow-sm h-100">
                <h6 class="fw-bold mb-3">Distribusi Kategori Buku</h6>
                <canvas id="kategoriChart" style="max-height: 280px;"></canvas>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white py-3">
            <h6 class="fw-bold mb-0">Daftar Transaksi Peminjaman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light text-muted small">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Peminjam</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($laporan as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><span class="fw-bold text-dark"><?= $row['judul'] ?></span></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= date('d/m/Y', strtotime($row['tanggal_pinjam'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($row['tanggal_kembali'])) ?></td>
                            <td>
                                <span class="badge rounded-pill <?= $row['status'] == 'dipinjam' ? 'bg-warning text-dark' : 'bg-success' ?>">
                                    <?= ucfirst($row['status']) ?>
                                </span>
                            </td>
                            <td class="text-danger fw-bold">Rp <?= number_format($row['denda'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($laporan)) : ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada aktivitas bulan ini.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari Controller
    const trenData = <?= $tren ?>;
    const katData = <?= $kategori ?>;

    // Chart Tren Harian
    new Chart(document.getElementById('trenChart'), {
        type: 'bar',
        data: {
            labels: trenData.map(item => 'Tgl ' + item.tgl),
            datasets: [{
                label: 'Jumlah Pinjam',
                data: trenData.map(item => item.total),
                backgroundColor: '#0d6efd',
                borderRadius: 6,
                barThickness: 20
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    // Chart Kategori
    new Chart(document.getElementById('kategoriChart'), {
        type: 'doughnut',
        data: {
            labels: katData.map(item => item.kategori),
            datasets: [{
                data: katData.map(item => item.total),
                backgroundColor: ['#0d6efd', '#198754', '#0dcaf0', '#ffc107', '#6c757d'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, cutout: '70%', plugins: { legend: { position: 'bottom' } } }
    });
</script>

<?= $this->endSection(); ?>