<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <h4 class="fw-bold mb-4">Daftar Transaksi Peminjaman</h4>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Nama Siswa</th>
                            <th>Judul Buku</th>
                            <th>Durasi</th> 
                            <th>Tgl Pinjam</th> 
                            <th>Status</th>
                            <th>Tgl Kembali</th> 
                            <th>Denda</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($peminjaman as $p) : ?>
                            <?php $st = strtolower($p['status'] ?? ''); ?>
                            <tr>
                                <td class="ps-4"><?= $no++; ?></td>
                                <td><?= esc($p['nama']); ?></td>
                                <td><?= esc($p['judul']); ?></td>
                                <td>
                                    <span class="badge bg-info text-dark fw-normal">
                                        <?= esc($p['durasi'] ?? '-'); ?> Hari
                                    </span>
                                </td>
                                <td>
                                    <?= ($p['tanggal_pinjam'] && $p['tanggal_pinjam'] != '0000-00-00 00:00:00') 
                                        ? date('d/m/Y', strtotime($p['tanggal_pinjam'])) : '-'; ?>
                                </td>
                                <td>
                                    <?php if ($st == 'dipinjam') : ?>
                                        <span class="badge bg-primary">Sedang Dipinjam</span>
                                    <?php elseif ($st == 'proses_kembali') : ?>
                                        <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                                    <?php elseif ($st == 'dikembalikan') : ?>
                                        <span class="badge bg-success">Selesai Dikembalikan</span>
                                    <?php else : ?>
                                        <span class="badge bg-secondary"><?= ucfirst($st); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= ($p['tanggal_kembali'] && $p['tanggal_kembali'] != '0000-00-00 00:00:00') 
                                        ? date('d/m/Y', strtotime($p['tanggal_kembali'])) 
                                        : '<span class="text-muted small">Belum Kembali</span>'; ?>
                                </td>
                                <td>
                                    <?php if(isset($p['denda']) && $p['denda'] > 0) : ?>
                                        <span class="text-danger fw-bold">Rp <?= number_format((int)$p['denda'], 0, ',', '.'); ?></span>
                                    <?php else : ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (session()->get('role') == 'admin') : ?>
                                        <?php if ($st == 'proses_kembali') : ?>
                                            <button class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAdminCek<?= $p['id_pinjam'] ?>">
                                                <i class="bi bi-eye me-1"></i> Verifikasi
                                            </button>
                                        <?php else : ?>
                                            <small class="text-muted">Selesai</small>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <?php if ($st == 'dipinjam') : ?>
                                            <button type="button" class="btn btn-sm btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#modalUserKembali<?= $p['id_pinjam'] ?>">
                                                <i class="bi bi-arrow-left-right me-1"></i> Kembalikan
                                            </button>
                                        <?php elseif ($st == 'proses_kembali') : ?>
                                            <small class="text-muted italic">Menunggu Admin...</small>
                                        <?php else : ?>
                                            <i class="bi bi-check2-all text-success fs-5"></i>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <?php if (session()->get('role') != 'admin' && $st == 'dipinjam') : ?>
                                <div class="modal fade" id="modalUserKembali<?= $p['id_pinjam'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <form action="<?= base_url('peminjaman/user_kembali/'.$p['id_pinjam']) ?>" method="post" enctype="multipart/form-data">
                                                <?= csrf_field() ?>
                                                <div class="modal-header">
                                                    <h6 class="modal-title fw-bold">Konfirmasi Pengembalian</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php 
                                                        $deadline = date('Y-m-d', strtotime($p['tanggal_pinjam']. ' + ' . $p['durasi'] . ' days'));
                                                        $hari_ini = date('Y-m-d');
                                                        $denda = 0;
                                                        if ($hari_ini > $deadline) {
                                                            $tgl_deadline = new DateTime($deadline);
                                                            $tgl_sekarang = new DateTime($hari_ini);
                                                            $selisih = $tgl_sekarang->diff($tgl_deadline);
                                                            $denda = $selisih->days * 10000;
                                                        }
                                                    ?>
                                                    <p class="small mb-3">Anda akan mengembalikan buku <strong>"<?= $p['judul'] ?>"</strong>.</p>
                                                    <div class="p-3 bg-light rounded mb-3">
                                                        <div class="d-flex justify-content-between mb-1">
                                                            <span class="small text-muted">Jatuh Tempo:</span>
                                                            <span class="small fw-bold"><?= date('d/m/Y', strtotime($deadline)) ?></span>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="small text-muted">Denda (10rb/hari):</span>
                                                            <span class="small fw-bold text-danger">Rp <?= number_format($denda, 0, ',', '.') ?></span>
                                                        </div>
                                                        <input type="hidden" name="denda" value="<?= $denda ?>">
                                                    </div>

                                                    <?php if ($denda > 0) : ?>
                                                        <div class="mb-3">
                                                            <label class="form-label small fw-bold">Pilih Metode Transfer</label>
                                                            <select name="metode_bayar" class="form-select form-select-sm" required>
                                                                <option value="">-- Pilih Metode --</option>
                                                                <option value="DANA">DANA (0812-XXXX-XXXX)</option>
                                                                <option value="Bank Transfer">BCA (12345678)</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label class="form-label small fw-bold">Upload Bukti (JPG/PNG)</label>
                                                            <input type="file" name="bukti_bayar" class="form-control form-control-sm" required>
                                                        </div>
                                                    <?php else : ?>
                                                        <p class="text-success small"><i class="bi bi-info-circle"></i> Tidak ada denda. Langsung kembalikan.</p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-sm btn-primary px-4">Kirim Laporan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->get('role') == 'admin' && $st == 'proses_kembali') : ?>
                                <div class="modal fade" id="modalAdminCek<?= $p['id_pinjam'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header">
                                                <h6 class="modal-title fw-bold">Verifikasi Pengembalian</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <div class="row mb-3 bg-light mx-0 py-2 rounded">
                                                    <div class="col-6 border-end text-start">
                                                        <span class="small text-muted d-block">Metode:</span>
                                                        <span class="fw-bold text-primary"><?= $p['metode_bayar'] ?? 'Tanpa Denda'; ?></span>
                                                    </div>
                                                    <div class="col-6 text-start">
                                                        <span class="small text-muted d-block">Total Denda:</span>
                                                        <span class="fw-bold text-danger">Rp <?= number_format($p['denda'], 0, ',', '.') ?></span>
                                                    </div>
                                                </div>
                                                <?php if ($p['bukti_bayar']) : ?>
                                                    <img src="<?= base_url('img/bukti_bayar/'.$p['bukti_bayar']) ?>" class="img-fluid rounded border">
                                                <?php endif; ?>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Tutup</button>
                                                <a href="<?= base_url('peminjaman/konfirmasi_selesai/'.$p['id_pinjam']) ?>" class="btn btn-sm btn-success px-4">Terima Buku</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>