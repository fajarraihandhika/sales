<div class="col-md-10 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Manajemen Master Produk</h3>
        <a href="<?= base_url('admin/produk/tambah'); ?>" class="btn btn-primary">+ Tambah Produk</a>
    </div>
    <?= $this->session->flashdata('msg'); ?>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Harga Satuan</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produk as $p): ?>
                    <tr>
                        <td><?= $p['kode_produk']; ?></td>
                        <td><?= $p['nama_produk']; ?></td>
                        <td>Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                        <td><?= $p['stok']; ?></td>
                        <td>
                            <a href="<?= base_url('admin/produk/edit/'.$p['id_produk']); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= base_url('admin/produk/hapus/'.$p['id_produk']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>