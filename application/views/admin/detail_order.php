<div class="col-md-10 p-4 animate-fade-in">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-receipt text-primary me-2"></i>Detail Sales Order</h4>
            <p class="text-muted small mb-0">Rincian lengkap transaksi <strong><?= $order['no_order']; ?></strong>.</p>
        </div>
        <a href="<?= base_url('admin/dashboard'); ?>" class="btn btn-sm btn-outline-secondary rounded-3 fw-semibold">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Monitoring
        </a>
    </div>

    <!-- HEADER INFO ORDER -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-accent-bar bg-accent-blue"></div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">No. Order</p>
                    <p class="fw-bold mb-0"><?= $order['no_order']; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Tanggal Transaksi</p>
                    <p class="fw-bold mb-0"><?= date('d F Y', strtotime($order['tanggal_order'])); ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Status</p>
                    <?php 
                        $badge = 'bg-secondary';
                        if($order['status'] == 'draft') $badge = 'bg-warning text-dark';
                        elseif($order['status'] == 'dikirim') $badge = 'bg-info text-white';
                        elseif($order['status'] == 'selesai') $badge = 'bg-success text-white';
                        elseif($order['status'] == 'dibatalkan') $badge = 'bg-danger text-white';
                    ?>
                    <span class="badge <?= $badge; ?> text-uppercase px-2 py-1"><?= $order['status']; ?></span>
                </div>

                <div class="col-md-4 mb-3">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Pelanggan</p>
                    <p class="fw-bold mb-0"><?= $order['nama_pelanggan']; ?></p>
                    <p class="text-muted small mb-0"><?= $order['no_telp']; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Alamat Pengiriman</p>
                    <p class="mb-0 small"><?= $order['alamat']; ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Sales Person</p>
                    <p class="fw-bold mb-0"><i class="fa-solid fa-user-tie me-1 text-muted"></i><?= $order['nama_sales']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- RINCIAN ITEM PRODUK -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">
            <h6 class="fw-bold mb-3"><i class="fa-solid fa-boxes-stacked text-primary me-2"></i>Rincian Item Pesanan</h6>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $grand_total = 0;
                            foreach($items as $item): 
                                // Subtotal dihitung ulang manual karena kolom subtotal di DB belum tersimpan dengan benar
                                $real_subtotal = $item['jumlah'] * $item['harga_satuan'];
                                $grand_total += $real_subtotal;
                        ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?= $item['kode_produk']; ?></span></td>
                            <td class="fw-semibold"><?= $item['nama_produk']; ?></td>
                            <td class="text-center"><?= $item['jumlah']; ?></td>
                            <td class="text-end">Rp <?= number_format($item['harga_satuan'], 0, ',', '.'); ?></td>
                            <td class="text-end fw-bold">Rp <?= number_format($real_subtotal, 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <td colspan="4" class="text-end fw-bold">TOTAL KESELURUHAN</td>
                            <td class="text-end fw-bold text-success fs-5">Rp <?= number_format($grand_total, 0, ',', '.'); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'premium_form_style.php'; ?>