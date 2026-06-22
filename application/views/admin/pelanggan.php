<div class="col-md-10 p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data Pelanggan</h4>
            <p class="text-muted small mb-0">Manajemen daftar pelanggan/toko distribusi PT Maju Jaya.</p>
        </div>
        <a href="<?= base_url('admin/pelanggan/tambah'); ?>" class="btn btn-primary fw-bold">+ Tambah Pelanggan</a>
    </div>

    <?= $this->session->flashdata('msg'); ?>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Pelanggan</th>
                            <th>No. Telepon</th>
                            <th>Alamat Toko / Perusahaan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($pelanggan)): ?>
                            <?php foreach($pelanggan as $plg): ?>
                            <tr>
                                <td><span class="badge bg-secondary">PLG-<?= sprintf('%03d', $plg['id_pelanggan']); ?></span></td>
                                <td class="fw-bold"><?= $plg['text_nama_pelanggan'] ?? $plg['nama_pelanggan']; ?></td>
                                <td><?= $plg['no_telp']; ?></td>
                                <td><?= $plg['alamat']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/pelanggan/edit/'.$plg['id_pelanggan']); ?>" class="btn btn-sm btn-warning fw-bold text-dark me-1">Edit</a>
                                    <a href="<?= base_url('admin/pelanggan/hapus/'.$plg['id_pelanggan']); ?>" class="btn btn-sm btn-outline-danger fw-bold" onclick="return confirm('Hapus data pelanggan ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data pelanggan terdaftar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>