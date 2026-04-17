<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <h4 class="fw-bold mb-4">Daftar Transaksi Peminjaman</h4>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Nama Siswa</th>
                            <th>Judul Buku</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($peminjaman as $p) : ?>
                            <tr>
                                <td class="ps-4"><?= $no++; ?></td>
                                <td><?= $p['nama']; ?></td>
                                <td><?= $p['judul']; ?></td>
                                <td>
                                    <?php 
                                        $st = strtolower($p['status'] ?? ''); 
                                        $badge = ($st == 'dipinjam') ? 'bg-primary' : (($st == 'pending' || $st == '') ? 'bg-warning text-dark' : 'bg-success');
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= ucfirst($st ?: 'Pending'); ?></span>
                                </td>
                                <td class="text-center">
                                    <?php if (session()->get('role') == 'admin') : ?>
                                        <?php if ($st == 'pending' || $st == '') : ?>
                                            <a href="<?= base_url('peminjaman/konfirmasi/'.$p['id_pinjam'].'/setuju') ?>" class="btn btn-sm btn-success">Setuju</a>
                                            <a href="<?= base_url('peminjaman/konfirmasi/'.$p['id_pinjam'].'/tolak') ?>" class="btn btn-sm btn-danger">Tolak</a>
                                        <?php elseif ($st == 'dipinjam') : ?>
                                            <a href="<?= base_url('peminjaman/proses_kembali/'.$p['id_pinjam']) ?>" class="btn btn-sm btn-outline-primary">Proses Kembali</a>
                                        <?php else : ?>
                                            <span class="text-muted small">Selesai</span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <small class="text-muted">No Action</small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>