<div class="col-md-10 p-4">

    <!-- KPI SUMMARY CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #198754;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Total Omset</p>
                    <h4 class="fw-bold mb-0 text-success">Rp <?= number_format($total_omset, 0, ',', '.'); ?></h4>
                    <small class="text-muted">Dari order status selesai</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #0dcaf0;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Total Order Masuk</p>
                    <h4 class="fw-bold mb-0"><?= $total_order; ?> SO</h4>
                    <small class="text-muted">Seluruh transaksi tercatat</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #ffc107;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Pending Pengiriman</p>
                    <h4 class="fw-bold mb-0"><?= $pending_kirim; ?> SO</h4>
                    <small class="text-muted">Dalam proses logistik</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #6c757d;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Order Draft</p>
                    <h4 class="fw-bold mb-0"><?= $order_draft; ?> SO</h4>
                    <small class="text-muted">Belum diproses sales</small>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL MONITORING SALES ORDER -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="card-title mb-1 fw-bold">Monitoring Sales Order</h4>
                    <p class="text-muted small mb-0">Kelola dan verifikasi status pengiriman barang pelanggan PT Maju Jaya.</p>
                </div>
            </div>
            
            <?= $this->session->flashdata('msg'); ?>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle rounded">
                    <thead class="table-dark">
                        <tr>
                            <th>No. Order</th>
                            <th>Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Sales Person</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th class="text-center">Aksi Operasional</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($orders)): ?>
                            <?php foreach($orders as $row): ?>
                            <tr>
                            <td>
    <a href="<?= base_url('admin/dashboard/detail/'.$row['id_order']); ?>" class="fw-bold text-primary text-decoration-none">
        <?= $row['no_order']; ?> <i class="fa-solid fa-arrow-up-right-from-square fa-xs ms-1"></i>
    </a>
</td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_order'])); ?></td>
                                <td><?= $row['nama_pelanggan']; ?></td>
                                <td><?= $row['nama_sales']; ?></td>
                                <td class="fw-bold text-success">Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php 
                                        $badge = 'bg-secondary';
                                        if($row['status'] == 'draft') $badge = 'bg-warning text-dark';
                                        elseif($row['status'] == 'dikirim') $badge = 'bg-info text-white';
                                        elseif($row['status'] == 'selesai') $badge = 'bg-success text-white';
                                        elseif($row['status'] == 'dibatalkan') $badge = 'bg-danger text-white';
                                    ?>
                                    <span class="badge <?= $badge; ?> text-uppercase px-2 py-1 small"><?= $row['status']; ?></span>
                                </td>
                                <td class="text-center">
                                    <?php if($row['status'] == 'draft'): ?>
                                        <a class="btn btn-sm btn-outline-primary me-1" href="<?= base_url('admin/dashboard/ubah_status/'.$row['id_order'].'/dikirim'); ?>" onclick="return confirm('Proses kirim logistik barang hari ini?')">Kirim Barang</a>
                                        <a class="btn btn-sm btn-outline-danger" href="<?= base_url('admin/dashboard/ubah_status/'.$row['id_order'].'/dibatalkan'); ?>" onclick="return confirm('Batalkan transaksi order ini?')">Batalkan</a>
                                    
                                    <?php elseif($row['status'] == 'dikirim'): ?>
                                        <a class="btn btn-sm btn-success me-1" href="<?= base_url('admin/dashboard/ubah_status/'.$row['id_order'].'/selesai'); ?>" onclick="return confirm('Konfirmasi serah terima barang selesai?')">Selesai</a>
                                        <a class="btn btn-sm btn-outline-danger" href="<?= base_url('admin/dashboard/ubah_status/'.$row['id_order'].'/dibatalkan'); ?>" onclick="return confirm('Batalkan pengiriman produk?')">Batalkan</a>
                                    
                                    <?php else: ?>
                                        <span class="text-muted small">Selesai Diproses</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada transaksi sales order yang masuk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>