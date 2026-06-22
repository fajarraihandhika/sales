<div class="col-md-10 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Tim Sales Lapangan</h3>
    </div>
    <?= $this->session->flashdata('msg'); ?>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID Sales Person</th>
                        <th>Nama Lengkap</th>
                        <th>Username Aplikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($sales as $s): ?>
                    <tr>
                        <td><span class="badge bg-secondary"><?= $s['id_sales_person']; ?></span></td>
                        <td><?= $s['nama_sales']; ?></td>
                        <td><?= $s['username'] ? $s['username'] : '<em class="text-muted">Tidak ada akun login</em>'; ?></td>
                        <td>
                            <a href="<?= base_url('admin/sales/hapus/'.$s['id_sales']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Menghapus sales juga menghapus akun loginnya. Lanjutkan?')">Hapus Tim</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>